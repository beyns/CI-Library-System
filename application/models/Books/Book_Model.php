<?php

class Book_Model extends CI_Model
{

    public $table = 'books';
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_category()
    {
        $data = $this->db->get('book_category');
        return $data->result_array();
    }

    public function countAll()
    {
        $this->db->from('books');
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

    private function _getDataTableBooks($sort_col = 'b.title', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE)
    {
      $search_cols = array(
        "b.title" => $search_value,
      );



      $this->db->select("b.*");
      $this->db->from("books AS b");

      // $this->db->where("b.is_active != '3'", NULL, false);
      // $this->db->where('b.created_by', $this->session->user_id);


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
    public function getBooksDatatable($limit = 10, $offset = 0, $sort_col = 'b.title', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE)
    {
      $this->_getDataTableBooks($sort_col, $sort_dir, $search_value, $headers_only, $raw);

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
    public function datatable_count_all($sort_col = 'b.title', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE)
    {
    $this->_getDataTableBooks($sort_col, $sort_dir, $search_value, $headers_only, $raw);

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
    public function datatable_count_filtered($sort_col = 'b.title', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE)
    {
        $this->_getDataTableBooks($sort_col, $sort_dir, $search_value, $headers_only, $raw);

        $query = $this->db->get();

        return $query->num_rows();
    }

    public function getSubCategoryByCategoryId($id)
    {
        //SELECT `sub_category` FROM `book_category` INNER JOIN book_sub_category AS c ON b.id = book_sub_category.category_id WHERE b.title =  'Web Development'
//SELECT `sub_category` FROM `book_sub_category` INNER JOIN book_category AS c ON book_sub_category.category_id = c.id WHERE book_sub_category.category_id = 1
        $this->db->select('sc.id, sc.category_id, sc.sub_category');
        $this->db->from('book_sub_category as sc');
        $this->db->where('sc.category_id', $id);
        $query = $this->db->get();

        
        return $query->result_array();
    }

    public function add_book($data)
    {
        $this->db->insert('books', $data);
    }

    public function get_book_info($id)
    {
        $query = $this->db->get_where('books',array('id' => $id));
        return $query->row_array();
    }

    public function update_changes($data)
    {
         $id = $data['id'];
        $query = $this->db->where('id',$id);
        return $this->db->update('books', $data);
    }

    public function remove_book($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('books');
    }
}