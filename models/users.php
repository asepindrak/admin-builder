<?php
    require_once("../lib/model.php");
    class Users {
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
            // $data->set_column($column);
            $result = $this->data->get();
            return $result;
        }

        
        function set(){
            $column = array(
                'username' => 'alpha',
                'name' => 'Alpha',
                'phone' => '12345',
            );
            $this->data->set_column($column);
            $result = $this->data->set();
            return $result;
        }

        
        function update(){
            $column = array(
                'username' => 'beta',
                'name' => 'Beta',
                'phone' => '54321',
            );
            $this->data->set_id("3");
            $this->data->set_column($column);
            $result = $this->data->update();
            return $result;
        }

        
        function delete(){
            $this->data->set_id("3");
            $result = $this->data->delete();
            return $result;
        }

        
        function restore(){
            $this->data->set_id("3");
            $result = $this->data->restore();
            return $result;
        }

    }

    $user = new Users();
    print_r($user->restore());