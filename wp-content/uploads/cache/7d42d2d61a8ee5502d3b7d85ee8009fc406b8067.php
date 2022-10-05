

<?php $posts = get_field( 'posts_block_items' );?>
<?php if($posts): ?>
  <?php
  $i = 0;
  foreach($posts as $item) {
    $i++;
    $background    = ($i % 2 == 0) ? 'gray-bg' : '';
    $positionClass = ($i % 2 == 0) ? 'royal'   : 'diy';
    $orderClass    = ($i % 2 == 0) ? 'reverse' : '';
    $gallery = get_field( 'aditional-images', $item->ID );
    {
      echo sprintf(
        '<section class="information %6$s">
          <div class="container">
            <div class="information__wrapper %8$s">
              <div class="information__images">
                <div class="%7$s-position-1">
                    <img src="%1$s" alt="info" />
                </div>
                <div class="%7$s-position-2">
                    <img src="%2$s" alt="info" />
                </div>
              </div>
              <div class="information__description">
                <div class="information__description__logo">
                    <a href="%3$s" target="_blank"><img src="%4$s" alt="info logo"/></a>
                </div>
                <p class="information__description__text">%5$s</p>
              </div>
            </div>
          </div>
        </section>',
        $gallery[0]['sizes']['large'],
        $gallery[1]['sizes']['large'],
        get_permalink( $item->ID ),
        get_the_post_thumbnail_url( $item->ID, 'medium-thumb' ),
        str_replace( ['<p>', '</p>'], ['', ''], $item->post_content ),
        $background,
        $positionClass,
        $orderClass
      );
    }
  }
  ?>
<?php endif; ?>
