<?php
    if(isset($_GET['page'])){
        $params = $_GET['page'];
        $params = explode( "/", $_GET['page'] );
        $page = $params[0];
        if(!isset($pages[$page])){
            header("location:".$SERVER."/pages-error-404.php");
        }
    }