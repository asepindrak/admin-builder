<?php
    $root = dirname(__FILE__);
    require $root.'/../config/db.php';
    require $root.'/../../../config/redirect.php';

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
        return redirect("dashboard", $status);
    }
    
    $status = array(
        "status" => "error",
        "message" => "Login failed"
    );

    return redirect("login", $status);
    

    