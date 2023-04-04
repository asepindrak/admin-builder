<?php
    $pages = array();
    $pages["dashboard"] = array(
        'name' => 'Dashboard',
        'route' => 'dashboard',
        'isMenu' => true
    );
    $pages["users"] = array(
        'name' => 'User',
        'route' => 'users',
        'model' => 'users',
        'isMenu' => true
    );
    $pages["articles"] = array(
        'name' => 'Article',
        'route' => 'articles',
        'model' => 'articles',
        'isMenu' => true
    );