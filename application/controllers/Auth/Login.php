<?php

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Auth/Login_Model' => 'user_m']);
    }

    public function index()
    {
      $this->load->view('auth/auth_login');
    }

    public function login()
    {
        $username = $this->input->post('uname');
        $password = sha1($this->input->post('pass'));

        $data = $this->user_m->validate($username,$password);
        if ($data) {
            redirect('admin/dashboard');
        }
        else{
             $this->load->view('auth/auth_login');
           
        }
    }

}