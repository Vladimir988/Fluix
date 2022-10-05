{{--
  Title: Svg image
  Description: Svg image
  Category: layout
  Icon: format-image
  Keywords: svg image
  Mode: edit
  Align: left
  PostTypes: page
  SupportsAlign: left right
  SupportsMode: true
  SupportsMultiple: true
--}}

@php
    $layout = intval(get_field('layout'));
    if($layout == 1) {
        echo sprintf(
            '<section class="brands container">
                <div class="brands__container">
                    <picture>
                        <source srcset="%1$s" type="image/webp">
                        <img src="%1$s" alt="logos" loading="lazy">
                    </picture>
                </div>
            </section>',
            get_field('image')
        );
    } elseif($layout == 2) {
        echo sprintf(
            '<section class="white-brands container">
                <div class="white-brands__title main-title main-middle-title">%1$s</div>
                <div class="white-brands__image">
                    <picture>
                        <source srcset="%2$s" type="image/webp">
                        <img src="%2$s" alt="logos" loading="lazy">
                    </picture>
                </div>
            </section>',
            get_field('title'),
            get_field('image')
        );
    }
@endphp