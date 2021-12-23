<?php


class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_login') == true){
            redirect(route('home'));
        }
    }

    public function index(){
        $this->load->view('backend/login');

    }

    public function login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $data = $this->db->where(['username' => $username,'password' => md5($password)])->get("login")->row();
       if ($data){
           $this->session->set_userdata([
               'is_login' => true
           ]);
           redirect(route('home'));
       }else{
             redirect(route('login.home'));
       }
    }
}