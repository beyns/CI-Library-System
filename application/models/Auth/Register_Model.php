<?php

class Register_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function add($raw_data = [])
    {
        unset($raw_data['cpass']);

        $data = $raw_data;

        $data['password'] = sha1($this->input->post('pass'));

        if ($this->db->insert('users',$data)) {
            return true;
        }else {
            return false;
        };

    }
}