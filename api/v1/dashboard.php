<?php
    require 'api/v1/models/models.php';
    
    $root = dirname(__FILE__);
    require $root.'/../../config/isLogin.php';

    $dashboard_data = array();
    foreach($tables as $key => $value){
        $result = $mysqli->query("SELECT count(*) as total FROM `$key` WHERE trash = 0");
        if ($result->num_rows > 0) {
            //get single row from result
            $row = $result->fetch_assoc();
            $dashboard_data[$key] = $row['total'];
        }
        
    }
    
