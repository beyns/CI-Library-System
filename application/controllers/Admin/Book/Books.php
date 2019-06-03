<?php

class Books extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Books/Book_Model' => 'book_m']);
        $this->load->model(["Borrowers/Borrower_Model" => 'borrow_m']);
        $this->load->model(["Books/Borrowed_Model" => 'borrowed_m']);

    }

    public function index()
    {
        $data = [
                    'categories' => $this->book_m->get_all_category(),
                    "borrowers" =>  $this->borrow_m->get_borrowers()
                ];
          
        $this->load->view('admin/book/books',$data);

    }


    public function show_student()
    {
        echo json_encode(  $this->borrow_m->get_borrowers());
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
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('isbn', 'ISBN', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('subcategory', 'Subcategory', 'required');
        $this->form_validation->set_rules('qty', 'Quantity', 'required');

        $data = $this->input->post();
        unset($data['csrf_test_name']);

        $new_book =  $this->input->post('title');
        $status_code = 201;
        $response = array('status' => $status_code, 'message' =>  "$new_book" . ' ' . "Added");

        if ($this->form_validation->run() == FALSE) {
            
            $status_code = 401;
            $error_response = array('status' => $status_code, 'message' => validation_errors());
            return $this->output
                    ->set_status_header($status_code)
                    ->set_content_type('application/json')
                    ->set_output(json_encode($error_response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));

        }
        else {
           
            $result = $this->book_m->add_book($data);
            return $this->output
             ->set_header('HTTP/1.1 200 OK')
             ->set_status_header($status_code)
             ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
        }
    
    }

    public function show()
    {
        $id = $this->input->get('id', TRUE);
        $data = $this->book_m->get_book_info($id);
        
        echo json_encode($data);
    }

    public function update()
    {
        
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('isbn', 'ISBN', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('subcategory', 'Subcategory', 'required');
        $this->form_validation->set_rules('qty', 'Quantity', 'required');

        $data = $this->input->post();
        unset($data['csrf_test_name']);

        $status_code = 201;
        $response = array('status' => $status_code, 'message' =>  "Changes Saved");

        if ($this->form_validation->run() == FALSE) {
            $status_code = 401;
            $error_response = array('status' => $status_code, 'message' => validation_errors());
            return $this->output
                    ->set_status_header($status_code)
                    ->set_content_type('application/json')
                    ->set_output(json_encode($error_response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
        }
        else{
            $result =  $this->book_m->update_changes($data);
            return $this->output
             ->set_header('HTTP/1.1 200 OK')
             ->set_status_header($status_code)
             ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
        }
       
        
    }

    public function destroy()
    {
        $id =  $this->input->post('id');
       $this->book_m->remove_book($id);
        
    }

    
    public function totalBooks()
    {
         $id = $this->input->get('id',TRUE);
        $result = $this->borrowed_m->totalBorrowed($id);
        // foreach ($result as $key => $value) {
        //     echo $value;
        // }
        echo json_encode($result);
    }
    public function borrow()
    {
        $returned_Date = Date('Y-m-d', strtotime("+3 days"));
        $book_id = $this->input->post('b_id');
        $borrower_id = $this->input->post('s_id');
        $temp = substr(md5(uniqid(rand(1,6))), 0, 4);
        $code = 'COI-' . $temp . '-LMS';
        $data = array(
            "borrower_id" => $borrower_id,
            "borrower_id" => $borrower_id,
            "book_id" => $book_id,
            "date_borrowed" => Date('Y-m-d'),
            "due_date" =>  $returned_Date,
            "date_returned" => '',
            "borrowed_status" => 'unreturned',
            "penalty" => ''
        );
        $result = $this->borrowed_m->borrow_book($data);
        if ($result) {

                $new_quantity = (int)$this->input->post('b_qty') - 1;
                $id = $this->input->post('b_id');
                $book_borrowed = (int)$this->input->post('br_qty')+1;
    
                $this->borrowed_m->update_book_quantity($id, $new_quantity,$book_borrowed);
    
          
        }
    }

    public function allowedBooks()
    {
        $id = $this->input->get('s_id',TRUE);
        $result = $this->borrow_m->getTotal($id);
        echo json_encode($result);
    }


}
