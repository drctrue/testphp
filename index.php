<?php

require 'lib/route.php';
require 'lib/controller.php';
require 'lib/view.php';
require 'lib/model.php';
require 'lib/database.php';
require 'config/paths.php';
$path_obj = new Route();

//if(isset($_GET['route'])){
//    $add_controller = $path_obj->get_controller($_GET['route']);
//} else {
//    $add_controller = 'index';
//}
//
//$path_obj->includder($add_controller);