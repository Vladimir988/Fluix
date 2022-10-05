

<section class="contact">
  <div class="container">
    <h4 class="contact__title"><?php echo e(get_field('contact_form_title')); ?></h4>
    <h5 class="contact__subtitle"><?php echo e(get_field('contact_form_descr')); ?></h5>
    <?php
      $form = get_field( 'contact_form_shortcode' );
      if( has_shortcode( $form, 'contact-form-7' ) ) {
        echo do_shortcode( $form );
      }
    ?>
  </div>
</section>
