<?php

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(["Books/BorrowedReport" => 'borrowedr_m']);

    }

    public function index()
    {
        $this->load->view('admin/index');
    }


    public function reportTable()
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
                    case 'barcode':
                    case 'title':
                    case 'date_borrowed':
                    $columns[$key] = 'bb.'.$val['data'];
                    break;
                    default:
                    $columns[$key] = $val['data'];
                    break;
            }
        }

            $sort_col = $columns[$sort_col_num];

            $date = $this->input->post('d_borrowed');
        
            // var_dump($date);
            // $result = $this->borrow_m->selectByDate($date);
    
            // echo json_encode($result);
            $borrowedBooks = $this->borrowedr_m->getBorrowedBooksDatatable($date, $limit, $offset, $sort_col, $sort_dir, $filter_value);

            $result = array(
                "data" => $borrowedBooks,
                "recordsTotal" => $this->borrowedr_m->datatable_count_all('bb.borrowedBooks', 'ASC', ""),
                "recordsFiltered" => $this->borrowedr_m->datatable_count_filtered($sort_col, $sort_dir, $filter_value),
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