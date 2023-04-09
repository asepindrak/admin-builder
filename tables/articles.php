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
            'keyword', 
            'publish_date',
            'image'
        ),
        'titles' => array('Title', 'Category', 'Slug', 'Content', 'Keyword', 'Publish Date', 'Image'),
        'filters' => array(
            'title', 
            'category_id', 
            'keyword', 
            'date_range' => array('publish_date')
        ),
        'types' => array(
            'image' => 'image',
            'category_id' => array('article_categories'),
            'publish_date' => 'date'
        ),
        'isEdit' => true,
        'isTrash' => true,
    );