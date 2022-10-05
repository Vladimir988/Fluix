<?php namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$crewBlock = new FieldsBuilder('crew-block');

$crewBlock
    ->setLocation('block', '==', 'acf/crew-block');

$crewBlock
    ->addTextarea('title', [
        'label'     => __('Title', 'fluix'),
        'rows'      => 2,
        'new_lines' => 'br',
    ])
    ->addRepeater('crews', ['label' => ''])
        ->addGroup('crews_group', [
            'label'  => __('Crews'),
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

return $crewBlock;
