<?php

class Borrow extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Books/Borrow_Model' => 'borrow_m']);
    }

    public function index()
    {
        $this->load->view('admin/book/borrow');
    }

    public function show()
    {

        $this->form_validation->set_rules('stud_id', 'Student Id', 'required');
        $stud_num = $this->input->post('stud_id');
        $id = $this->input->post('sid');


        if ($this->form_validation->run() == FALSE) {
            $status_code = 401;
            $error_response = array('status' => $status_code, 'message' => validation_errors());
            return $this->output
                    ->set_status_header($status_code)
                    ->set_content_type('application/json')
                    ->set_output(json_encode($error_response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
        }
        else {
            $result = $this->borrow_m->search($stud_num);

            $res = $this->borrow_m->count_books($id);
         

            $status_code = 200;
            
            $response = array('status' => $status_code, 'message' =>  $result, 'count' => $res);

            return $this->output
                    ->set_status_header($status_code)
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
                  
        }
    }
    

    public function insert()
    {

        $returned_Date = Date('Y-m-d', strtotime("+3 days"));
        $data = [];

        foreach ($this->input->post('books') as $key => $value) {
            $data[] = [
                'borrower_id' => $this->input->post('bid') ,
                'book_id' =>  $value,
                'date_borrowed' =>  Date('Y-m-d'),
                'due_date' =>  $returned_Date,
                'date_returned' =>  NULL,
                'borrowed_status' =>  'unreturned',
                'penalty' =>  '',

            ];
        }
        $result = $this->borrow_m->borrow($data);
        echo json_encode($result);
    }

    public function get_books()
    {
        $id = $this->input->get('id');
        $result = $this->borrow_m->get_all_books($id);
        echo json_encode($result);
    }

    public function booksborrowedTable($id="")
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
                    case 'book_id':
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

            $borrowedBooks = $this->borrow_m->getBorrowedBooksDatatable($limit, $offset, $sort_col, $sort_dir, $filter_value, $id);

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