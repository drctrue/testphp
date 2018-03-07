<?php
class Index extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->render('index');
    }

//    public function callme($a, $b, $c){
//        print_r($a);
//        echo 'param first ' . $a .'<br>';
//        echo 'param second ' . $b .'<br>';
//        echo 'param third ' . $c .'<br>';
//    }
}