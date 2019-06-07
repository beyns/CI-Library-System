<?php

class SubCategory extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Books/Sub_Category_Model' => 'sub_cat_m']);
    }

    public function insert_sub_category()
    {
        $category_id = $this->input->post('c_id');

        $this->form_validation->set_rules('sub_category[]', 'Sub Category', 'required|is_unique[book_sub_category.sub_category]');

        $status_code = 201;
        $response = array('status' => $status_code, 'message' =>  "Added");
        if ($this->form_validation->run() == FALSE) {
          $status_code = 401;
            $error_response = array('status' => $status_code, 'message' => validation_errors());
            return $this->output
                    ->set_status_header($status_code)
                    ->set_content_type('application/json')
                    ->set_output(json_encode($error_response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
        }
        else {
            $data  = [];

            foreach($this->input->post('sub_category') as $key => $value){
                $data[] = [
                    'category_id' => $category_id,
                    'sub_category' => $value
                ];
            }
            $this->sub_cat_m->add_sub_category($data);

            return $this->output
            ->set_header('HTTP/1.1 200 OK')
            ->set_status_header($status_code)
            ->set_content_type('application/json')
           ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
        }
        
    }

    public function remove()
    {
        $id = $this->input->post('sc_id');
        echo $id;
        $this->sub_cat_m->remove_subcat($id);
    }

}