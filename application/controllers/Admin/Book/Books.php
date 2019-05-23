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

    public function select_sub_category()
    {
        $id = 'Web Development';
        $result = $this->book_m->getSubCategoryByCategoryName($id);


        foreach ($result->values as $arr) {
            foreach ($arr as $obj) {
                
                print_r($obj);
            }
        }
        print_r($result);
    }

}
