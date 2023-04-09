<?php
    class Model {
        public $model;
        public $column;
        public $filter;
        public $files;
        public $id;

        function __construct() {
            $this->model = "";
            $this->column = array();
            $this->filter = array();
            $this->files = array();
            $this->id = "";
        }

        function set_model($model){
            $this->model = $model;
        }

        function set_column($column){
            $this->column = $column;
        }

        function set_filter($filter){
            $this->filter = $filter;
        }

        function set_files($files){
            $this->files = $files;
        }

        function set_id($id){
            $this->id = $id;
        }

        function get(){
            require_once('../config/db.php');
            $filter_query = "";
            if(!empty($this->filter)){
                $filter = array();
                if($this->filter){
                    $filter = $this->filter;
                }
                //loop $filter
                foreach($filter as $key => $value) {
                    //if date range
                    if (str_contains($key, 'date_from_')) {
                        if(empty($value)) {
                            continue;
                        }
                        $date_to = str_replace("date_from_", "date_to_", $key);
                        if(empty($filter[$date_to])) {
                            continue;
                        }
                        $column = str_replace("date_from_", "", $key);
                        $to_value = $filter['date_to_'.$column];
                        $filter_query .= " AND DATE(`$column`) BETWEEN '$value' AND '$to_value'";
                        continue;
                    }
                    //skip date to
                    if (str_contains($key, 'date_to_')) {
                        continue;
                    }
                    //if empty, skip
                    if(empty($value)) {
                        continue;
                    }
                    if (!str_contains($key, 'date_from_') && !str_contains($key, 'date_to_')) {
                        $filter_query .= " AND `$key` LIKE '%$value%'";
                    }
                    
                }
            }

            $model = $this->model;
            $column = $this->column;

            if(empty($column) || empty($model)){
                return array();
            }

            $select = "$model.id, $model.created_at, $model.updated_at, $model.trash" ;
            if(empty($column)){
                $select = "*";
            }
            foreach($column as $column_name => $column) {
                if(is_array($column)){
                    $column_model = $column['model'];
                    $includes = $models[$column_model];
                    $include_column = "'id', id";
                    foreach($includes as $include_name => $include) {
                        $include_column .= ", '$include_name', $include_name";
                    }

                    $select .= ", (SELECT JSON_ARRAYAGG(JSON_OBJECT($include_column)) FROM `$column_model` WHERE trash = 0 AND id = $column_name) as $column_model ";
                } else{
                    $select .= ", ".$model.".".$column_name;
                }
            }
            //mysqli query get data
            $result = $mysqli->query("SELECT $select FROM `$model` WHERE trash = 0 $filter_query");
            $data = array();
            //loop result
            while ($row=$result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }

        function set(){
            require_once('../config/db.php');

            $model = $this->model;
            $column = $this->column;
            $result = false;

            if(empty($column) || empty($model)){
                return false;
            }

            if(!empty($files)){
                $target_dir = "../uploads/";
                $uploadOk = 1;
                $images = array();
                foreach($files as $key => $value) {
                    //php unique id
                    $uid = md5(uniqid());
                    $imageFileType = strtolower(pathinfo($files[$key]["name"], PATHINFO_EXTENSION));
                    $target_file = $target_dir . $uid . "." . $imageFileType;
                    $check = getimagesize($files[$key]["tmp_name"]);
                    if($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                    // Check if file already exists
                    if (file_exists($target_file)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }

                    // Check file size
                    if ($files[$key]["size"] > 500000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }

                    // // Allow certain file formats
                    // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    // && $imageFileType != "gif" ) {
                    //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    //     $uploadOk = 0;
                    // }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($files[$key]["tmp_name"], $target_file)) {
                            echo "The file ". $uid. " has been uploaded.";
                            $images[$key] = $target_file;
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }


                }
                
                //loop $data
                foreach($column as $key => $value) {
                    //skip if model/route
                    if($key=='model'||$key=='route'){
                        continue;
                    }
                    //if empty, skip
                    if(empty($value)) {
                        continue;
                    }

                    $data_query .= ", `$key` = '$value'";
                    
                    
                }

                
                //loop $images
                foreach($images as $key => $value) {
                    
                    //if empty, skip
                    if(empty($value)) {
                        continue;
                    }
                    
                    $data_query .= ", `$key` = '$value'";
                }
                //mysqli query insert data
                $result = $mysqli->query("INSERT INTO `$model` SET trash = 0 $data_query");
            } else{
                //loop $data
                foreach($column as $key => $value) {
                    //skip if model/route
                    if($key=='model'||$key=='route'){
                        continue;
                    }
                    //if empty, skip
                    if(empty($value)) {
                        continue;
                    }

                    if($key=='password'){
                        $data_query .= ", `$key` = md5('$value')";
                    } else{
                        $data_query .= ", `$key` = '$value'";
                    }
                }
                

                //mysqli query insert data
                $result = $mysqli->query("INSERT INTO `$model` SET trash = 0 $data_query");

            }

            if($result){
                return true;
            } else{
                return false;
            }
        }

        function update(){
            require_once('../config/db.php');

            $id = $this->id;
            $model = $this->model;
            $column = $this->column;
            $result = false;

            if(empty($id) || empty($column) || empty($model)){
                return false;
            }

            if(!empty($files)){
                $target_dir = "../uploads/";
                $uploadOk = 1;
                $images = array();
                foreach($files as $key => $value) {
                    //php unique id
                    $uid = md5(uniqid());
                    $imageFileType = strtolower(pathinfo($files[$key]["name"], PATHINFO_EXTENSION));
                    $target_file = $target_dir . $uid . "." . $imageFileType;
                    $check = getimagesize($files[$key]["tmp_name"]);
                    if($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                    // Check if file already exists
                    if (file_exists($target_file)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }

                    // Check file size
                    if ($files[$key]["size"] > 500000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }

                    // // Allow certain file formats
                    // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    // && $imageFileType != "gif" ) {
                    //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    //     $uploadOk = 0;
                    // }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($files[$key]["tmp_name"], $target_file)) {
                            echo "The file ". $uid. " has been uploaded.";
                            $images[$key] = $target_file;
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }


                }
                
                //loop $data
                foreach($column as $key => $value) {
                    //skip if model/route
                    if($key=='model'||$key=='route'){
                        continue;
                    }
                    //if empty, skip
                    if(empty($value)) {
                        continue;
                    }

                    $data_query .= ", `$key` = '$value'";
                    
                    
                }

                
                //loop $images
                foreach($images as $key => $value) {
                    
                    //if empty, skip
                    if(empty($value)) {
                        continue;
                    }
                    
                    $data_query .= ", `$key` = '$value'";
                }
                //mysqli query update data
                $result = $mysqli->query("UPDATE `$model` SET trash = 0 $data_query WHERE id = '$id' ");
            } else{
                //loop $data
                foreach($column as $key => $value) {
                    //skip if model/route
                    if($key=='model'||$key=='route'){
                        continue;
                    }
                    //if empty, skip
                    if(empty($value)) {
                        continue;
                    }

                    if($key=='password'){
                        $data_query .= ", `$key` = md5('$value')";
                    } else{
                        $data_query .= ", `$key` = '$value'";
                    }
                }
                

                //mysqli query update data
                $result = $mysqli->query("UPDATE `$model` SET trash = 0 $data_query WHERE id = '$id'  ");

            }

            if($result){
                return true;
            } else{
                return false;
            }
        }

        function delete() {
            require_once('../config/db.php');

            $id = $this->id;
            $model = $this->model;
            $result = false;

            if(empty($id) || empty($model)){
                return false;
            }

            //mysqli query update data
            $result = $mysqli->query("UPDATE `$model` SET trash = 1 WHERE id = '$id'  ");
            return true;
        }

        function restore() {
            require_once('../config/db.php');

            $id = $this->id;
            $model = $this->model;
            $result = false;

            if(empty($id) || empty($model)){
                return false;
            }

            //mysqli query update data
            $result = $mysqli->query("UPDATE `$model` SET trash = 0 WHERE id = '$id'  ");
            return true;
        }
    }

 