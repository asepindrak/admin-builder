<?php
    session_start();
    require "config/config.php";
    $user = array();
    if(isset($_COOKIE['user'])){
        $user = $_COOKIE['user'];
        $user = json_decode($user);
    } else{
        header("location:".$SERVER);
    }
    $message = "";
    if(isset($_SESSION['status'])){
        $status = $_SESSION['status'];
        if($status["status"]=="error"){
            $message = "<span class='alert alert-danger'>".$status["message"]."</span>";
        } else{
            $message = "<span class='alert alert-info'>".$status["message"]."</span>";
        }
        unset($_SESSION['status']);
    }