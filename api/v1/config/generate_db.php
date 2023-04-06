<?php
    $root = dirname(__FILE__);
    require $root.'/../models/models.php';

    //foreach models
    foreach($models as $model_name => $model) {
        $query_foreign = array();
        var_dump($model);
        $table = $model_name;
        //get key of $model
        $keys = array_keys($model);
        $query_str = "id int(11) UNSIGNED NOT NULL AUTO_INCREMENT ";
        //foreach keys
        foreach($keys as $key) {

            $value = $model[$key];
            if(is_array($value)){
                $foreign_model = $value['model'];
                $type = $value['type'];
                $isNull = $value['isNull'] ? 'NULL': '';
                $query_str .= ", `$key` $type UNSIGNED $isNull ";
                $fk_name = "fk_".$foreign_model;
                //push query for add associations
                $query_foreign[$foreign_model] = "ALTER TABLE `$table` ADD FOREIGN KEY (`$key`) REFERENCES $foreign_model(id) ON DELETE CASCADE";
            
            } else if($value == "text"){

                $query_str .= ", `$key` text NULL ";

            } else if($value == "date"){

                $query_str .= ", `$key` date NULL ";

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

        $objects_table = 
        "CREATE TABLE IF NOT EXISTS `$table` (
            $query_str
        ) ENGINE=INNODB";


        if ($mysqli->query($objects_table) === TRUE) {
            printf("Table $table successfully created.\n");
            foreach($query_foreign as $foreign => $query_list) {
                if ($mysqli->query($query_list) === TRUE) {
                    printf("Foreign $foreign successfully created.\n");
                }
            }
        }

        
        

        if($table=='users'){
            $checkUser = "SELECT * FROM users limit 1";
            $result = $mysqli->query($checkUser);
            //check length result
            if($result->num_rows == 0){
                //insert seed users
                $query = "INSERT INTO users (username, password, email, image) VALUES ('admin', md5('admin'), 'admin@admin.com', 'uploads/profile.jpg')";
                $mysqli->query($query);
            }
        }
    }
