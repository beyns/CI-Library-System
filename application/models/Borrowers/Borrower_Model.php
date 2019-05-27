<?php

class Borrower_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function borrow($data)
    {
        $this->db->insert('borrowed_books',$data);
    }
    
    public function update_book_quantity($id)
    {
        $this->db->get_where('id',$id);
        $this->db->update('books','qty');
    }
}