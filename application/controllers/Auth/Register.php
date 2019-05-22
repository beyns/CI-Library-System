<?php

class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Auth/Register_Model' => 'user_m']);

    }

    public function index()
    {
      $this->load->view('auth/auth_register');
    }

    public function create_user()
    {

        $this->form_validation->set_rules('studnum', 'Student Number', 'required');
        $this->form_validation->set_rules('fname', 'Firstname', 'required');
        $this->form_validation->set_rules('lname', 'Lastname', 'required');
        $this->form_validation->set_rules('uname', 'Username', 'required|min_length[6]|max_length[12]|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

        $data = array(
            'school_number' => $this->input->post('studnum'),
            'firstname' => $this->input->post('fname'),
            'lastname' => $this->input->post('lname'),
            'username' => $this->input->post('uname'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('pass'),
        );

        $status_code = 200; 

        $response = array('status' => $status_code = 200, 'message' => 'successfully added.' );
        if ($this->form_validation->run() == FALSE) {
           
            $status_code = 401;
            $response = array('status' => $status_code, 'message' => validation_errors() );

            return $this->output
            ->set_status_header($status_code)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
        }
        else {
           
            if ($this->user_m->add($data)) {
               redirect('login');
            }
        }

    }

}