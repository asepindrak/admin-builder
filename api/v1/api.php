<?php
    require 'api/v1/models/models.php';
    
    if($id!=""){
        $result = $mysqli->query("SELECT * FROM `$model` WHERE trash = 0 AND id = '$id' limit 1");
    } else{
        $filter_query = "";
        if(isset($_POST)){
            $filter = $_POST;
            //loop $filter
            foreach($filter as $key => $value) {
                //if empty, skip
                if(empty($value)) {
                    continue;
                }
                $filter_query .= " AND `$key` LIKE '%$value%'";
            }
        }

        //mysqli query get data
        $result = $mysqli->query("SELECT * FROM `$model` WHERE trash = 0 $filter_query");
    }
    
