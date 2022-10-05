<?php namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$imageSvg = new FieldsBuilder('image-svg');

$imageSvg
    ->setLocation('block', '==', 'acf/image-svg');

$imageSvg
    ->addRadio('layout', [
        'label'         => __('Layout version:', 'fluix'),
        'choices'       => [
            '1',
            '2',
        ],
        'default_value' => '1',
        'layout'        => 'horizontal',
        'return_format' => 'value',
    ])
    ->addText('title', [
        'label'             => __('Title', 'fluix'),
        'conditional_logic' => [
            [
                [
                    'field'    => 'layout',
                    'operator' => '==',
                    'value'    => '2',
                ],
            ],
        ],
    ])
    ->addImage('image', [
        'label'         => __('Image', 'fluix'),
        'preview_size'  => 'full',
        'return_format' => 'url',
    ]);

return $imageSvg;
