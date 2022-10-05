{{--
  Title: Get start
  Description: Get start
  Category: layout
  Icon: align-wide
  Keywords: get start block
  Mode: edit
  Align: left
  PostTypes: page
  SupportsAlign: left right
  SupportsMode: true
  SupportsMultiple: true
--}}

@php
    $layout   = intval(get_field('layout'));
    $title    = get_field('title');
    $btnUrl   = get_field('btn_group')['btn_url'];
    $btnTitle = get_field('btn_group')['btn_title'];
    $btnDescr = get_field('btn_group')['btn_descr'];
    $html     = ($layout == 1) ?
                '<section class="ready-to container">
                    <div class="ready-to__title main-title main-middle-title">%1$s</div>
                    <div class="ready-to__btns button-description">
                        <div class="button-description__btn"><a href="%2$s">%3$s</a></div>
                        <div class="button-description__description">%4$s</div>
                    </div>
                </section>' :
                '<section class="white-brands container">
                    <div class="white-brands__title main-title main-middle-title margin-title">%1$s</div>
                    <div class="white-brands__description">%4$s</div>
                    <div class="white-brands__button">
                        <a href="%2$s" class="white-brands__btn"><span>%3$s</span><span class="white-brands__arrow"></span></a>
                    </div>
                </section>';

    echo sprintf(
        $html,
        $title,
        $btnUrl,
        $btnTitle,
        $btnDescr
    );
@endphp