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
     
        $data =  array(
            "firstname" => $this->input->post('fname'),
            "lastname" => $this->input->post('lname'),
            "email" => $this->input->post('email'),
            "username" => $this->input->post('uname'),
            "password" => $this->input->post('pass'),
            "role" => $this->input->post('role')
        );
        unset($data['csrf_test_name']);


        $result = $this->member_m->insert_member($data);
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
        $id = $this->input->post('id');
        $this->member_m->editMemberInfo($id);
        
        
    }

}