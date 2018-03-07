<?php
class Database{
    public $db;
    public function __construct() {
        $this->db = new mysqli(HOST,USER,PASSWORD,DATABASE);

        if ($this->db->connect_error) {
            trigger_error('Error: Could not make a database link (' . $this->db->connect_errno . ') ' . $this->db->connect_error);
            exit();
        }
        return $this->db;
    }

    public function get_all_db($sql) {
        $res = $this->db->query($sql);
        if(!$res){
            return array();
        } else {
            while ($row = $res->fetch_assoc()) {
                $res_row[] = $row;
            }
        }
        return $res_row;
    }

    public function get_one_db($sql) {
        $res = $this->db->query($sql);
        if(!$res) {
            return array();
        } else {
            return $res->fetch_assoc();
        }
    }

    public function insert_to_db($sql) {
        $res = $this->db->query($sql);
        if(!$res) {
            return FALSE;
        } else {
            return $this->db->insert_id;
        }
    }
}