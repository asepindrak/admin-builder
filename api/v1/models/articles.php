<?php
    $models['articles'] = array(
        'title' => 'text',
        'category_id' => array(
            'model' => 'article_categories',
            'type' => 'int(11)',
            'isNull' => true
        ),
        'slug' => 'text',
        'content' => 'text',
        'keyword' => 'text',
        'publish_date' => 'date',
        'image' => 'text'
    );