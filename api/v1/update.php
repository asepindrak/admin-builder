<?php
    $root = dirname(__FILE__);
    require 'models/models.php';
    require $root.'/../../../config/redirect.php';
    
    $root = dirname(__FILE__);
    require $root.'/../../config/isLogin.php';
    

    $data_query = "";
    if(isset($_POST)){
        $data = $_POST;
        $model = $_POST['model'];
        $route = $_POST['route'];
        $id = $_POST['id'];

        if(isset($_FILES)){
            $target_dir = "uploads/";
            $uploadOk = 1;
            $images = array();
            foreach($_FILES as $key => $value) {
                //php unique id
                $uid = md5(uniqid());
                $imageFileType = strtolower(pathinfo($_FILES[$key]["name"], PATHINFO_EXTENSION));
                $target_file = $target_dir . $uid . "." . $imageFileType;
                $check = getimagesize($_FILES[$key]["tmp_name"]);
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
                if ($_FILES[$key]["size"] > 500000) {
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
                    if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
                        echo "The file ". $uid. " has been uploaded.";
                        $images[$key] = $target_file;
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }


            }
            
            //loop $data
            foreach($data as $key => $value) {
                //skip if model/route/id
                if($key=='model'||$key=='route'||$key=='id'){
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

            
            //loop $images
            foreach($images as $key => $value) {
                //skip if model/route/id
                if($key=='model'||$key=='route'||$key=='id'){
                    continue;
                }
                //if empty, skip
                if(empty($value)) {
                    continue;
                }
                
                $data_query .= ", `$key` = '$value'";
            }
            //mysqli query update data
            $mysqli->query("UPDATE `$model` SET trash = 0 $data_query WHERE id = '$id' ");
        } else{
            //loop $data
            foreach($data as $key => $value) {
                //skip if model/route/id
                if($key=='model'||$key=='route'||$key=='id'){
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
            $mysqli->query("UPDATE `$model` SET trash = 0 $data_query WHERE id = '$id' ");

        }

        

        $status = array(
            "status" => "success",
            "message" => "Data updated."
        );
        return redirect($route, $status);
        
    } else{
        $status = array(
            "status" => "error",
            "message" => "You are not allowed!"
        );
        return redirect("login", $status);
    }
