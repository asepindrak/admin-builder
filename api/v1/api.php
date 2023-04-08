<?php
    require 'api/v1/models/models.php';
    
    if($id!=""){
        $fields = $models[$model];
        $select = "$model.id, $model.created_at, $model.updated_at, $model.trash" ;
        foreach($fields as $field_name => $field) {
            if(is_array($field)){
                $field_model = $field['model'];
                $includes = $models[$field_model];
                $include_field = "'id', id";
                foreach($includes as $include_name => $include) {
                    $include_field .= ", '$include_name', $include_name";
                }

                $select .= ", (SELECT JSON_ARRAYAGG(JSON_OBJECT($include_field)) FROM `$field_model` WHERE trash = 0 AND id = $field_name) as $field_model ";
            } else{
                $select .= ", ".$model.".".$field_name;
            }
        }
        $result = $mysqli->query("SELECT $select FROM `$model` WHERE trash = 0 AND id = '$id' limit 1");
    } else if(is_array($model)){
        
        
    } else{
        $filter_query = "";
        if(isset($_POST)){
            $filter = $_POST;
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

        $fields = $models[$model];
        $select = "$model.id, $model.created_at, $model.updated_at, $model.trash" ;
        foreach($fields as $field_name => $field) {
            if(is_array($field)){
                $field_model = $field['model'];
                $includes = $models[$field_model];
                $include_field = "'id', id";
                foreach($includes as $include_name => $include) {
                    $include_field .= ", '$include_name', $include_name";
                }

                $select .= ", (SELECT JSON_ARRAYAGG(JSON_OBJECT($include_field)) FROM `$field_model` WHERE trash = 0 AND id = $field_name) as $field_model ";
            } else{
                $select .= ", ".$model.".".$field_name;
            }
        }
        //mysqli query get data
        $result = $mysqli->query("SELECT $select FROM `$model` WHERE trash = 0 $filter_query");
    }
    
