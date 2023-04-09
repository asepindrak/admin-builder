<?php
    session_start();
    require "config/config.php";
    $user = array();
    if(isset($_COOKIE['user'])){
        $user = $_COOKIE['user'];
        $user = json_decode($user);
        header("location:".$SERVER."/page/dashboard");
    }