{{--
  Title: Learn more block
  Description: Learn more block
  Category: layout
  Icon: align-wide
  Keywords: learn more block
  Mode: edit
  Align: left
  PostTypes: page
  SupportsAlign: left right
  SupportsMode: true
  SupportsMultiple: true
--}}

<section class="learn container">
    <div class="learn__title main-title">@php echo get_field('title') @endphp</div>
    <div class="learn__row">
        @php $learn = get_field( 'learn' ); @endphp
        @if ($learn)
        @php
            foreach($learn as $crew) {
              {
                echo sprintf(
                  '<a href="%2$s" class="learn__item">
                      <div class="learn__description">%1$s</div>
                      <div class="learn__link">
                          <span>%3$s</span>
                      </div>
                  </a>',
                  $crew['learn_group']['title'],
                  $crew['learn_group']['btn_url'],
                  $crew['learn_group']['btn_title']
                );
              }
            }
        @endphp
        @endif
    </div>
</section>