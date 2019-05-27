<?php

class BookList extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(["Borrowers/Borrower_Model" => 'borrow_m']);
    }

    public function index()
    {
        $this->load->view('Books/booklist');
    }

    public function borrow_book()
    {

        $returned_Date = Date('Y-d-m', strtotime("+3 days"));
        $data = array(
            "borrower_id" => 1,
            "book_id" => $this->input->post('book_id'),
            "date_borrowed" => date('Y-d-m'),
            "due_date" =>  $returned_Date,
            "date_returned" => date('Y-d-m'),
            "status" => 'borrowed',
            "penalty" => ''
        );
        
        if ($this->borrow_m->borrow($data)) {

            $this->input->post('book_id');
            $this->borrow_m->update_book_quantity($id);
        }
    }

}