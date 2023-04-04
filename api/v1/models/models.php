<?php
    
    $root = dirname(__FILE__);
    require $root.'/../config/db.php';
    $models = array();
    require 'users.php';
    require 'articles.php';