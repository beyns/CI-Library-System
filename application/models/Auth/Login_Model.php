<?php 

class Login_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function validate($username, $password)
    {
        $data =  $this->db->get_where('users', array('username' => $username , 'password' => $password));
        return $data->row_array();
    }

}