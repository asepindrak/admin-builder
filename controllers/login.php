<?php
    session_start();
    $root = dirname(__FILE__);
    require $root.'/../config/db.php';
    require $root.'/../../../config/redirect.php';
    require $root.'/../../../config/config.php';
    require $root.'/../../../vendor/autoload.php';

    use Firebase\JWT\JWT;
    $issuedAt   = new DateTimeImmutable();
    $expire     = $issuedAt->modify('+7 days')->getTimestamp();      // Add 60 seconds
    $serverName = $_SERVER['SERVER_NAME'];
    //mysql login with username & password
    $username = $_POST["username"];
    $password = $_POST["password"];

    

    //check if $username && $password exist
    if(!$username || !$password) {
        $status = array(
            "status" => "error",
            "message" => "Please fill in all fields"
        );
        return redirect("login", $status);
    }

    //mysqli check if user exist
    $query = "SELECT * FROM users WHERE trash = 0 AND username = '" . $username . "' AND password = '" . md5($password) . "'";
    $result = $mysqli->query($query);
    
    if ($result->num_rows > 0) {
        $status = array(
            "status" => "success",
            "message" => "Login successful",
        );
        //get single row from result
        $row = $result->fetch_assoc();

        $data = [
            'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
            'iss'  => $serverName,                       // Issuer
            'nbf'  => $issuedAt->getTimestamp(),         // Not before
            'exp'  => $expire,                           // Expire
            'user' => $row,             // User name
        ];

        $access_token = JWT::encode(
            $data,
            $secretKey,
            'HS256'
        );

        setcookie('access_token', $access_token, time() + (86400 * 30), "/"); // 86400 = 1 day
        return redirect("dashboard", $status);
    } else{
        $status = array(
            "status" => "error",
            "message" => "Login failed"
        );
        setcookie('access_token', "", time() + (86400 * 30), "/"); // 86400 = 1 day

        return redirect("login", $status);

    }
    

    