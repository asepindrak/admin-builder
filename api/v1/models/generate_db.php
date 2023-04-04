<?php
    require 'models.php';

    //foreach models
    foreach($models as $model_name => $model) {
        
        var_dump($model);
        $table = $model_name;
        //get key of $model
        $keys = array_keys($model);
        $query_str = "id int(11) UNSIGNED NOT NULL AUTO_INCREMENT ";
        //foreach keys
        foreach($keys as $key) {

            $value = $model[$key];
            if($value == "text"){
                $query_str .= ", `$key` text NULL ";
            } else if($value == "datetime"){
                $query_str .= ", `$key` datetime NULL ";
            } else{
                //explode value
                $value_array = explode(" ", $value);
                //get key 0 as type, key 1 as length
                $type = $value_array[0];
                $length = $value_array[1];

                $query_str .= ", `$key` $type($length) NULL ";
            }

        }

        $query_str .= ", 
        `created_at`     DATETIME DEFAULT CURRENT_TIMESTAMP,
        `updated_at` DATETIME ON UPDATE CURRENT_TIMESTAMP, 
        `trash` tinyint(1) NOT NULL, 
        PRIMARY KEY (`id`) ";
    }

    $objects_table = 
    "CREATE TABLE IF NOT EXISTS `$table` (
        $query_str
    )";


    if ($mysqli->query($objects_table) === TRUE) {
        printf("Table $table successfully created.\n");
    }
