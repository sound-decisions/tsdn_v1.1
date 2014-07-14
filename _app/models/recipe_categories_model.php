<?php

class Recipe_categories_model extends MY_Model {

	const DB_TABLE = 'recipe_categories';
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
 	 * 
 	 * var string
	 */
	public $description;

	/**
 	 * 
 	 * var string
	 */
	public $photo;

	/**
 	 * 
 	 * var string
	 */
	public $photo_tn;	

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


	/**
 	 * Get recipe categories from the DB and return them as an array.
	 */
	public function get_recipe_categories($order_by = "name") {

		$this->db->from('recipe_categories');
		$this->db->where('display', 'yes');
		if ($order_by == "sort_order") {
			$this->db->order_by("sort_order", "asc");	
		}		
		$this->db->order_by("name", "asc"); 
		$this->db->order_by("created_at", "asc"); 
		$query = $this->db->get();		
		
		return $query->result_array();	

	} // end of - function get_recipe_categories
	
	
	
	/**
 	 * Get recipe categories from the DB and return them as an array.
	 * Include the number of recipes for each category.
	 */
	public function get_recipe_categories_with_number_of_recipes() {

		$this->db->select('rc.id, rc.name, count(r.id) AS num_recipes');
		$this->db->from('recipe_categories AS rc');
		$this->db->join('recipes AS r', 'rc.id = r.category_id', 'left');
		$this->db->where('rc.display', 'yes');
		//$this->db->where('r.display', 'yes');
		$this->db->group_by('rc.name');
		$this->db->order_by('rc.name', 'asc'); 
		$query = $this->db->get();
		
		// Testing.
		//echo '<p>sql = ' . $this->db->last_query() . '</p>' . chr(10);
		
		return $query->result_array();	

	} // end of - function get_recipe_categories_with_number_of_recipes	
	
	
	/**
 	 * Get recipe categories from the DB and return them as an array.
 	 * @param int id
	 * */
	public function get_recipe_category_name($id) {
		
		$this->db->select('name');
		$this->db->from('recipe_categories');
		$this->db->where('id', $id);

		return $this->db->get()->row()->name;

	} // end of - function get_recipe_category_name	


} // end of - class 

/* End of file recipe_categories_model.php */
/* Location: ./application/models/recipe_categories_model.php */