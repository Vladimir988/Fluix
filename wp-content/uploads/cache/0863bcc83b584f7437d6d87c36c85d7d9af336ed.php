<?php use App\Controllers\NavWalker; ?>

<footer class="footer">
    <div class="footer__menu">
        <div class="footer__row">
            <div class="widget__body">
                <?php dynamic_sidebar('footer-sidebar-1') ?>
            </div>
            <div class="widget__body">
                <?php dynamic_sidebar('footer-sidebar-2') ?>
            </div>
            <div class="widget__body">
                <?php dynamic_sidebar('footer-sidebar-3') ?>
            </div>
            <div class="widget__body">
                <?php dynamic_sidebar('footer-sidebar-4') ?>
            </div>
        </div>
        <div class="footer__additional">
            <?php dynamic_sidebar('footer-copyright') ?>
            <?php dynamic_sidebar('footer-locale-switcher') ?>
            <?php dynamic_sidebar('info-badges') ?>
            <?php if(has_nav_menu('social_nav')): ?>
                <?php echo wp_nav_menu([
                    'theme_location' => 'social_nav',
                    'menu_class'     => 'footer__add footer--social',
                    'depth'          => 1,
                    'walker'         => new NavWalker()
                ]); ?>

            <?php endif; ?>
        </div>
    </div>
</footer>