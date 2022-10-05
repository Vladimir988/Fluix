<?php namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$crewBlock = new FieldsBuilder('learn-more');

$crewBlock
    ->setLocation('block', '==', 'acf/learn-more');

$crewBlock
    ->addTextarea('title', [
        'label'     => __('Title', 'fluix'),
        'rows'      => 2,
        'new_lines' => 'br',
    ])
    ->addRepeater('learn', [
        'label' => '',
        'min' => 1,
        'max' => 4,
    ])
        ->addGroup('learn_group', [
            'label'  => __('Blocks'),
            'layout' => 'table',
        ])
        ->addText('title', ['label' => __('Title', 'fluix')])
        ->addText('btn_title', ['label' => __('Button Text', 'fluix')])
        ->addUrl('btn_url', ['label' => __('Button Url', 'fluix')])
        ->endGroup()
    ->endRepeater();

return $crewBlock;
