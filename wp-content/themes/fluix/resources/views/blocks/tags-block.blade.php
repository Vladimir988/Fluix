{{--
  Title: Tags block
  Description: Tags block
  Category: layout
  Icon: align-right
  Keywords: tags block
  Mode: edit
  Align: left
  PostTypes: page
  SupportsAlign: left right
  SupportsMode: true
  SupportsMultiple: true
--}}

<section class="documents container">
    <div class="documents__row">
        <div class="documents__item">
            <div class="documents__title sub-title">@php echo get_field('title') @endphp</div>
            <div class="documents__text main-text">@php echo get_field('descr') @endphp</div>
        </div>
        <div class="documents__item">
            <div class="documents__image">
                <picture>
                    <source srcset="{{ get_field('image_group')['image_webp'] }}" type="image/webp">
                    <img src="{{ get_field('image_group')['image'] }}" alt="{{ get_field('title') }}" loading="lazy">
                </picture>
            </div>
        </div>
    </div>
    <div class="documents__tags">
        <div class="documents__tags-name">
            <span>{{ get_field('tags_title') }}</span>
        </div>
        <div class="documents__tags-row">
            @php $tags = get_field( 'tags_array' ); @endphp
            @if ($tags)
                @php
                foreach($tags as $tag) {{
                    echo sprintf(
                      '<div class="documents__tag">%1$s</div>',
                      $tag->name
                    );
                }}
                @endphp
            @endif
        </div>
    </div>
</section>