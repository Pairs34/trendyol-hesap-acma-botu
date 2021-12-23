<?php


class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('is_login') != true){
            redirect(route('login.home'));
        }
    }

    public function index(){
        $data = [
            'view' => 'backend/home',
        ];
        $this->load->view("backend/layout",$data);
    }

    public function logout(){
        $this->session->unset_userdata('is_login');
        redirect(route('login.home'));
    }

}