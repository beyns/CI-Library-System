<?php 

class Login_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function validate($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password',$password);
        $query =$this->db->get('members');
        if($query->num_rows() == 1)  
        {  
            return true;  
        }  
        else  
        {  
            return false;       
        }  
    }

}