<?php
    session_start();
    function redirect($page, $status){
        $_SESSION['status'] = $status;
        require 'pages.php';
        require 'config.php';
        $url = $SERVER.$pages[$page]['route'];
        if($url){
            header('Location: ' . $url);
            die();
        }
    }

