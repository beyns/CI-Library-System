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

        $this->form_validation->set_rules('uname', 'Username', 'required');
        $this->form_validation->set_rules('upass', 'Password', 'required');
        if ($this->form_validation->run()) {
            $data = $this->login_m->validate($username,$password);
            print_r($data);
            if ($data) {
                $session_data = array(
                    'username' => $username
                );

                $this->session->set_userdata($session_data);
              
            }
            else {

                $response = array('status' => '401', 'message' => "Invalid Username and Password" );

                return $this->output
                ->set_status_header('401')
                ->set_content_type('application/json')
                ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
                
                
            }

        }
        else{


            $status_code = 401;
            $response = array('status' => $status_code, 'message' => validation_errors() );

            return $this->output
            ->set_status_header($status_code)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
        
        }
    }

}