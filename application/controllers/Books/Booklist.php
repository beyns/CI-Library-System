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


         $book_qty = $this->input->post('qty') - 1;
         $returned_Date = Date('Y-m-d', strtotime("+3 days"));
         $book_id = (int)$this->input->post('book_id');
         $data = array(
             "borrower_id" => 1,
             "book_id" => $book_id,
             "date_borrowed" => Date('Y-m-d'),
             "due_date" =>  $returned_Date,
             "date_returned" => Date('Y-m-d'),
             "status" => 'borrowed',
             "penalty" => ''
         );

        $status_code = 401;
        $response = array('status' => $status_code = 200, 'message' => 'Book Borrowed' );

          if ($this->borrow_m->borrow($data)) {

             $status_code = 200;
             $new_quantity = (int)$this->input->post('qty') - 1;
             $id = $this->input->post('book_id');
             
             $this->borrow_m->update_book_quantity($id, $new_quantity);

             return $this->output
             ->set_header('HTTP/1.1 200 OK')
             ->set_status_header($status_code)
             ->set_content_type('application/json')
             ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
          }
          else {
                 $response = array('status' => $status_code = 200, 'message' => 'Error' );

                 return $this->output
                        ->set_status_header($status_code)
                        ->set_content_type('application/json')
                        ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
          }
    }

}