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
            'image'
        ),
        'titles' => array('Title', 'Category', 'Slug', 'Content', 'Image'),
        'filters' => array('title'),
        'types' => array(
            'image' => 'image',
            'category_id' => 'select'
        ),
        'isEdit' => true,
        'isTrash' => true,
    );