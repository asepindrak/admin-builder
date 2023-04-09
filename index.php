<?php

  
    require_once(__DIR__."/config/config.php");
    require_once(__DIR__."/routes/routes.php");
    if(isset($_GET['page'])){
        $params = explode( "/", $_GET['page'] );
        $page = $params[0];
        if($page=="pages-error-404"){
            require_once(__DIR__."/$page.php");
        } else if($page==""){
            require_once(__DIR__."/controllers/login.php");
        } else{
            if(!isset($routes[$page])){
                header("location:$SERVER/pages-error-404");
            } else{
                // echo __DIR__."/controllers/$routes[$page]";
                echo "";
                require_once(__DIR__."/controllers/$routes[$page]");
            }
        }
    } else{
        require_once(__DIR__."/controllers/login.php");
    }
    
    