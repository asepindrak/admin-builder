<?php
    require_once("../lib/model.php");
    class UserModel {
        public $model;
        public $data;

        function __construct() {
            $this->model = 'users';
            $this->data = new Model();
            $this->data->set_model($this->model);
        }

        
        function get(){
            $column = array(
                'username' => 'column',
                'name' => 'column',
                'phone' => 'column',
            );
            $this->data->set_column($column);
            $result = $this->data->get();
            return $result;
        }

        
        function set($data){
            $column = array(
                'username' => $data['username'],
                'name' => $data['name'],
                'phone' => $data['phone'],
            );
            $this->data->set_column($column);
            $result = $this->data->set();
            return $result;
        }

        
        function update($data, $id){
            $column = array(
                'username' => $data['username'],
                'name' => $data['name'],
                'phone' => $data['phone'],
            );
            $this->data->set_id($id);
            $this->data->set_column($column);
            $result = $this->data->update();
            return $result;
        }

        
        function delete($id){
            $this->data->set_id($id);
            $result = $this->data->delete();
            return $result;
        }

        
        function restore($id){
            $this->data->set_id($id);
            $result = $this->data->restore();
            return $result;
        }

    }