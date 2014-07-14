<?php

class Cooking_hints_model extends MY_Model {

	const DB_TABLE = 'cooking_hints';
	const DB_TABLE_PK = 'id';


	/**
 	 * Unique identifier.
 	 * var int
	 */
	public $id;

	/**
 	 * The member who posted the comment.
 	 * var int
	 */
	public $member_id;	

	/**
 	 * The title.
 	 * var string
	 */
	public $title;	

	/**
 	 * The content.
 	 * var string
	 */
	public $content;	

	/**
 	 * Indicates if this record should be displayed or not.
 	 * var string
	 */
	public $display;	

	/**
 	 * Indicates if this record is featured or not.
 	 * var string
	 */
	public $featured;			

	/**
 	 * The status of the record.
 	 * var string
	 */
	public $status;

	/**
 	 * The date and time the record was created.
 	 * var datetime
	 */
	public $created_at;	

	/**
 	 * The date and time the record was last updated.
 	 * var datetime
	 */
	public $updated_at;		



	/**
 	 * Get cooking hints from the DB and return them as an array.
	 */
	public function get_cooking_hints($limit = 20) {

		$this->db->from('cooking_hints');
		$this->db->where('display', 'yes');
		$this->db->order_by("created_at", "desc");
		$this->db->limit($limit);
		$query = $this->db->get();		
		//$query = $this->db->get('news');
		
		return $query->result_array();	

	} // end of - function get_cooking_hints



    public function get_cooking_hints_search_results() {
        
        $sql = '';
        
        // Get search form values.
        $title_search = $this->input->post('title_search');
        
        $this->session->set_userdata('cooking_hints_title_search', $title_search);
        
        
        if ($title_search != '') {

           //$this->session->set_userdata('cooking_hints_search_sql', '');

			$no_search_criteria_entered = false;
        } else {
        	$no_search_criteria_entered = true;
        }
        

		// If no search criteris is entered then return an empty array.
		// if ($no_search_criteria_entered) {
			// $a_cooking_hints = array();
			// return $a_cooking_hints;
		// }		

        
        // If there is no value in the variable sql, create the sql statement.
        if ($sql == '') {
            
            $sql = 'SELECT id, title, content ' . 
                    'FROM cooking_hints ' . 
					'WHERE 1 = 1 ';
 

            if ($title_search != '') {
                //$sql .= 'AND title LIKE "%' . $title_search . '%" ';
				$sql .= 'AND ((title LIKE "%' . $title_search . '%") OR (content LIKE "%' . $title_search . '%")) ';
            }         

            $sql .= 'ORDER BY title ';

            // Save the SQL in a Session Variable.          
            //$this->session->set_userdata('cooking_hints_search_sql', $sql);
                          
        }
            
        $query = $this->db->query($sql);
        return $query->result_array();

    } // end of - function get_movie_search_results    	
	
	
	
	/**
 	 * Get some random records.
	 */
	public function get_random_cooking_hints($limit = 5) {

		$sql = "SELECT * FROM cooking_hints WHERE id >= (SELECT FLOOR(MAX(id) * RAND()) FROM cooking_hints) ";
		$sql .= "AND display = 'yes' ";
		$sql .= "ORDER BY id LIMIT $limit";

		$query = $this->db->query($sql);		
		
		return $query->result_array();	

	} // end of - function get_random_cooking_hints
	




} // end of - class 

/* End of file cooking_hints_model.php */
/* Location: ./application/models/cooking_hints_model.php */