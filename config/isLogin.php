<?php
    session_start();

    $root = dirname(__FILE__);
    require $root."/../config/config.php";
    require $root.'/../vendor/autoload.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    
    $user = array();


    if(isset($_COOKIE['access_token'])){
        try {

        $token = JWT::decode($_COOKIE['access_token'], new Key($secretKey, 'HS256'));
        
        $now = new DateTimeImmutable();
        $serverName = $_SERVER['SERVER_NAME'];

        if ($token->iss !== $serverName ||
            $token->nbf > $now->getTimestamp() ||
            $token->exp < $now->getTimestamp())
        {
            header("location:".$SERVER);
        } else{
            $user = $token->user;
        }
        } catch (Exception $e) {
            header("location:".$SERVER);
        }

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