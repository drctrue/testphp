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


    public function regNewUser($username, $email, $location)
    {
        return $this->insert_to_db("INSERT INTO `users` (`username`, `email`, `territory`) VALUES ('$username', '$email','$location')");
    }

    public function getAddress($id)
    {
        return $this->get_one_db("SELECT `ter_address` FROM `t_koatuu_tree` WHERE `ter_id` = '" . $id . "'");
    }

    public function isExistUser($username)
    {
        return $this->get_all_db("SELECT `username` FROM users WHERE `username` = '" . $username . "'");
    }

    public function isExistEmail($email)
    {
        return $this->get_all_db("SELECT `email` FROM users WHERE `email` = '" . $email . "'");
    }

    public function userInfo($email){
        return $this->get_one_db("SELECT * FROM `users` WHERE `email` = '". $email ."'");
    }
}