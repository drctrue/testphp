<?php

class Controller
{

    public $vars = array();

    public function __construct()
    {
//        echo "Main Controller";
        $this->view = new View();
    }

    public function loadModel($name)
    {
        $path = 'model/' . $name . '.php';
        if (file_exists($path)) {
            require 'model/' . $name . '.php';
            $modelName = 'Model' . $name;
            //print_r($modelName);
            $this->model = new $modelName();
        }
    }
}
