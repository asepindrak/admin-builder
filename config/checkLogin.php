<?php
    session_start();
    require "config/config.php";
    require 'vendor/autoload.php';

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
            
        } else{
            $user = $token->user;
            header("location:".$SERVER."/page/dashboard");
        }
        } catch (Exception $e) {
        }

    }