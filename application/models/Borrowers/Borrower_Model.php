<?php

class Borrower_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_borrowers()
    {
      $query = $this->db->get('borrowers');
      return $query->result_array();
    }

    public function getTotal($id)
    {
      //SELECT COUNT(`title`) FROM `borrowed_books` INNER JOIN borrowers as br ON borrowed_books.borrower_id = br.id INNER JOIN books as b ON borrowed_books.book_id = b.id WHERE borrowed_books.borrower_id = 1
      $this->db->select("count(borrowed_books.book_id) AS count", false);
      $this->db->from("borrowed_books");
      // $this->db->join("borrowers" ,"borrowed_books.borrower_id = borrowers.id");
      $this->db->where("borrower_id", $id);
      $this->db->where("borrowed_status", 'unreturned');
      $query = $this->db->get();
      return $query->result();
    }
    public function countAll()
    {
        $this->db->from('borrowers');
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

    private function _getDataTableBooks($sort_col = 'c.id', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE)
    {
      $search_cols = array(
        "c.id" => $search_value,
      );


      $this->db->select("c.*");
      $this->db->from("borrowers AS c");

    //   $this->db->select("b.*");
    //   $this->db->from("borrowed_books AS b");

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
    public function getBorrowedBooksDatatable($limit = 10, $offset = 0, $sort_col = 'c.id', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE)
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
    public function datatable_count_all($sort_col = 'c.id', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE)
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
    public function datatable_count_filtered($sort_col = 'c.id', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE)
    {
        $this->_getDataTableBooks($sort_col, $sort_dir, $search_value, $headers_only, $raw);

        $query = $this->db->get();

        return $query->num_rows();
    }
}