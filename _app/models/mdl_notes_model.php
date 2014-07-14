<?php

class Mdl_notes_model extends MY_Model {

	const DB_TABLE = 'mdl_notes';
	const DB_TABLE_PK = 'id';


	/**
 	 * Unique identified.
 	 * var int
	 */
	public $id;

	/**
 	 * The member who posted the note.
 	 * var int
	 */
	public $member_id;	

	/**
 	 * The note category ID.
 	 * var int
	 */
	public $category_id;	

	/**
 	 * The title of the note..
 	 * var string
	 */
	public $note_title;

	/**
 	 * 
 	 * var string
	 */
	public $note_content;

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
 	 * Get links from the DB and return them as an array.
	 */
	public function get_mdl_notes($limit = 20) {

		$this->db->from('mdl_notes');
		$this->db->where('member_id', $this->session->userdata('member_id'));
		$this->db->where('display', 'yes');
		$this->db->order_by("created_at", "desc");
		if ($limit != '') {
			$this->db->limit($limit);
		}		
		$query = $this->db->get();
		
		return $query->result_array();

	} // end of - function get_mdl_notes


	/**
 	 * Get links with category name from the DB and return them as an array.
	 */
	public function get_mdl_notes_with_category_name($limit = 20) {

		$this->db->select('l.*, lc.name AS category_name');
		$this->db->from('mdl_notes AS l');
		$this->db->join('mdl_note_categories AS lc', 'lc.id = l.category_id');
		$this->db->where('l.member_id', $this->session->userdata('member_id'));
		$this->db->where('l.display', 'yes');
		$this->db->order_by("category_name");
		//$this->db->order_by("l.created_at", "desc");
		if ($limit != '') {
			$this->db->limit($limit);
		}		
		$query = $this->db->get();
		
		// Testing.
		//echo '<p>sql = ' . $this->db->last_query() . '</p>' . chr(10);		
		
		return $query->result_array();

	} // end of - function get_mdl_notes_with_category_name



	/**
 	 * Get links from the DB and return them as an array.
 	 * @param int id
	 */
	public function get_my_mdl_notes($id) {

		$this->db->from('mdl_notes');
		$this->db->where('member_id', $id);
		$this->db->where('display', 'yes');
		//$this->db->order_by("created_at", "desc");
		$this->db->order_by("updated_at", "desc");
		$query = $this->db->get();
		
		return $query->result_array();

	} // end of - function get_my_mdl_notes

	
	
	/**
 	 * Get links from the DB and return them as an array.
 	 * @param int category_id
	 */
	public function get_mdl_notes_for_category($category_id) {
		
		$this->db->select('l.*, lc.name as category_name');
		$this->db->from('mdl_notes l');
		$this->db->join('mdl_note_categories lc', 'l.category_id = lc.id', 'left');
		$this->db->where('l.member_id', $this->session->userdata('member_id'));
		$this->db->where('l.category_id', $category_id);
		$this->db->where('l.display', 'yes');
		$this->db->order_by("l.created_at", "desc");
		$query = $this->db->get();
		
		return $query->result_array();

	} // end of - function get_mdl_notes_for_category		

	
	
	/**
 	 * Get some random records.
	 */
	public function get_random_mdl_notes($limit = 5) {

		$sql = "SELECT * FROM mdl_notes WHERE id >= (SELECT FLOOR(MAX(id) * RAND()) FROM mdl_notes) ";
		$sql .= "AND display = 'yes' ";
		$sql .= "ORDER BY id LIMIT $limit";

		$query = $this->db->query($sql);
		
		return $query->result_array();	

	} // end of - function get_random_mdl_notes	
	
	
} // end of - class 

/* End of file mdl_notes_model.php */
/* Location: ./application/models/mdl_notes_model.php */