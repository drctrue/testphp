<?php
class Error extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        echo "Controller Error";
        $this->view->msg = "Такой страницы не существует";
        $this->view->render('error');
    }
}