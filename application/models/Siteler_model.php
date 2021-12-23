<?php


class Siteler_model extends CI_Model
{

    private $siteler;
    public function __construct()
    {
        parent::__construct();
        $this->siteler = "siteler";
    }

    public function insert($data = array()){
        $this->db->insert($this->siteler,$data);
        return $this->db->insert_id();
    }

    public function get_all_data(){
        return $this->db->get($this->siteler)->result();
    }

    public function get_data($site_id){
        return $this->db->where("site_id",$site_id)->get($this->siteler)->row();
    }

    public function delete_data($site_id){
        return $this->db->where("site_id",$site_id)->delete($this->siteler);
    }

    public function update_data($id,$data=array()){
        return $this->db->where("site_id",$id)->update($this->siteler,$data);
    }



}