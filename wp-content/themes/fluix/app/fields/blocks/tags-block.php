<?php namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$tagsBlock = new FieldsBuilder('tags-block');

$tagsBlock
    ->setLocation('block', '==', 'acf/tags-block');

$tagsBlock
    ->addText('title', ['label' => __('Title', 'fluix')])
    ->addTextarea('descr', [
        'label'     => __('Description', 'fluix'),
        'rows'      => 3,
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
    ->addText('tags_title', ['label' => __('Tags title', 'fluix')])
    ->addTaxonomy('tags_array', [
        'label'         => __('Tags', 'fluix'),
        'taxonomy'      => 'page_tag',
        'field_type'    => 'multi_select',
        'add_term'      => 1,
        'save_terms'    => 0,
        'load_terms'    => 0,
        'return_format' => 'object',
    ]);

return $tagsBlock;