@php use App\Controllers\NavWalker; @endphp

<footer class="footer">
    <div class="footer__menu">
        <div class="footer__row">
            <div class="widget__body">
                @php dynamic_sidebar('footer-sidebar-1') @endphp
            </div>
            <div class="widget__body">
                @php dynamic_sidebar('footer-sidebar-2') @endphp
            </div>
            <div class="widget__body">
                @php dynamic_sidebar('footer-sidebar-3') @endphp
            </div>
            <div class="widget__body">
                @php dynamic_sidebar('footer-sidebar-4') @endphp
            </div>
        </div>
        <div class="footer__additional">
            @php dynamic_sidebar('footer-copyright') @endphp
            @php dynamic_sidebar('footer-locale-switcher') @endphp
            @php dynamic_sidebar('info-badges') @endphp
            @if (has_nav_menu('social_nav'))
                {!! wp_nav_menu([
                    'theme_location' => 'social_nav',
                    'menu_class'     => 'footer__add footer--social',
                    'depth'          => 1,
                    'walker'         => new NavWalker()
                ]) !!}
            @endif
        </div>
    </div>
</footer>