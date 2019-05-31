<?php

class Borrowers extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(["Borrowers/Borrower_Model" => 'borrow_m']);
    }

    public function index()
    {
         $this->load->view('admin/user/borrowers');
    }

    public function show()
    {
        $data = [
            "borrowers" =>  $this->borrow_m->get_borrowers()
        ];

        $this->load->view('admin/book/books',$data);
    }
    public function borrowersTable()
    {
        header('Content-Type: application/json');
        $borrowers_dataTables = $this->input->post(NULL, TRUE);

        if(!empty($borrowers_dataTables))
        {
            $draw = $borrowers_dataTables['draw'];
            $offset = (empty($borrowers_dataTables['start'])) ? 0 : $borrowers_dataTables['start'];
            $limit = (empty($borrowers_dataTables['length'])) ? 10 : $borrowers_dataTables['length'];
            $filter_value = (empty($borrowers_dataTables['search']['value'])) ? "" : trim($borrowers_dataTables['search']['value']);
            $sort_col_num = (int)(!isset($borrowers_dataTables['order']) && empty($borrowers_dataTables['order'][0]['column'])) ? 0 : $borrowers_dataTables['order'][0]['column'];
            $sort_col	= '';
            $sort_dir = (!isset($borrowers_dataTables['order']) && empty($borrowers_dataTables['order'][0]['dir'])) ? 'ASC' : $borrowers_dataTables['order'][0]['dir'];
            $columns = array();

            foreach($borrowers_dataTables['columns'] as $key => $val)
            {
                switch ($val['data']) {
                    case 'id':
                    case 'fullname':
                    case 'student_num':
                    case 'contact':
                    $columns[$key] = 'c.'.$val['data'];
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
                "recordsTotal" => $this->borrow_m->datatable_count_all('c.borrowedBooks', 'ASC', ""),
                "recordsFiltered" => $this->borrow_m->datatable_count_filtered($sort_col, $sort_dir, $filter_value),
                "draw" => (integer) $borrowers_dataTables['draw'],
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