<?php
class Help extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->view->render('help');
    }
    public function other() {

        require 'model/help.php';
        $model = new HelpModel();
    }
}