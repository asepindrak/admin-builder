<?php
    $tables['articles'] = array(
        'models' => array('title', 'slug', 'content', 'image'),
        'titles' => array('Title', 'Slug', 'Content', 'Image'),
        'filters' => array('title'),
        'types' => array(
            'image' => 'image'
        ),
        'isEdit' => true,
        'isTrash' => true,
    );