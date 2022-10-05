<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__).'/config/assets.php',
            'theme' => require dirname(__DIR__).'/config/theme.php',
            'view' => require dirname(__DIR__).'/config/view.php',
        ]);
    }, true);

add_filter('wp_check_filetype_and_ext', 'fixSvgMimeType', 10, 5);
function fixSvgMimeType($data, $file, $filename, $mimes, $real_mime = '')
{
    if (version_compare($GLOBALS['wp_version'], '5.1.0', '>=')) {
        $dosvg = in_array($real_mime, ['image/svg', 'image/svg+xml']);
    } else {
        $dosvg = ('.svg' === strtolower(substr($filename, -4)));
    }

    if ($dosvg) {
        if (current_user_can('manage_options')) {
            $data['ext'] = 'svg';
            $data['type'] = 'image/svg+xml';
        } else {
            $data['ext'] = false;
            $data['type'] = false;
        }
    }

    return $data;
}

add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}, 100);


add_action('init', 'createTaxonomy');
function createTaxonomy()
{
    register_taxonomy('page_tag', ['page'], [
        'label'             => '',
        'labels'            => [
            'name'              => __('Tags', 'fluix'),
            'singular_name'     => __('Tag', 'fluix'),
            'search_items'      => __('Search Tags', 'fluix'),
            'all_items'         => __('All Tags', 'fluix'),
            'view_item '        => __('View Tag', 'fluix'),
            'parent_item'       => __('Parent Tag', 'fluix'),
            'parent_item_colon' => __('Parent Tag:', 'fluix'),
            'edit_item'         => __('Edit Tag', 'fluix'),
            'update_item'       => __('Update Tag', 'fluix'),
            'add_new_item'      => __('Add New Tag', 'fluix'),
            'new_item_name'     => __('New Tag Name', 'fluix'),
            'menu_name'         => __('Tags', 'fluix'),
            'back_to_items'     => __('← Back to Tags', 'fluix'),
        ],
        'description'       => '',
        'public'            => true,
        'hierarchical'      => false,
        'rewrite'           => true,
        'capabilities'      => [],
        'meta_box_cb'       => null,
        'show_admin_column' => false,
        'show_in_rest'      => null,
        'rest_base'         => null,
    ]);
}

add_action('wp_ajax_get_more_focus_blocks', 'getMoreFocusBlocks');
add_action('wp_ajax_nopriv_get_more_focus_blocks', 'getMoreFocusBlocks');
function getMoreFocusBlocks()
{
    if ( function_exists( 'get_field' ) ) {
        $postId  = get_post(intval($_POST['id']));
        $counter = intval($_POST['counter']);
        if ( has_blocks( $postId->post_content ) ) {
            $blocks = parse_blocks( $postId->post_content );
            foreach ( $blocks as $block ) {
                if ( $block['blockName'] === 'acf/focus-block' ) {
                    $data = [];
                    foreach ($block['attrs']['data'] as $key => $val) {
                        if(substr( $key, 0, 6 ) === 'focus_') {
                            if(endsWith($key, '_image') ) {
                                $data[intval(substr($key, 6, 1))]['image'] = wp_get_attachment_image_url($val, 'full');
                            }
                            if(endsWith($key, '_title') ) {
                                $data[intval(substr($key, 6, 1))]['title'] = $val;
                            }
                            if(endsWith($key, '_descr') ) {
                                $data[intval(substr($key, 6, 1))]['descr'] = $val;
                            }
                        }
                    }

                    $html = '';
                    $i    = 0;
                    $data = (array)array_slice($data, $counter);
                    foreach($data as $key => $crew) {
                        if($i >= 2) break; $i++;
                        $html .= sprintf(
                            '<div class="focus-on__item">
                                <div class="focus-on__icon">
                                    <picture>
                                        <source srcset="%1$s" type="image/webp">
                                        <img src="%1$s" alt="%2$s" loading="lazy">
                                    </picture>
                                </div>
                                <div class="focus-on__item-title sub-title">%2$s</div>
                                <div class="focus-on__description main-text">%3$s</div>
                            </div>',
                            $crew['image'],
                            $crew['title'],
                            $crew['descr']
                        );
                    }

                    $data = array_slice($data, 2);
                    wp_send_json(['html' => $html, 'quantity' => count($data)]);
                }
            }
        }
    }

    wp_send_json(['html' => '', 'quantity' => 0]);
}

function endsWith($haystack, $needle) {
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}