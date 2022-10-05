{{--
  Title: Focus block
  Description: Focus block
  Category: layout
  Icon: schedule
  Keywords: focus block
  Mode: edit
  Align: left
  PostTypes: page
  SupportsAlign: left right
  SupportsMode: true
  SupportsMultiple: true
--}}

<section class="focus-on container">
    <div class="focus-on__title main-title">@php echo get_field('title') @endphp</div>
    <div class="focus-on__row">
        @php $focus = get_field( 'focus' ); @endphp
        @if ($focus)
        @php
        $i = 0;
        foreach($focus as $crew) {
          {
            echo sprintf(
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
              $crew['focus_group']['image'],
              $crew['focus_group']['title'],
              $crew['focus_group']['descr']
            );
          }
          $i++;
          if($i >= 4) break;
        }
        @endphp
        @endif
    </div>
    <div class="focus-on__button">
        @php global $post; @endphp
        @if (count($focus) > 4)
        <a id="get_more_focus" class="focus-on__btn" href="#" data-post-id="{{$post->ID}}">
            <span>@php _e('And more…', 'fluix'); @endphp</span>
            <span class="focus-on__arrow"></span>
        </a>
        @endif
    </div>
</section>