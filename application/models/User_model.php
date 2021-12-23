<?php


class User_model extends CI_Model
{

    private $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = "user";
    }


    public function insert($data = array()){
        $this->db->insert($this->user,$data);
        return $this->db->insert_id();
    }

    public function get_all_data(){
        return $this->db->get($this->user)->result();
    }

    public function update_data($id,$data=array()){
        return $this->db->where("id",$id)->update($this->user,$data);
    }



}