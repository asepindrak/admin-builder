<?php
    $root = dirname(__FILE__);
    require 'models/models.php';
    require $root.'/../../../config/redirect.php';
    
    $root = dirname(__FILE__);
    require $root.'/../../config/isLogin.php';
    
    
    if(isset($_GET)){
        $model = $_GET['model'];
        $route = $_GET['route'];
        $id = $_GET['id'];

        //mysqli query delete data
        $result = $mysqli->query("UPDATE `$model` SET trash = 1 WHERE id = '$id' ");

        $status = array(
            "status" => "success",
            "message" => "Data deleted."
        );
        return redirect($route, $status);
    } else{
        $status = array(
            "status" => "error",
            "message" => "You are not allowed!"
        );
        return redirect("login", $status);
    }
