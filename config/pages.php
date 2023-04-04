<?php
    $pages = array();
    $pages["dashboard"] = array(
        'name' => 'Dashboard',
        'route' => 'dashboard',
        'isMenu' => true,
        'icon' => 'bi bi-grid'
    );
    $pages["users"] = array(
        'name' => 'User',
        'route' => 'users',
        'model' => 'users',
        'isMenu' => true,
        'icon' => 'bi bi-people'
    );
    $pages["articles"] = array(
        'name' => 'Article',
        'route' => 'articles',
        'model' => 'articles',
        'isMenu' => true,
        'icon' => 'bi bi-newspaper'
    );
    $pages["product_categories"] = array(
        'name' => 'Product Category',
        'route' => 'product_categories',
        'model' => 'product_categories',
        'isMenu' => true,
        'icon' => 'bi bi-box'
    );