<?php

class Registration extends Controller
{

    private $error = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $result_region = $this->model->getRegion();

        $region = array();
        foreach ($result_region as $result_r) {
            $region[] = array(
                'region_id' => $result_r['ter_id'],
                'region_name' => $result_r['ter_name']
            );
        }

        $this->view->vars('region', $region);
        $this->view->render('registration', false);
    }


    public function ajaxCities()
    {
        $json_response = [
            'success' => false,
            'response' => [],
            'error' => ''
        ];

        $ter_id = $_POST["ter_id"];
        if ($ter_id) {
            $result_cities = $this->model->getCity($ter_id);
            if($result_cities) {
                foreach ($result_cities as $result_c) {
                    $json_response['response'][] = array(
                        'city_id' => $result_c['ter_id'],
                        'city_name' => $result_c['ter_name']
                    );
                }

                if($json_response['response']) {
                    $json_response['success'] = true;
                } else {
                    $json_response['error'] = 'Empty city';
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($json_response);
        die();
    }

    public function ajaxDistricts()
    {
        $json_response = [
            'success' => false,
            'response' => [],
            'error' => ''
        ];

        $city_id = $_POST['city_id'];
        if ($city_id) {
            $result_dist = $this->model->getDistricts($city_id);
            if ($result_dist != NULL) {
                foreach ($result_dist as $result_d) {
                    $json_response['response'][] = array(
                        'district_id' => $result_d['ter_id'],
                        'district_name' => $result_d['ter_name']
                    );
                }

                if($json_response['response']) {
                    $json_response['success'] = true;
                }

            } else {
                $json_response['error'] = 'Error! No District in db';
            }
        }

        header('Content-Type: application/json');
        echo json_encode($json_response);
        die();
    }


    public function ajaxRegistration()
    {
        $json = array();

        if (isset($_POST['name']) && isset($_POST['email'])) {

            $name = trim($_POST['name']);
            $email = trim($_POST['email']);

            if (isset($_POST['dist_select'])) {
                $location = $_POST['dist_select'];
                $location = $this->model->getAddress($location);
            } else {
                $location = $_POST['city_select'];
                $location = $this->model->getAddress($location);
            }

            if (!$this->model->isExistEmail($_POST['email'])) {

                $this->model->regNewUser($name, $email, $location['ter_id']);
                $json['success'] = true ;

            } else {

                $user_info = $this->model->userInfo($email);
                $json['success'] = 'false' ;
                $json['user_info'] = $user_info;

            }
        } else {
            $json['error'] = $this->error;
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }
}
