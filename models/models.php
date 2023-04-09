<?php
    
    //do not edit this line
    $root = dirname(__FILE__);
    require $root.'/../config/db.php';
    $models = array();



    //add require models here
    require 'users.php';
    require 'article_categories.php';
    require 'articles.php';