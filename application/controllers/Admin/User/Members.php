<?php

class Members extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Users/Members_Model' => 'member_m']);
    }

    public function index()
    {
         $this->load->view('admin/user/index');
    }

    public function membersTable()
    {
        header('Content-Type: application/json');
        $members_dataTables = $this->input->get(NULL, TRUE);

        if(!empty($members_dataTables))
        {
            $draw = $members_dataTables['draw'];
            $offset = (empty($members_dataTables['start'])) ? 0 : $members_dataTables['start'];
            $limit = (empty($members_dataTables['length'])) ? 10 : $members_dataTables['length'];
            $filter_value = (empty($members_dataTables['search']['value'])) ? "" : trim($members_dataTables['search']['value']);
            $sort_col_num = (int)(!isset($members_dataTables['order']) && empty($members_dataTables['order'][0]['column'])) ? 0 : $members_dataTables['order'][0]['column'];
            $sort_col	= '';
            $sort_dir = (!isset($members_dataTables['order']) && empty($members_dataTables['order'][0]['dir'])) ? 'ASC' : $members_dataTables['order'][0]['dir'];
            $columns = array();

            foreach($members_dataTables['columns'] as $key => $val)
            {
                switch ($val['data']) {
                    case 'id':
                    case 'firstname':
                    case 'lastname':
                    case 'username':
                    case 'email':
                    case 'role':
                    $columns[$key] = 'm.'.$val['data'];
                    break;
                    default:
                    $columns[$key] = $val['data'];
                    break;
            }
        }

            $sort_col = $columns[$sort_col_num];

            $category = $this->member_m->getMembersDatatable($limit, $offset, $sort_col, $sort_dir, $filter_value);

            $result = array(
                "data" => $category,
                "recordsTotal" => $this->member_m->datatable_count_all('m.username', 'ASC', ""),
                "recordsFiltered" => $this->member_m->datatable_count_filtered($sort_col, $sort_dir, $filter_value),
                "draw" => (integer) $members_dataTables['draw'],
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
            "draw" => (integer) $this->input->get('draw',TRUE)
            );

            echo json_encode($result);
        }
    }


    public function insert()
    {
     
        $this->form_validation->set_rules('fname', 'Firstname', 'required');
        $this->form_validation->set_rules('lname', 'Lastname', 'required');
        $this->form_validation->set_rules('uname', 'Username', 'required|is_unique[members.username]');
        $this->form_validation->set_rules('email', 'Email',  'required|valid_email|is_unique[members.email]');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('cpass', 'Confirm Password',  'trim|required|matches[pass]');

        $data =  array(
            "firstname" => $this->input->post('fname'),
            "lastname" => $this->input->post('lname'),
            "email" => $this->input->post('email'),
            "username" => $this->input->post('uname'),
            "password" => sha1($this->input->post('pass')),
            "role" => $this->input->post('role')
        );
        unset($data['csrf_test_name']);


        $status_code = 200;
        $response = array('status' => $status_code, 'message' => "User Successfully Added");
        
        if ($this->form_validation->run() == FALSE) {
          
            $status_code = 401;
            $error_response = array('status' => $status_code, 'message' => validation_errors());
            $this->load->view('admin/user/members');
            return $this->output
                    ->set_status_header($status_code)
                    ->set_content_type('application/json')
                    ->set_output(json_encode($error_response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
        }
       else {
           
        $result = $this->member_m->insert_member($data);
        if($result){

            return $this->output
             ->set_header('HTTP/1.1 200 OK')
             ->set_status_header($status_code)
             ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP));
        }

       }


        
        echo json_encode($result);

    }

    // public function
    public function edit()
    {
        $id =  $this->input->get('id',TRUE);
        $result = $this->member_m->getMemberById($id);

        echo json_encode($result);
    }

    public function update()
    {
        $data = $this->input->post();
        $id = $this->input->post('id');
        $this->member_m->editMemberInfo();
        
        
    }

}