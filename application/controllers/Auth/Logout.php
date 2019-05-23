<?php

class Logout extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Auth/Login_Model' => 'login_m']);
    }



    public function index()
    {
        $this->session->unset_userdata('users');
		redirect('auth/login');
    }

}