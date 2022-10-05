

<section class="grow-your container">
    <div class="grow-your__row">
        <div class="grow-your__item">
            <div class="grow-your__title main-title"><?php echo e(get_field('grow_title')); ?></div>
            <div class="grow-your__text main-text"><?php echo get_field('grow_descr') ?></div>
            <div class="grow-your__btns button-description">
                <div class="button-description__btn">
                    <a href="<?php echo e(get_field('btn_group')['btn_url']); ?>"><?php echo e(get_field('btn_group')['btn_title']); ?></a>
                </div>
                <div class="button-description__description"><?php echo get_field('btn_group')['btn_descr'] ?></div>
            </div>
        </div>
        <div class="grow-your__item">
            <div class="grow-your__image">
                <picture>
                    <source srcset="<?php echo e(get_field('image_group')['image_webp']); ?>" type="image/webp">
                    <img src="<?php echo e(get_field('image_group')['image']); ?>" alt="bitmap" loading="lazy">
                </picture>
            </div>
        </div>
    </div>
</section>