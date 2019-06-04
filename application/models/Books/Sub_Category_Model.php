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

    public function remove_subcat($id)
    {
        $this->db->where('id',$id);
         $this->db->delete('book_sub_category');
         return $this->db->last_query();
    }

}