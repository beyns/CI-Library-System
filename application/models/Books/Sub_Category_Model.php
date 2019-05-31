<?php

class Sub_Category_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function add_sub_category($data)
    {
        $this->db->insert_batch('book_sub_category',$data);
    }

    public function show_sub_category()
    {
        
    }

}