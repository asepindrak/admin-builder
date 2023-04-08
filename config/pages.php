<?php
    $pages = array();
    $pages["dashboard"] = array(
        'name' => 'Dashboard',
        'route' => 'dashboard',
        'isMenu' => true,
        'icon' => 'bi bi-grid',
    );
    $pages["users"] = array(
        'name' => 'User',
        'route' => 'users',
        'model' => 'users',
        'isMenu' => true,
        'icon' => 'bi bi-people'
    );




    //add pages here

    $pages["articles"] = array(
        'name' => 'Article',
        'route' => 'articles',
        'model' => 'articles',
        'isMenu' => true,
        'icon' => 'bi bi-newspaper'
    );
    $pages["article_categories"] = array(
        'name' => 'Article Category',
        'route' => 'article_categories',
        'model' => 'article_categories',
        'isMenu' => true,
        'icon' => 'bi bi-box'
    );