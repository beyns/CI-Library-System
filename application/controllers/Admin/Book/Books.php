<?php

class Books extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Books/Book_Model' => 'book_m']);
    }

    public function index()
    {
        $data = [
                    'categories' => $this->book_m->get_all_category(),
                ];

        $this->load->view('admin/book/books',$data);
    }

    public function booksTable()
    {
        header('Content-Type: application/json');
        $book_dataTables = $this->input->post(NULL, TRUE);

        if(!empty($book_dataTables))
        {
            $draw = $book_dataTables['draw'];
            $offset = (empty($book_dataTables['start'])) ? 0 : $book_dataTables['start'];
            $limit = (empty($book_dataTables['length'])) ? 10 : $book_dataTables['length'];
            $filter_value = (empty($book_dataTables['search']['value'])) ? "" : trim($book_dataTables['search']['value']);
            $sort_col_num = (int)(!isset($book_dataTables['order']) && empty($book_dataTables['order'][0]['column'])) ? 0 : $book_dataTables['order'][0]['column'];
            $sort_col	= '';
            $sort_dir = (!isset($book_dataTables['order']) && empty($book_dataTables['order'][0]['dir'])) ? 'ASC' : $book_dataTables['order'][0]['dir'];
            $columns = array();

            foreach($book_dataTables['columns'] as $key => $val)
            {
                switch ($val['data']) {
                    case 'id':
                    case 'title':
                    case 'description':
                    case 'author':
                    case 'isbn':
                    case 'category':
                    case 'subcategory':
                    case 'qty':
                    case 'borrowed_qty':
                    $columns[$key] = 'b.'.$val['data'];
                    break;
                    default:
                    $columns[$key] = $val['data'];
                    break;
            }
        }

            $sort_col = $columns[$sort_col_num];

            $category = $this->book_m->getBooksDatatable($limit, $offset, $sort_col, $sort_dir, $filter_value);

            $result = array(
                "data" => $category,
                "recordsTotal" => $this->book_m->datatable_count_all('b.title', 'ASC', ""),
                "recordsFiltered" => $this->book_m->datatable_count_filtered($sort_col, $sort_dir, $filter_value),
                "draw" => (integer) $book_dataTables['draw'],
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

    public function select_sub_category()
    {
        $id = $this->input->post('id');
        $result = $this->book_m->getSubCategoryByCategoryId($id);
        echo json_encode($result);
    }

    public function insert()
    {
        $data = $this->input->post();
        unset($data['csrf_test_name']);
        $result = $this->book_m->add_book($data);
        echo json_encode($result);
    }

    public function show()
    {
        $id = $this->input->get('id', TRUE);
        $data = $this->book_m->get_book_info($id);
        
        echo json_encode($data);
    }

    public function update()
    {

    }

    public function destroy()
    {
        $id =  $this->input->get('id',TRUE);
        echo $id;
       $this->book_m->remove_book($id);
        
    }

}
