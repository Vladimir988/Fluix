{{--
  Title: Numbers
  Description: Numbers
  Category: layout
  Icon: dashboard
  Keywords: numbers counter
  Mode: edit
  Align: left
  PostTypes: page
  SupportsAlign: left right
  SupportsMode: true
  SupportsMultiple: true
--}}

@php
        
         $numbers = get_field( 'numbers' ); 


        @endphp

<section class="numbers container">
    <div class="numbers__title main-title">@php echo get_field('title') @endphp</div>
    <div class="numbers__content">
        @php $numbers = get_field( 'numbers' ); @endphp
        @if ($numbers)
            @php
            foreach($numbers as $crew) {{
                $separator = '';
                $pos       = '';
                if(strstr($crew['numbers_group']['number'], '.') !== false) {
                    $separator = '.';
                    $pos       = strlen(substr(strstr($crew['numbers_group']['number'], '.'), 1));
                } elseif(strstr($crew['numbers_group']['number'], ',') !== false) {
                    $separator = ',';
                    $pos       = strlen(substr(strstr($crew['numbers_group']['number'], ','), 1));
                }

                echo sprintf(
                  '<div class="numbers__item">
                      <div class="numbers__head sub-title">%1$s</div>
                      <div class="numbers__number"><i data-separator="%5$s" data-pos="%6$s">%2$s</i><span>%3$s</span></div>
                      <div class="numbers__description">%4$s</div>
                  </div>',
                  $crew['numbers_group']['number_title'],
                  str_replace(['.', ','], '', $crew['numbers_group']['number']),
                  $crew['numbers_group']['after'],
                  $crew['numbers_group']['descr'],
                  $separator,
                  $pos
                );
            }}
            @endphp
        @endif
    </div>
</section>