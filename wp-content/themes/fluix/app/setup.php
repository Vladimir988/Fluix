<?php namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    // scripts
    wp_enqueue_script('fluix', asset_path('scripts/main.js'), ['jquery'], null, true);
    wp_localize_script('fluix', 'wpData', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ]);

    // fonts
    wp_enqueue_style( 'barlow-condensed', 'https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;400;500;600&display=swap' );
    wp_enqueue_style( 'roboto-condensed', 'https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap' );

    // styles
    wp_enqueue_style('fluix', asset_path('styles/main.css'), false, null);
    wp_enqueue_style('font-awesome-brands', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/brands.min.css', false, null);
    wp_enqueue_style('fonts', get_stylesheet_directory_uri() . '/assets/fonts/fonts.css');
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'main_nav'   => __('Main Menu', 'fluix'),
        'social_nav' => __('Social Menu', 'fluix'),
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    register_sidebar([
        'name'          => __('Footer Top Sidebar 1', 'fluix'),
        'id'            => 'footer-sidebar-1',
        'before_widget' => '<div class="%1$s %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget__title">',
        'after_title'   => "</h4>\n",
    ]);
    register_sidebar([
        'name'          => __('Footer Top Sidebar 2', 'fluix'),
        'id'            => 'footer-sidebar-2',
        'before_widget' => '<div class="%1$s %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget__title">',
        'after_title'   => "</h4>\n",
    ]);
    register_sidebar([
        'name'          => __('Footer Top Sidebar 3', 'fluix'),
        'id'            => 'footer-sidebar-3',
        'before_widget' => '<div class="%1$s %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget__title">',
        'after_title'   => "</h4>\n",
    ]);
    register_sidebar([
        'name'          => __('Footer Top Sidebar 4', 'fluix'),
        'id'            => 'footer-sidebar-4',
        'before_widget' => '<div class="%1$s %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget__title">',
        'after_title'   => "</h4>\n",
    ]);

    register_sidebar([
        'name'          => __('Footer Copyright', 'fluix'),
        'id'            => 'footer-copyright',
        'before_widget' => '<div class="widget %1$s %2$s">',
        'after_widget'  => '</div>',
    ]);
    register_sidebar([
        'name'          => __('Footer Locale Switcher', 'fluix'),
        'id'            => 'footer-locale-switcher',
        'before_widget' => '<div class="widget %1$s %2$s">',
        'after_widget'  => '</div>',
    ]);
    register_sidebar([
        'name'          => __('Info Badges Section', 'fluix'),
        'id'            => 'info-badges',
        'before_widget' => '<div class="footer__additional-badges %1$s %2$s">',
        'after_widget'  => '</div>',
    ]);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (! file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});

add_filter('acf_gutenblocks/blocks', function (array $blocks): array {
    $new_blocks = [
        App::class,
    ];
    return array_merge($blocks, $new_blocks);
});

add_action('init', function () {
    if (function_exists('acf_add_local_field_group')) {

        // Gutenberg blocks
        collect(glob(config('theme.dir') . '/app/fields/blocks/*.php'))->map(function ($field) {
            return require_once($field);
        })->map(function ($field) {
            if ($field instanceof FieldsBuilder) {
                acf_add_local_field_group($field->build());
            }
        });

        // Post fields
        collect(glob(config('theme.dir') . '/app/fields/post/*.php'))->map(function ($field) {
            return require_once($field);
        })->map(function ($field) {
            if ($field instanceof FieldsBuilder) {
                acf_add_local_field_group($field->build());
            }
        });
    }
});