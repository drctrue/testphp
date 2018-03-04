<?php
class Database{
    public $db;
    public function __construct(){
        $this->db = mysqli_connect(HOST,USER,PASSWORD,DATABASE);

        if(!$this->db){
            exit ('No connection database!');
        }
        if(!mysqli_select_db($this->db, DATABASE)){
            exit ('No table!');
        }
        return $this->db;
    }

    public function get_all_db($sql){
        $res = mysqli_query($this->db, $sql);
        if(!$res){
            return array();
        }
        else{
            while ($row = mysqli_fetch_assoc($res)) {
                $res_row[] = $row;
            }
        }
        return $res_row;
    }
    public function get_one_db($sql){
        $res = mysqli_query($this->db, $sql);
        if(!$res){
            return array();
        }
        else{
            return mysqli_fetch_assoc($res);
        }
    }

    public function insert_to_db($sql){
        $res = mysqli_query($this->db, $sql);
        if(!$res){
            return FALSE;
        }
        else{
            return $this->db->insert_id;
        }
    }

    public function insert_to($sql){
        $res = mysqli_query($this->db, $sql);
        if(!$res){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    public function update_to_db($sql){
        $res = mysqli_query($this->db, $sql);
        if(!$res){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
}