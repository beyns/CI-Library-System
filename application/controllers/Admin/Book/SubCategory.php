<?php

class SubCategory extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Books/Sub_Category_Model' => 'sub_cat_m']);
    }

    public function index()
    {
        echo 'hello';
    }
    public function insert_sub_category()
    {
        $category_id = $this->input->post('id');

        $data  = [];

        foreach($this->input->post('sub_category') as $key => $value){
            $data[] = [
                'category_id' => $category_id,
                'sub_category' => $value
            ];
        }
        $this->sub_cat_m->add_sub_category($data);
    }

}