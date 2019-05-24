<?php

class Category extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Books/Category_Model' => 'cat_m']);
        $this->load->model(['Books/Book_Model' => 'book_m']);
    }

    public function index()
    {
        $this->load->view('admin/book/category');
    }

    public function categoryTable()
    {
        header('Content-Type: application/json');
        $category_dataTables = $this->input->post(NULL, TRUE);

        if(!empty($category_dataTables))
        {
            $draw = $category_dataTables['draw'];
            $offset = (empty($category_dataTables['start'])) ? 0 : $category_dataTables['start'];
            $limit = (empty($category_dataTables['length'])) ? 10 : $category_dataTables['length'];
            $filter_value = (empty($category_dataTables['search']['value'])) ? "" : trim($category_dataTables['search']['value']);
            $sort_col_num = (int)(!isset($category_dataTables['order']) && empty($category_dataTables['order'][0]['column'])) ? 0 : $category_dataTables['order'][0]['column'];
            $sort_col	= '';
            $sort_dir = (!isset($category_dataTables['order']) && empty($category_dataTables['order'][0]['dir'])) ? 'ASC' : $category_dataTables['order'][0]['dir'];
            $columns = array();

            foreach($category_dataTables['columns'] as $key => $val)
            {
                switch ($val['data']) {
                    case 'id':
                    case 'category':
                    $columns[$key] = 'c.'.$val['data'];
                    break;
                    default:
                    $columns[$key] = $val['data'];
                    break;
            }
        }

            $sort_col = $columns[$sort_col_num];

            $category = $this->cat_m->getCategoryDatatable($limit, $offset, $sort_col, $sort_dir, $filter_value);

            $result = array(
                "data" => $category,
                "recordsTotal" => $this->cat_m->datatable_count_all('sc.category', 'ASC', ""),
                "recordsFiltered" => $this->cat_m->datatable_count_filtered($sort_col, $sort_dir, $filter_value),
                "draw" => (integer) $category_dataTables['draw'],
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

    public function add_book_category()
    {
        $this->form_validation->set_rules('category', 'Category' , 'required');
        $data = $this->input->post();
        if(empty($data)){
            show_404();
        }
        unset($data['csrf_test_name']);
        $status_code = 200;
        $response = array('status' => $status_code, 'message' => 'success' );

        if ($this->form_validation->run() == FALSE) {

                $status_code = 401;
                $response = array('status' => $status_code, 'message' => validation_errors() );
    
                return $this->output
                ->set_status_header($status_code)
                ->set_content_type('application/json')
                ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));

        }
        else {
                 $this->cat_m->add($data);
                return $this->output
                ->set_header('HTTP/1.1 200 OK')
                ->set_status_header($status_code)
                ->set_content_type('application/json')
                ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
        }
       
    }

    public function get_category()
    {
        $id = $this->input->post('id');
        $result = $this->book_m->getSubCategoryByCategoryId($id);
        echo json_encode($result);
    }

}