@php use App\Controllers\NavWalker; @endphp

<header class="header">
    <div class="header__menu menu">
        <a href="{{ home_url('/') }}" class="jumbotron__logo main-logo">
            <div class="menu__icon">
                <picture>
                    <source srcset="@php bloginfo('template_directory') @endphp/assets/images/logo.svg" type="image/webp">
                    <img src="@php bloginfo('template_directory') @endphp/assets/images/logo.svg" title="@php bloginfo('description') @endphp" alt="@php bloginfo('name') @endphp"></picture>
            </div>
        </a>

        @if (has_nav_menu('social_nav'))
            {!! wp_nav_menu([
                'theme_location'  => 'main_nav',
                'container'       => 'div',
                'container_class' => 'menu__container',
                'menu_class'      => 'menu__body',
                'depth'           => 1
            ]) !!}
        @endif
        <div class="menu__burger">{{ __('Menu') }}</div>
    </div>
</header>