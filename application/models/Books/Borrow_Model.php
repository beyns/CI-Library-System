<?php

class Borrow_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function search($student_num)
    {
       $query = $this->db->get_where('borrowers',array('student_num' => $student_num));
         return $query->row_array();
        if ($query->num_rows() == 1) {
            return true;
        }
        else {
            return false;
        }
    }

    public function borrow($data)
    {
        $this->db->insert_batch('borrowed_books',$data);
        return $this->db->last_query();
    }

    public function count_books($id)
    {
        $this->db->select("count(borrowed_books.book_id) AS count", false);
        $this->db->from("borrowed_books");
        // $this->db->join("borrowers" ,"borrowed_books.borrower_id = borrowers.id");
        $this->db->where("borrower_id", $id);
        $this->db->where("borrowed_status", 'unreturned');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_all_books($id)
    {
       
      $this->db->select("bb.id ,b.barcode, br.fullname, b.title, bb.date_borrowed, bb.due_date, bb.date_returned, bb.borrowed_status, bb.penalty");
      $this->db->from("borrowed_books AS bb");
      $this->db->join("books AS b", "bb.book_id = b.id");
      $this->db->join("borrowers AS br", "bb.borrower_id =  br.id");
      $this->db->where("bb.borrower_id", "$id");
        return $this->db->get()->result();
    }

    public function countAll()
    {
        $this->db->from('borrowed_books');
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

    private function _getDataTableBorrowedBooks($sort_col = 'bb.id', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE, $id = FALSE)
    {
      $search_cols = array(
        "bb.id" => $search_value,
      );

      $this->db->select("bb.id ,b.barcode,bb.book_id, br.fullname, b.title, bb.date_borrowed, bb.due_date, bb.date_returned, bb.borrowed_status, bb.penalty");
      $this->db->from("borrowed_books AS bb");
      $this->db->join("books AS b", "bb.book_id = b.id");
      $this->db->join("borrowers AS br", "bb.borrower_id =  br.id");
      $this->db->where("bb.borrower_id", "$id");

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
    public function getBorrowedBooksDatatable($limit = 10, $offset = 0, $sort_col = 'bb.id', $sort_dir = 'ASC', $search_value = "", $id= FALSE, $headers_only = FALSE, $raw = FALSE)
    {
      $this->_getDataTableBorrowedBooks($sort_col, $sort_dir, $search_value, $headers_only, $raw, $id);

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
    public function datatable_count_all($sort_col = 'bb.id', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE)
    {
    $this->_getDataTableBorrowedBooks($sort_col, $sort_dir, $search_value, $headers_only, $raw);

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
    public function datatable_count_filtered($sort_col = 'bb.id', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE)
    {
        $this->_getDataTableBorrowedBooks($sort_col, $sort_dir, $search_value, $headers_only, $raw);

        $query = $this->db->get();

        return $query->num_rows();
    }
}