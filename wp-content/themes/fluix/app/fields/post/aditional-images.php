<?php namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$images = new FieldsBuilder('aditional-images');

$images
    ->setLocation('post_type', '==', 'post');

$images
    ->addGallery('aditional-images', [
        'label' => __('Gallery', 'fluix'),
        'max'   => '2',
    ]);

return $images;

