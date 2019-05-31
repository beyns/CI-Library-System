<?php

class BorrowedList extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(["Borrowers/Borrower_Model" => 'borrow_m']);
    }

    public function index()
    {
        $this->load->view('Books/borrowed_list');
    }

    public function borsrow_book()
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

    public function borrowedTable()
    {
        header('Content-Type: application/json');
        $borrowed_dataTables = $this->input->post(NULL, TRUE);

        if(!empty($borrowed_dataTables))
        {
            $draw = $borrowed_dataTables['draw'];
            $offset = (empty($borrowed_dataTables['start'])) ? 0 : $borrowed_dataTables['start'];
            $limit = (empty($borrowed_dataTables['length'])) ? 10 : $borrowed_dataTables['length'];
            $filter_value = (empty($borrowed_dataTables['search']['value'])) ? "" : trim($borrowed_dataTables['search']['value']);
            $sort_col_num = (int)(!isset($borrowed_dataTables['order']) && empty($borrowed_dataTables['order'][0]['column'])) ? 0 : $borrowed_dataTables['order'][0]['column'];
            $sort_col	= '';
            $sort_dir = (!isset($borrowed_dataTables['order']) && empty($borrowed_dataTables['order'][0]['dir'])) ? 'ASC' : $borrowed_dataTables['order'][0]['dir'];
            $columns = array();

            foreach($borrowed_dataTables['columns'] as $key => $val)
            {
                switch ($val['data']) {
                    case 'id':
                    case 'title':
                    case 'date_borrowed':
                    case 'due_date':
                    case 'borrowed_status':
                    $columns[$key] = 'bb.'.$val['data'];
                    break;
                    default:
                    $columns[$key] = $val['data'];
                    break;
            }
        }

            $sort_col = $columns[$sort_col_num];

            $borrowedBooks = $this->borrow_m->getBorrowedBooksDatatable($limit, $offset, $sort_col, $sort_dir, $filter_value);

            $result = array(
                "data" => $borrowedBooks,
                "recordsTotal" => $this->borrow_m->datatable_count_all('bb.borrowedBooks', 'ASC', ""),
                "recordsFiltered" => $this->borrow_m->datatable_count_filtered($sort_col, $sort_dir, $filter_value),
                "draw" => (integer) $borrowed_dataTables['draw'],
                // 'form_token_name' => $new_form_token_name,
                // 'form_token_hash' => $new_form_token_val,
                'sorted_col' => $sort_col,
                'columns' => $columns
            );

            echo json_encode($result);
        }
        else
        {
            $result = array(
            "data" => array(),
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "draw" => (integer) $this->input->post('draw')
            );

            echo json_encode($result);
        }
    }

}