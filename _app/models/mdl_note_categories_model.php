<?php

class Mdl_note_categories_model extends MY_Model {

	const DB_TABLE = 'mdl_note_categories';
	const DB_TABLE_PK = 'id';


	/**
 	 * Unique identified.
 	 * var int
	 */
	public $id;

	/**
 	 * The name of the recipe.
 	 * var string
	 */
	public $name;

	/**
 	 * The sort order for the list.
 	 * var int
	 */
	public $sort_order;	

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




/*
SELECT c1.id, c1.parent_id, c1.name, c2.name as `parent_name` 
FROM mdl_note_categories c1  
LEFT OUTER JOIN mdl_note_categories c2 on c1.parent_id = c2.id 
WHERE c1.member_id = 1 
AND c1.display = 'yes' 
ORDER BY c1.name
 * /


  	/**
 	 * Get categories with parent category name from the DB and return them as an array.
	 */
	public function get_mdl_note_categories_with_parent_name($order_by = "name") {
		
		// If a member isn't signed in then return an empty array.		
		if ($this->session->userdata('member_id') != '') {
		
			$this->db->select('c1.id, c1.parent_id, c1.name, c1.sort_order, c2.name AS parent_name');
			$this->db->from('mdl_note_categories AS c1');
			$this->db->join('mdl_note_categories AS c2', 'c2.id = c1.parent_id', 'left outer');
			$this->db->where('c1.member_id', $this->session->userdata('member_id'));
			$this->db->where('c1.display', 'yes');
			// if ($order_by == "sort_order") {
				// $this->db->order_by("c1.sort_order", "asc");
			// }		
			$this->db->order_by('parent_name');
			$this->db->order_by("c1.name", "asc"); 
			//$this->db->order_by("c1.created_at", "asc");
			$query = $this->db->get();
			
			// Testing.
			//echo '<p>sql = ' . $this->db->last_query() . '</p>' . chr(10);			
			
			return $query->result_array();
			
		} else {
			
			return $a_return();
						
		}

	} // end of - function get_mdl_note_categories_with_parent_name


	/**
 	 * Get categories from the DB and return them as an array.
	 */
	public function get_mdl_note_categories($order_by = "name") {
		
		// If a member isn't signed in then return an empty array.		
		if ($this->session->userdata('member_id') != '') {
		
			$this->db->from('mdl_note_categories');
			$this->db->where('member_id', $this->session->userdata('member_id'));
			$this->db->where('display', 'yes');
			if ($order_by == "sort_order") {
				$this->db->order_by("sort_order", "asc");
			}		
			$this->db->order_by("name", "asc"); 
			$this->db->order_by("created_at", "asc"); 
			$query = $this->db->get();
			
			return $query->result_array();
			
		} else {
			
			return $a_return();

		}

	} // end of - function get_mdl_note_categories
	
	
	
	/**
 	 * Get categories from the DB and return them as an array.
	 */
	public function get_mdl_note_categories_with_no_parent($order_by = "name") {
		
		// If a member isn't signed in then return an empty array.		
		if ($this->session->userdata('member_id') != '') {
		
			$this->db->from('mdl_note_categories');
			$this->db->where('member_id', $this->session->userdata('member_id'));
			$this->db->where('display', 'yes');
			$this->db->where('parent_id', 0);
			// if ($order_by == "sort_order") {
				// $this->db->order_by("sort_order", "asc");
			// }		
			$this->db->order_by("name", "asc"); 
			//$this->db->order_by("created_at", "asc");
			$query = $this->db->get();
			
			//$sql = 'SELECT * FROM (mdl_note_categories) WHERE member_id = 1 AND display = "yes" AND id = parent_id ORDER BY name asc, created_at asc';
			//$sql = "SELECT * FROM (mdl_note_categories) WHERE member_id = " . $this->session->userdata('member_id') . " AND display = 'yes' AND id = parent_id ORDER BY name asc, created_at asc";			
			//$query = $this->db->query($sql);
			
			// Testing.
			//echo '<p>sql = ' . $this->db->last_query() . '</p>' . chr(10);			
			
			return $query->result_array();
			
		} else {
			
			return $a_return();

		}

	} // end of - function get_mdl_note_categories_with_no_parent	
	
	
	
	
	
