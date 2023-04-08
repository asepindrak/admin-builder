<?php
    $tables['articles'] = array(
        'models' => array(
            'title', 
            'category_id' => array(
                'model' => 'article_categories',
                'id' => 'id',
                'value' => 'name'
            ),
            'slug', 
            'content', 
            'publish_date',
            'image'
        ),
        'titles' => array('Title', 'Category', 'Slug', 'Content', 'Publish Date', 'Image'),
        'filters' => array('title', 'publish_date'),
        'types' => array(
            'image' => 'image',
            'category_id' => 'select',
            'publish_date' => 'date'
        ),
        'isEdit' => true,
        'isTrash' => true,
    );