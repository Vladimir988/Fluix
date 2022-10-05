

<section class="documents container">
    <div class="documents__row">
        <div class="documents__item">
            <div class="documents__title sub-title"><?php echo get_field('title') ?></div>
            <div class="documents__text main-text"><?php echo get_field('descr') ?></div>
        </div>
        <div class="documents__item">
            <div class="documents__image">
                <picture>
                    <source srcset="<?php echo e(get_field('image_group')['image_webp']); ?>" type="image/webp">
                    <img src="<?php echo e(get_field('image_group')['image']); ?>" alt="<?php echo e(get_field('title')); ?>" loading="lazy">
                </picture>
            </div>
        </div>
    </div>
    <div class="documents__tags">
        <div class="documents__tags-name">
            <span><?php echo e(get_field('tags_title')); ?></span>
        </div>
        <div class="documents__tags-row">
            <?php $tags = get_field( 'tags_array' ); ?>
            <?php if($tags): ?>
                <?php
                foreach($tags as $tag) {{
                    echo sprintf(
                      '<div class="documents__tag">%1$s</div>',
                      $tag->name
                    );
                }}
                ?>
            <?php endif; ?>
        </div>
    </div>
</section>