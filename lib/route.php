<?php

/* $url[0] - controller's name
 * $url[1]($url[2]) - method and arg
 */
class Route {

    public function __construct()
    {
        $url = isset($_GET['route']) ? $_GET['route'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $file = 'controller/' . $url[0] . '.php';

        if(empty($url[0])) {
            require 'controller/index.php';
            $controller = new Index();
            $controller->index();
            return false;
        }

        if(file_exists($file)) {
            require $file;
        } else {
            require 'controller/error.php';
            $controller = new Error;
            return false;
        }

        $controller = new $url[0];
        $controller->loadModel($url[0]);

        if(isset($url[2])) {
            if(method_exists($controller, $url[1])) {
                $controller->{$url[1]}($url[2]);
            } else {
                echo 'Error!';
            }
        } else {
            if(isset($url[1])) {
                $controller->{$url[1]}();
            } else {
                $controller->index();
            }
        }

//        if (isset($url[2])) {
//            if (method_exists($controller, $url[1])) {
//                $params = array();
//                $length = count($url);
//                for ($i = 1; $i < $length; $i++) {
//                    array_push($params, $url[$i]);
//                }
//                foreach ($params as $param) {
//                    echo $param . '<br>';
//                }
//                $controller->{$url[1]}($params);
//            } else {
//                echo 'Error!';
//            }
//        } else {
//            if (isset($url[1])) {
//                $controller->{$url[1]}();
//            } else {
//                $controller->index();
//            }
//        }


    }

}


