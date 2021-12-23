<?php


class Siteveri_model extends CI_Model
{

    private $site_veri;
    public function __construct()
    {
        parent::__construct();
        $this->site_veri = "site_veri";
    }

    public function insert($data = array()){
        $check = $this->db->where(["site" => $data["site"],'baslik' =>$data["baslik"]])->get($this->site_veri)->row();
        if (!$check){
            return $this->db->insert($this->site_veri,$data);
        }
    }

    public function get_all_data($site_id){
        return $this->db->where("site",$site_id)->get($this->site_veri)->result();
    }

    public function all_data(){
        return $this->db->get($this->site_veri)->result();
    }

    public function get_data($site_id){
        return $this->db->where("id",$site_id)->get($this->site_veri)->row();
    }

    public function delete_data($site_id){
        return $this->db->where("id",$site_id)->delete($this->site_veri);
    }
    public function delete_data_old(){

        return $this->db->where("date !=",date('Y-m-d'))->delete($this->site_veri);
    }

    public function update_data($id,$data=array()){
        return $this->db->where("id",$id)->update($this->site_veri,$data);
    }



}