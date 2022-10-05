<?php namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$getStart = new FieldsBuilder('get-start-block');

$getStart
    ->setLocation('block', '==', 'acf/get-start-block');

$getStart
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
    ->addText('title', ['label' => __('Title', 'fluix')])
    ->addGroup('btn_group', [
        'label'  => __('Button'),
        'layout' => 'table',
    ])
    ->addText('btn_title', ['label' => __('Text', 'fluix')])
    ->addUrl('btn_url', ['label' => __('Url', 'fluix')])
    ->addTextarea('btn_descr', [
        'label'     => __('Description', 'fluix'),
        'rows'      => 2,
        'new_lines' => 'br',
    ])
    ->endGroup();

return $getStart;
