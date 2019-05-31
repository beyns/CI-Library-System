<?php

class Report_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
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

    private function _getDataTableBorrowedBooks($sort_col = 'bb.id', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE)
    {
      $search_cols = array(
        "bb.id" => $search_value,
      );

//SELECT `fullname`, `title` FROM `borrowed_books` INNER JOIN borrowers as br ON borrowed_books.borrower_id = br.id INNER JOIN books as b ON borrowed_books.book_id = b.id
//name of book, anme, address,contact no.
      $this->db->select("bb.id, b.title,  br.fullname, br.address, br.contact, bb.date_borrowed, bb.due_date");
      $this->db->from("borrowed_books AS bb");
      $this->db->join("books AS b", "bb.book_id = b.id");
      $this->db->join("borrowers AS br", "bb.borrower_id =  br.id");
      $this->db->where("bb.borrowed_status", "UnReturned");
      
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
    public function getBorrowedBooksDatatable($limit = 10, $offset = 0, $sort_col = 'bb.id', $sort_dir = 'ASC', $search_value = "", $headers_only = FALSE, $raw = FALSE)
    {
      $this->_getDataTableBorrowedBooks($sort_col, $sort_dir, $search_value, $headers_only, $raw);

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