	/**
 	 * Get categories from the DB and return them as an array.
	 */
	public function get_mdl_note_categories_with_p($order_by = "name") {
		
		// If a member isn't signed in then return an empty array.		
		if ($this->session->userdata('member_id') != '') {
		
			$this->db->from('mdl_note_categories');
			$this->db->where('member_id', $this->session->userdata('member_id'));
			$this->db->where('display', 'yes');
			$this->db->where('parent_id !=', 0);
			if ($order_by == "sort_order") {
				$this->db->order_by("sort_order", "asc");
			}		
			$this->db->order_by("name", "asc"); 
			$this->db->order_by("created_at", "asc"); 
			$query = $this->db->get();
			
			return $query->result_array();
			
		} else {
			
			return $a_return();

		}

	} // end of - function get_mdl_note_categories_with_p
	
		
	/**
 	 * Get categories from the DB and return them as an array.
	 */
	public function get_mdl_note_categories_no_p($order_by = "name") {
		
		// If a member isn't signed in then return an empty array.		
		if ($this->session->userdata('member_id') != '') {
		
			$this->db->from('mdl_note_categories');
			$this->db->where('member_id', $this->session->userdata('member_id'));
			$this->db->where('display', 'yes');
			$this->db->where('parent_id', 0);	
			$this->db->order_by("name", "asc"); 
			$query = $this->db->get();
			
			return $query->result_array();
			
		} else {
			
			return $a_return();

		}

	} // end of - function get_mdl_note_categories_no_p		
	
	
	
	
	/**
	 * Create an object array for categories with sub categories based on
	 * Parent and Category.
	 */
	public function get_category_sub_category_object_array() {

		$a_categories_no_p = array();
		$a_categories_no_p = $this->get_mdl_note_categories_no_p();
		$a_categories_w_p = array();
		$a_categories_w_p = $this->get_mdl_note_categories_with_p();				


		// Create an object array by looping through 2 arrays 
		// to get the values in the order that we want.
		$a_mdl_categories = array();
		
		foreach ($a_categories_no_p as $mdl_category_p) {
			
			$a_data = new stdClass();
			$a_data->id = $mdl_category_p['id'];
			$a_data->parent_id = $mdl_category_p['parent_id'];
			$a_data->category = $mdl_category_p['name'];
			$a_data->sub_category = '';
			
			$a_mdl_categories[] = $a_data;
	
				foreach ($a_categories_w_p as $mdl_category) {
					
					// If the id of the category matches the parent_id add another object to the array.
					if ($mdl_category_p['id'] == $mdl_category['parent_id']) {
						$a_data = new stdClass();
						$a_data->id = $mdl_category['id'];
						$a_data->parent_id = $mdl_category['parent_id'];
						$a_data->category = $mdl_category_p['name'];
						$a_data->sub_category = $mdl_category['name'];
						
						$a_mdl_categories[] = $a_data;
					}
					
				} // end of - foreach
	
		} // end of - foreach

		return $a_mdl_categories;

	} // end of - function get_category_sub_category_object_array	
	
	
	
	
	/**
 	 * Get categories from the DB and return them as an array.
	 * Include the number of records that have each category.
	 */
	public function get_mdl_note_categories_with_number_of_records() {

		$this->db->select('nc.id, nc.name, count(n.id) AS num_records');
		$this->db->from('mdl_note_categories AS nc');
		$this->db->join('mdl_notes AS n', 'nc.id = n.category_id', 'left');
		$this->db->where('nc.display', 'yes');
		$this->db->where('nc.display', 'yes');
		$this->db->group_by('nc.id');
		$this->db->order_by('nc.name', 'asc'); 
		$query = $this->db->get();
		
		// Testing.
		//echo '<p>sql = ' . $this->db->last_query() . '</p>' . chr(10);
		
		return $query->result_array();	

	} // end of - function get_mdl_note_categories_with_number_of_records	
	
	
	/**
 	 * Get category name from the DB and return it.
 	 * @param int id
	 * */
	public function get_category_name($id) {
		
		// $this->db->select('name');
		// $this->db->from('mdl_note_categories');
		// $this->db->where('id', $id);
// 
		// return $this->db->get()->row()->name;
		
		$this->db->select('c1.id, c1.parent_id, c1.name, c2.name AS parent_name');
		$this->db->from('mdl_note_categories AS c1');
		$this->db->join('mdl_note_categories AS c2', 'c2.id = c1.parent_id', 'left outer');
		$this->db->where('c1.id', $id);
		
		return $this->db->get()->row();		

	} // end of - function get_category_name	


} // end of - class 

/* End of file mdl_note_categories_model.php */
/* Location: ./application/models/mdl_note_categories_model.php */