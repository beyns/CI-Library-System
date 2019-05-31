<?php

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Auth/Login_Model' => 'login_m']);
        if ($this->session->userdata('members')) {
            redirect('admin/dashboard');
        }
    }

    public function index()
    {
      $this->load->view('auth/auth_login');
    }

    public function login()
    {
        $username = $this->input->post('uname');
        $password = sha1($this->input->post('upass'));

        $data = $this->login_m->validate($username,$password);
        if ($data) {

            $this->session->set_userdata('members',$data);
            $status_code = 200;
            $response = array('status' => $status_code, 'message' => 'success' );

            return $this->output
            ->set_status_header($status_code)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));

            redirect('admin/dashboard');
        }
        else{

            $status_code = 401;
            $response = array('status' => $status_code, 'message' => 'error' );

            return $this->output
            ->set_status_header($status_code)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
        }
    }

}