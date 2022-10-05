<?php namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$focusBlock = new FieldsBuilder('focus-block');

$focusBlock
    ->setLocation('block', '==', 'acf/focus-block');

$focusBlock
    ->addTextarea('title', [
        'label'     => __('Title', 'fluix'),
        'rows'      => 2,
        'new_lines' => 'br',
    ])
    ->addRepeater('focus', ['label' => ''])
        ->addGroup('focus_group', [
            'label'  => __('Blocks'),
            'layout' => 'table',
        ])
            ->addImage('image', [
                'return_format' => 'url',
            ])
            ->addText('title', ['label' => __('Title', 'fluix')])
            ->addTextarea('descr', [
                'label'     => __('Description', 'fluix'),
                'rows'      => 5,
                'new_lines' => 'br',
            ])
        ->endGroup()
    ->endRepeater();

return $focusBlock;
