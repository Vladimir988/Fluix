<?php namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$growBlock = new FieldsBuilder('grow-block');

$growBlock
    ->setLocation('block', '==', 'acf/grow-block');

$growBlock
    ->addText('grow_title', ['label' => __('Title', 'fluix')])
    ->addTextarea('grow_descr', [
        'label'     => __('Description', 'fluix'),
        'rows'      => 2,
        'new_lines' => 'br',
    ])
    ->addGroup('image_group', [
        'label'  => '',
        'layout' => 'table',
    ])
    ->addImage('image', [
        'return_format' => 'url',
    ])
    ->addImage('image_webp', [
        'return_format' => 'url',
    ])
    ->endGroup()
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

return $growBlock;
