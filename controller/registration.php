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
        echo $region[2]['ter_id'];
        $result_cities = $this->model->getCity($region[1]['region_id']);
        //var_dump ($result_cities);
        $city = array();
        foreach ($result_cities as $result_c) {
            $city[] = array(
                'city_id' => $result_c['ter_id'],
                'city_name' => $result_c['ter_name']
            );
        }
        $this->view->vars('cities', $city);
        $this->view->vars('region', $region);
        $this->view->render('registration', false);
    }

    public function ajaxCities()
    {
        if (!empty($_POST["ter_id"])) {
            $data = '<select id="city_select" name="city_select" onselect="" class="chosen-select">';
            $result_cities = $this->model->getCity($_POST['ter_id']);
            $city = array();
            foreach ($result_cities as $result_c) {
                $city[] = array(
                    'city_id' => $result_c['ter_id'],
                    'city_name' => $result_c['ter_name']
                );
            }

            foreach ($city as $value) {
                $data = $data . "<option value=" . $value['city_id'] . ">" . $value['city_name'] . "</option>";
            }

            $data = $data . "</select>";

            echo $data;
        }
    }

    public function ajaxDistricts()
    {
        if (!empty($_POST["city_id"])) {
            $data = '<select id="dist_select" name="dist_select" onselect="" class="chosen-select">';
            $result_dist = $this->model->getDistricts($_POST['city_id']);
            if (!$result_dist == NULL) {
                $dist = array();
                foreach ($result_dist as $result_d) {
                    $dist[] = array(
                        'district_id' => $result_d['ter_id'],
                        'district_name' => $result_d['ter_name']
                    );
                }

                foreach ($dist as $value) {
                    $data = $data . "<option value=" . $value['district_id'] . ">" . $value['district_name'] . "</option>";
                }

                $data = $data . "</select>";

                echo $data;
            }
        }
    }

    public function ajaxInfo()
    {
        if (!empty($_POST['dist_select'])) {
            $location = $_POST['dist_select'];

        } else {
            $location = $_POST['city_select'];
        }
    }


    public function ajaxRegistration()
    {
        $json = array();

        if (isset($_POST['username']) && isset($_POST['email'])) {

            $username = $_POST['username'];
            $email = $_POST['email'];

            if (isset($_POST['dist_select'])) {
                $location = $_POST['dist_select'];
                $location = $this->model->getAddress($location);
            } else {
                $location = $_POST['city_select'];
                $location = $this->model->getAddress($location);
            }

            if (!$this->model->isExistEmail($_POST['email'])) {


                $this->model->regNewUser($username, $email, $location['ter_address']);
                $json['success'] = "<span style='color: green; '><b>Регистрация прошла успешно!</b></span>";

            } else {

//                $json['redirect'] = $this->view->render('account');
                $user_info = $this->model->userInfo($email);
                $output = "<span style='color: red; '><b>Пользователь с таким email'ом уже зарегистрирован</b></span>";
                $output .= "<p><b>Username: </b>" . $user_info['username'] . "</p>";
                $output .= "<p><b>Email: </b>" . $user_info['email'] . "</p>";
                $output .= "<p><b>Address: </b> " . $user_info['territory'] . "</p>";
                $json['user_info'] = $output;

            }
        } else {
            $json['error'] = $this->error;
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }
}
