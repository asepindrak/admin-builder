<?php
    function redirect($page, $status){
        $_SESSION['status'] = $status;
        require 'config.php';
        require 'pages.php';
        if($page=="login"){
            $url = $SERVER;
            if($url){
                header('Location: ' . $url);
                die();
            }
        } else{
            $url = $SERVER."/page/".$pages[$page]['route'];
            if($url){
                header('Location: ' . $url);
                die();
            }
        }
        
    }

