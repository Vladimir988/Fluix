<?php use App\Controllers\NavWalker; ?>

<header class="header">
    <div class="header__menu menu">
        <a href="<?php echo e(home_url('/')); ?>" class="jumbotron__logo main-logo">
            <div class="menu__icon">
                <picture>
                    <source srcset="<?php bloginfo('template_directory') ?>/assets/images/logo.svg" type="image/webp">
                    <img src="<?php bloginfo('template_directory') ?>/assets/images/logo.svg" title="<?php bloginfo('description') ?>" alt="<?php bloginfo('name') ?>"></picture>
            </div>
        </a>

        <?php if(has_nav_menu('social_nav')): ?>
            <?php echo wp_nav_menu([
                'theme_location'  => 'main_nav',
                'container'       => 'div',
                'container_class' => 'menu__container',
                'menu_class'      => 'menu__body',
                'depth'           => 1
            ]); ?>

        <?php endif; ?>
        <div class="menu__burger"><?php echo e(__('Menu')); ?></div>
    </div>
</header>