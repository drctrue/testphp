<?php

class ModelRegistration extends Database
{

    //get main region
    public function getRegion()
    {
        return $this->get_all_db("SELECT * FROM `t_koatuu_tree` WHERE `ter_pid` IS NULL");
    }

    //get city
    public function getCity($region_id)
    {
        return $this->get_all_db("SELECT * FROM `t_koatuu_tree` WHERE `ter_pid` = '" . $region_id . "'");
    }

    //get area
    public function getDistricts($city_id)
    {
        return $this->get_all_db("SELECT * FROM `t_koatuu_tree` WHERE `ter_pid` = '" . $city_id . "'");
    }


    public function regNewUser($name, $email, $id_territory)
    {
        return $this->insert_to_db("INSERT INTO `users` (`name`, `email`, `territory`) VALUES ('$name', '$email','$id_territory')");
    }

    public function getAddress($id)
    {
        return $this->get_one_db("SELECT `ter_id`, `ter_address` FROM `t_koatuu_tree` WHERE `ter_id` = '" . $id . "'");
    }


    public function isExistEmail($email)
    {
        return $this->get_all_db("SELECT `email` FROM users WHERE `email` = '" . $email . "'");
    }

    public function userInfo($email){
        return $this->get_one_db("SELECT u.name, u.email, u.territory, ter.ter_address FROM users u LEFT JOIN t_koatuu_tree ter ON u.territory = ter.ter_id WHERE u.email = '". $email ."'");
    }
}