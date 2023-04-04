<?php
    $pages = array();
    $pages["dashboard"] = array(
        'route' => '/dashboard'
    );
    $pages["user"] = array(
        'route' => '/user',
        'model' => 'users'
    );
    $pages["article"] = array(
        'route' => '/article',
        'model' => 'articles'
    );