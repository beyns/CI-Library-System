<?php

class BorrowedBooks extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(["Books/Borrowed_Model" => 'borrow_m']);
        $this->load->model(["Books/Borrowed_Model" => 'borrowed_m']);

    }

    public function index()
    {
        $this->load->view('admin/transactions/borrowed_books');
    }

    public function borrower()
    {
        $this->form_validation->set_rules('student_num', 'Student Number', 'required|regex_match[/^[0-9]{8}$/]|is_unique[borrowers.student_num]');
        $this->form_validation->set_rules('fullname', 'Fullname', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('contact', 'Contact',  'required|regex_match[/^[0-9]{11}$/]|max_length[11]|min_length[10]|greater_than[0]');

        $data = $this->input->post();
        $borrower_name = $this->input->post('fullname');


         unset($data['csrf_test_name']);
         unset($data['b_id']);
         unset($data['s_id']);
         unset($data['br_qty']);
         unset($data['b_qty']);
         unset($data['title']);

         $status_code = 200;
         $response = array('status' => $status_code, 'message' => "Borrower Added");
         
         if ($this->form_validation->run() == FALSE) {
            
            $status_code = 401;
            $error_response = array('status' => $status_code, 'message' => validation_errors());
            return $this->output
                    ->set_status_header($status_code)
                    ->set_content_type('application/json')
                    ->set_output(json_encode($error_response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));

         }
         else{

            $result = $this->borrow_m->new_borrower($data);
         
            return $this->output
             ->set_header('HTTP/1.1 200 OK')
             ->set_status_header($status_code)
             ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
         }


        // if ($result) {
        //     // // $book_qty = $this->input->post('qty') - 1;
        //     // $returned_Date = Date('Y-m-d', strtotime("+3 days"));
        //     // $book_title = $this->input->post('title');
        //     // $borrower_name = $this->input->post('fullname');
            
        //     // $data = array(
        //     //     "borrower_name" => $borrower_name,
        //     //     "book_title" => $book_title,
        //     //     "date_borrowed" => Date('Y-m-d'),
        //     //     "due_date" =>  $returned_Date,
        //     //     "date_returned" => Date('Y-m-d'),
        //     //     "borrowed_status" => 'unreturn',
        //     //     "penalty" => ''
        //     // );
        //     // $this->borrow_m->borrow($data);
            
        // }
        // else {
        //     return false;
        // }
    }

    public function show()
    {
        $data = $this->borrow_m->get();
        echo json_encode($data);
    }
     public function edit()
     {
        $id = $this->input->get('id', TRUE);
        $result= $this->borrow_m->get_data($id);
        echo json_encode($result);
     }


     public function update()
     {
        //  $date_returned = date('Y-m-d H:i:s', time());
        //  $due_date =  new DateTime($this->input->post('date'));
        //  $total_days = $date_returned->diff($due_date)->format('%d days');#totaldays para maibalik ko ung libro

        $start = strtotime(date('Y-m-d H:i:s'));
        $end = strtotime($this->input->post('date'));

        $total_days = ceil(abs($end - $start) / 86400);

         
         $max_days = 3;
         $penalty = 20;
         
         $new_quantity = (int)$this->input->post('abook') + 1;
         $bkid = $this->input->post('bkid');
         $book_borrowed = (int)$this->input->post('bbqty')- 1;
         
         $borrower = $this->input->post('bname'); 


         $id = $this->input->post('id');
         $status = $this->input->post('b_status');

         $status_code = 201;

         if ($total_days >= $max_days) {
            $exceed_days = $total_days - 3 ;
            $total_penalty = $exceed_days * $penalty;

            $result = $this->borrow_m->update_status($id,$status,date('Y-m-d'),$total_penalty);

              if ($result) {
                $update = $this->borrowed_m->update_book_quantity($bkid, $new_quantity,$book_borrowed);
                $response = array('status' => $status_code, 'message' =>  "Borrower" .'  ' ."$borrower" . ' ' . "have a penalty of " .'' .$total_penalty );
               
                return $this->output
                ->set_header('HTTP/1.1 200 OK')
                ->set_status_header($status_code)
                ->set_content_type('application/json')
               ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));

              }
        
         }
         else {
            $no_penalty = "No Penalty";
            $borrower = $this->input->post('bname'); 

            $result = $this->borrow_m->update_status($id,$status,date('Y-m-d'),$no_penalty);

            $update=  $this->borrowed_m->update_book_quantity($bkid, $new_quantity,$book_borrowed);
             $response = array('status' => $status_code, 'message' =>  "Borrower" . "$borrower" . ' ' . "have no penalty" );

                return $this->output
                ->set_header('HTTP/1.1 200 OK')
                ->set_status_header($status_code)
                ->set_content_type('application/json')
               ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
         }
          

      

       
       
        //  if ($total_days == $max_days) {
           
        //  }
        //  else {
        //      
        //      
        //      
        //  }
        //  die();
        //  $date_returned = Date('Y-m-d');
          
     }



    public function borrowedTable($date="")
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
                    case 'borrower_id':
                    case 'barcode':
                    case 'fullname':
                    case 'count':
                    case 'date_borrowed':
                    case 'due_date':
                    case 'borrowed_status':
                    case 'penalty':
                    case 'date_returned':
                    $columns[$key] = 'bb.'.$val['data'];
                    break;
                    default:
                    $columns[$key] = $val['data'];
                    break;
            }
        }

            $sort_col = $columns[$sort_col_num];

            $borrowedBooks = $this->borrow_m->getBorrowedBooksDatatable($limit, $offset, $sort_col, $sort_dir, $filter_value, $date);

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

    // public function select()
    // {
    //     $date = $this->input->post('d_borrowed');
        
    //     $result = $this->borrow_m->selectByDate($date);

    //     echo json_encode($result);
    // }

    
    public function select()
    {
        // header('Content-Type: application/json');
         $borrowed_dataTables = $this->input->post(NULL, TRUE);
        
        $date = $this->input->post('d_borrowed');

        // if(!empty($borrowed_dataTables))
        // {
        //     $draw = $borrowed_dataTables['draw'];
        //     $offset = (empty($borrowed_dataTables['start'])) ? 0 : $borrowed_dataTables['start'];
        //     $limit = (empty($borrowed_dataTables['length'])) ? 10 : $borrowed_dataTables['length'];
        //     $filter_value = (empty($borrowed_dataTables['search']['value'])) ? "" : trim($borrowed_dataTables['search']['value']);
        //     $sort_col_num = (int)(!isset($borrowed_dataTables['order']) && empty($borrowed_dataTables['order'][0]['column'])) ? 0 : $borrowed_dataTables['order'][0]['column'];
        //     $sort_col	= '';
        //     $sort_dir = (!isset($borrowed_dataTables['order']) && empty($borrowed_dataTables['order'][0]['dir'])) ? 'ASC' : $borrowed_dataTables['order'][0]['dir'];
        //     $columns = array();

        //     foreach($borrowed_dataTables['columns'] as $key => $val)
        //     {
        //         switch ($val['data']) {
        //             case 'id':
        //             case 'barcode':
        //             case 'fullname':
        //             case 'title':
        //             case 'date_borrowed':
        //             case 'due_date':
        //             case 'borrowed_status':
        //             case 'penalty':
        //             case 'date_returned':
        //             $columns[$key] = 'bb.'.$val['data'];
        //             break;
        //             default:
        //             $columns[$key] = $val['data'];
        //             break;
        //     }
        // }

        //     $sort_col = $columns[$sort_col_num];

            $borrowedBooks = $this->borrow_m->selectByDate($date);

            $result = array(
                "data" => $borrowedBooks,
                "recordsTotal" => $this->borrow_m->datatable_count_all('bb.borrowedBooks', 'ASC', ""),
                "recordsFiltered" => $this->borrow_m->datatable_count_filtered("", "", ""),
                "draw" => 1,
                // 'form_token_name' => $new_form_token_name,
                // 'form_token_hash' => $new_form_token_val,
                // 'sorted_col' => $sort_col,
                // 'columns' => $columns
            );

            echo json_encode($result);
        // }
        // else
        // {
        //     $result = array(
        //     "data" => array(),
        //     "recordsTotal" => 0,
        //     "recordsFiltered" => 0,
        //     "draw" => (integer) $this->input->post('draw')
        //     );

        //     echo json_encode($result);
        // }
    }
}