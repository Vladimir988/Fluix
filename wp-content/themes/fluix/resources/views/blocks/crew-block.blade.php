{{--
  Title: Crew block
  Description: Crew block
  Category: layout
  Icon: schedule
  Keywords: crew block
  Mode: edit
  Align: left
  PostTypes: page
  SupportsAlign: left right
  SupportsMode: true
  SupportsMultiple: true
--}}

<section class="running container">
    <div class="running__title main-title">@php echo get_field('title') @endphp</div>
    <div class="running__row">
        @php $crews = get_field( 'crews' ); @endphp
        @if ($crews)
        @php
        foreach($crews as $crew) {
          {
            echo sprintf(
              '<div class="running__item">
                  <div class="running__background">
                      <div class="running__icon">
                          <picture>
                              <source srcset="%1$s" type="image/webp">
                              <img src="%1$s" alt="%2$s" loading="lazy">
                          </picture>
                      </div>
                      <div class="running__item-title sub-title">%2$s</div>
                      <div class="running__description main-text">%3$s</div>
                  </div>
              </div>',
              $crew['crews_group']['image'],
              $crew['crews_group']['title'],
              $crew['crews_group']['descr']
            );
          }
        }
        @endphp
        @endif
    </div>
</section>



