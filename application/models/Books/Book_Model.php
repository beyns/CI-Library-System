<?php

class Book_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_category()
    {
        $data = $this->db->get('book_category');
        return $data->result_array();
    }

    public function getSubCategoryByCategoryName($id)
    {
        //SELECT `sub_category` FROM `book_sub_category` INNER JOIN book_category AS c ON c.id = book_sub_category.category_id WHERE c.category =  'Web Development'

        $this->db->select('sub_category');
        $this->db->from('book_sub_category');
        $this->db->join('book_category', 'book_category.id = book_sub_category.category_id');
        $this->db->where('book_category.category', $id);
        $query = $this->db->get();

        
        return $query->result();
    }

}