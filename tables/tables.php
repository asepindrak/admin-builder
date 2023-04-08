<?php
    
    $tables = array();

    //add require tables here
    require 'users.php';
    require 'articles.php';
    require 'article_categories.php';




    //do not edit this line
    if(!$isDashboard){
        require 'api/v1/api.php';
    } else{
        require 'api/v1/dashboard.php';
    }