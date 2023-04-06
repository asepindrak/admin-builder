<?php
    
    $root = dirname(__FILE__);
    require $root.'/../config/db.php';
    $models = array();
    require 'users.php';
    require 'article_categories.php';
    require 'articles.php';