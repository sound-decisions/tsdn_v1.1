<?php

class Mdl_links_model extends MY_Model {

	const DB_TABLE = 'mdl_links';
	const DB_TABLE_PK = 'id';


	/**
 	 * Unique identified.
 	 * var int
	 */
	public $id;

	/**
 	 * The member who posted the link.
 	 * var int
	 */
	public $member_id;	

	/**
 	 * The link category ID.
 	 * var int
	 */
	public $category_id;	

	/**
 	 * The url of the link.
 	 * var string
	 */
	public $url;

	/**
 	 * The name of the link.
 	 * var string
	 */
	public $name;

	/**
 	 * 
 	 * var string
	 */
	public $description;

	/**
 	 * 
 	 * var string
	 */
	public $notes;	

	/**
 	 * The username (if there is one) to enter the site.
 	 * var string
	 */
	public $username;

    /**
     * The email (if there is one) to enter the site.
     * var string
     */
    public $email;

	/**
 	 * The password (if there is one) to enter the site.
 	 * var string
	 */
	public $encrypted_password;	

	/**
 	 * The number of times the link has been visited.
 	 * var int
	 */
	public $visit_count;	

	/**
 	 * The date and time the link was last visited.
 	 * var datetime
	 */
	public $last_visited_at;	

	/**
 	 * Indicates if this record is a favorte or not.
 	 * var string
	 */
	public $favorite;		

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
	public function get_mdl_links($limit = 20) {

		$this->db->from('mdl_links');
		$this->db->where('member_id', $this->session->userdata('member_id'));
		$this->db->where('display', 'yes');
		//$this->db->order_by("created_at", "desc");
		$this->db->order_by('visit_count desc');
		$this->db->order_by("updated_at", "desc");
		if ($limit != '') {
			$this->db->limit($limit);
		}		
		$query = $this->db->get();
		
		return $query->result_array();

	} // end of - function get_mdl_links


	/**
 	 * Get links with category name from the DB and return them as an array.
	 */
	public function get_mdl_links_with_category_name($limit = 20) {

		$this->db->select('l.*, lc.name AS category_name');
		$this->db->from('mdl_links AS l');
		$this->db->join('mdl_link_categories AS lc', 'lc.id = l.category_id');
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

	} // end of - function get_mdl_links_with_category_name



	/**
 	 * Get links from the DB and return them as an array.
 	 * @param int id
	 */
	public function get_my_mdl_links($id) {

		$this->db->from('mdl_links');
		$this->db->where('member_id', $id);
		$this->db->where('display', 'yes');
		$this->db->order_by("created_at", "desc"); 
		$query = $this->db->get();		
		
		return $query->result_array();	

	} // end of - function get_my_mdl_links

	
	
	/**
 	 * Get links from the DB and return them as an array.
 	 * @param int category_id
	 */
	public function get_mdl_links_for_category($category_id) {
		
		$this->db->select('l.*, lc.name as category_name');
		$this->db->from('mdl_links l');
		$this->db->join('mdl_link_categories lc', 'l.category_id = lc.id', 'left');
		$this->db->where('l.member_id', $this->session->userdata('member_id'));
		$this->db->where('l.category_id', $category_id);
		$this->db->where('l.display', 'yes');
		$this->db->order_by("l.name", "asc");
		$query = $this->db->get();
		
		return $query->result_array();

	} // end of - function get_mdl_links_for_category		

	
	
	/**
 	 * Get some random records.
	 */
	public function get_random_mdl_links($limit = 5) {

		$sql = "SELECT * FROM mdl_links WHERE id >= (SELECT FLOOR(MAX(id) * RAND()) FROM mdl_links) ";
		$sql .= "AND display = 'yes' ";
		$sql .= "ORDER BY id LIMIT $limit";

		$query = $this->db->query($sql);
		
		return $query->result_array();

	} // end of - function get_random_mdl_links	
	
	
	
	
	/**
 	 * Get links from the DB and return them as an array.
 	 * @param int id
	 */
	public function get_mdl_links_most_visited($limit = 100) {

		$member_id = $this->session->userdata('member_id');

		$this->db->from('mdl_links');
		$this->db->where('member_id', $member_id);
		$this->db->where('display', 'yes');
		$this->db->where('visit_count >', 0);
		$this->db->order_by('visit_count desc, name asc');
		$this->db->limit($limit);
		$query = $this->db->get();
		
		return $query->result_array();

	} // end of - function get_mdl_links_most_visited	
	
	
	
	
	/**
 	 * Get links from the DB and return them as an array.
 	 * @param int id
	 */
	public function get_featured_links($limit = 100) {

		$member_id = $this->session->userdata('member_id');

		$this->db->from('mdl_links');
		$this->db->where('member_id', $member_id);
		$this->db->where('display', 'yes');
		$this->db->where('featured', 'yes');
		$this->db->order_by('name asc');
		$this->db->limit($limit);
		$query = $this->db->get();
		
		return $query->result_array();

	} // end of - function get_featured_links		
	
	
	
	
	
	
	/**
	 * Delete a record.
	 * @param int $id
	 */
	public function delete_by_category($category_id) {
				
		// $sql = "DELETE FROM mdl_links WHERE category_id = " . $category_id . "";
		// $query = $this->db->query($sql);
		// return $query->result_array();
		
		$this->db->where('category_id', $category_id);
		$this->db->delete('mdl_links');

	} // end of - function delete		
	
	
} // end of - class 

/* End of file mdl_links_model.php */
/* Location: ./application/models/mdl_links_model.php */