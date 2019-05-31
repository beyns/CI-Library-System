<?php

class Members_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function countAll()
    {
        $this->db->from('members');
        return $this->db->count_all_results();
    }

    /**
    * Build the datatable's base query.
    * @param string $sort_col [description]
    * @param string $sort_dir [description]
    * @param string $search_value [description]
    * @param boolean $headers_only [description]
    * @param boolean $raw [description]
    */

    private function _getDataTableMembers($sort_col = 'm.username', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE)
    {
      $search_cols = array(
        "m.username" => $search_value,
      );



      $this->db->select("m.*");
      $this->db->from("members AS m");

      // $this->db->where("m.is_active != '3'", NULL, false);
      // $this->db->where('m.created_by', $this->session->user_id);


      $this->db->group_start();
      $this->db->or_like($search_cols);
      $this->db->group_end();
      $this->db->order_by($sort_col, $sort_dir);

    }

    /**
    * Get the results, with limit and offset.
    * @param integer $limit [description]
    * @param integer $offset [description]
    * @param string $sort_col [description]
    * @param string $sort_dir [description]
    * @param string $search_value [description]
    * @param boolean $headers_only [description]
    * @param boolean $raw [description]
    * @return array [description]
    */
    public function getMembersDatatable($limit = 10, $offset = 0, $sort_col = 'm.username', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE)
    {
      $this->_getDataTableMembers($sort_col, $sort_dir, $search_value, $headers_only, $raw);

        if($limit != -1)
        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        if($raw) return $query;

        if($headers_only === TRUE)
        {
          return $query->list_fields();
        }
        else
        {
          if($query->num_rows() > 0)
          {
          return $query->result_array();
          }
          else
          {
          return array();
          }
        }
    }

    /**
    * Get the total count using the previous query. Runs without the limit tag.
    * @param string $section_class [description]
    * @param boolean $raw [description]
    * @return [type] [description]
    */
    public function datatable_count_all($sort_col = 'm.username', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE)
    {
    $this->_getDataTableMembers($sort_col, $sort_dir, $search_value, $headers_only, $raw);

    return $this->db->count_all_results();
    }

    /**
    * Get the filtered count using the previous query. Runs without the limit tag.
    * @param [type] $sort_col [description]
    * @param [type] $sort_dir [description]
    * @param [type] $search_value [description]
    * @param boolean $headers_only [description]
    * @param boolean $raw [description]
    * @return integer returns the number of rows of the searched value without the limit
    */
    public function datatable_count_filtered($sort_col = 'm.username', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE)
    {
        $this->_getDataTableMembers($sort_col, $sort_dir, $search_value, $headers_only, $raw);

        $query = $this->db->get();

        return $query->num_rows();
    }

    public function insert_member($raw_data = [])
    {

        unset($raw_data['cpass']);
        $data['password'] = sha1($this->input->post('pass'));

        $data = $raw_data;

        // $id = $data['id'];

        $this->db->insert('members', $data);


    }

    public function getMemberById($id)
    {
       $query = $this->db->get_where('members', array('id' => $id));
        return $query->row_array();
    }

    public function editMemberInfo($data=[])
    {
        unset($data['cpass']);
        unset($data['changePass']);
        $data['password'] = sha1($data['password']);

        $id = $data['id'];
        $this->db->where('id',$id);
        return $this->db->update('members', $data);


    }

    public function removeMember($id)
    {
        $this->db->where('id', $id);
        return $this->db->remove('members');
    }
}