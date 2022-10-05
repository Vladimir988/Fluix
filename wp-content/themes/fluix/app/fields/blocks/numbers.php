<?php namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$numbers = new FieldsBuilder('numbers');

$numbers
    ->setLocation('block', '==', 'acf/numbers');

$numbers
    ->addText('title', ['label' => __('Title', 'fluix')])
    ->addRepeater('numbers', [
        'label' => '',
        'min'   => 1,
        'max'   => 4,
    ])
        ->addGroup('numbers_group', [
            'label'  => __('Numbers'),
            'layout' => 'table',
        ])
            ->addText('number_title', ['label' => __('Title', 'fluix')])
            ->addText('number', ['label' => __('Number', 'fluix')])
            ->addText('after', ['label' => __('After', 'fluix')])
            ->addTextarea('descr', [
                'label'     => __('Description', 'fluix'),
                'rows'      => 2,
                'new_lines' => 'br',
            ])
        ->endGroup()
    ->endRepeater();

return $numbers;
