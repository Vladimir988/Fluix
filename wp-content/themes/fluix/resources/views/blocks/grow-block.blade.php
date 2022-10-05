{{--
  Title: Grow block
  Description: Grow block
  Category: layout
  Icon: align-pull-right
  Keywords: grow block
  Mode: edit
  Align: left
  PostTypes: page
  SupportsAlign: left right
  SupportsMode: true
  SupportsMultiple: true
--}}

<section class="grow-your container">
    <div class="grow-your__row">
        <div class="grow-your__item">
            <div class="grow-your__title main-title">{{ get_field('grow_title') }}</div>
            <div class="grow-your__text main-text">@php echo get_field('grow_descr') @endphp</div>
            <div class="grow-your__btns button-description">
                <div class="button-description__btn">
                    <a href="{{ get_field('btn_group')['btn_url'] }}">{{ get_field('btn_group')['btn_title'] }}</a>
                </div>
                <div class="button-description__description">@php echo get_field('btn_group')['btn_descr'] @endphp</div>
            </div>
        </div>
        <div class="grow-your__item">
            <div class="grow-your__image">
                <picture>
                    <source srcset="{{ get_field('image_group')['image_webp'] }}" type="image/webp">
                    <img src="{{ get_field('image_group')['image'] }}" alt="bitmap" loading="lazy">
                </picture>
            </div>
        </div>
    </div>
</section>