<?php
    require 'api/v1/models/models.php';
    

    $filter_query = "";
    if(isset($_POST)){
        $filter = $_POST;
        //loop $filter
        $no = 0;
        foreach($filter as $key => $value) {
            //if empty, skip
            if(empty($value)) {
                continue;
            }
            if($no==0){
                $filter_query .= " WHERE `$key` like '%$value%'";
            } else{
                $filter_query .= " AND `$key` like '%$value%'";
            }
            $no++;
        }
    }

    //mysqli query get table
    $result = $mysqli->query("SELECT * FROM $model $filter_query");
