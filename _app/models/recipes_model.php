<?php

class Recipes_model extends MY_Model {

	const DB_TABLE = 'recipes';
	const DB_TABLE_PK = 'id';


	/**
 	 * Unique identified.
 	 * var int
	 */
	public $id;

	/**
 	 * The member who posted the recipe.
 	 * var int
	 */
	public $member_id;	

	/**
 	 * The recipe category ID.
 	 * var int
	 */
	public $category_id;	

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
	public $ingredients;	

	/**
 	 * 
 	 * var string
	 */
	public $directions;			

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
 	 * 
 	 * var string
	 */
	public $photo_caption;		

	/**
 	 * 
 	 * var string
	 */
	public $link;	

	/**
 	 * 
 	 * var string
	 */
	public $link_description;

	/**
 	 * The rating of the record.
 	 * var int
	 */
	public $rating;		

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
 	 * The access level of the record.
 	 * var string
	 */
	public $access;	

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
 	 * Get recipes from the DB and return them as an array.
	 */
	public function get_recipes($limit = 20) {

		$this->db->from('recipes');
		$this->db->where('display', 'yes');
		$this->db->order_by("created_at", "desc");
		if ($limit != '') {
			$this->db->limit($limit);
		}		
		$query = $this->db->get();
		
		return $query->result_array();

	} // end of - function get_recipes


	/**
 	 * Get recipes with category name from the DB and return them as an array.
	 */
	public function get_recipes_with_category_name($limit = 20) {

		$this->db->select('r.*, rc.name AS category_name');
		$this->db->from('recipes AS r');
		$this->db->join('recipe_categories AS rc', 'rc.id = r.category_id');
		$this->db->where('r.display', 'yes');
		$this->db->order_by("r.created_at", "desc");
		if ($limit != '') {
			$this->db->limit($limit);
		}		
		$query = $this->db->get();
		
		return $query->result_array();

	} // end of - function get_recipes_with_category_name



	/**
 	 * Get recipes from the DB and return them as an array.
 	 * @param int id
	 */
	public function get_my_recipes($id) {

		$this->db->from('recipes');
		$this->db->where('member_id', $id);
		$this->db->where('display', 'yes');
		$this->db->order_by("created_at", "desc"); 
		$query = $this->db->get();		
		
		return $query->result_array();	

	} // end of - function get_my_recipes

	
	
	/**
 	 * Get recipes from the DB and return them as an array.
 	 * @param int category_id
	 */
	public function get_recipes_for_category($category_id) {
		
		$this->db->select('r.*, rc.name as category_name');
		$this->db->from('recipes r');
		$this->db->join('recipe_categories rc', 'r.category_id = rc.id', 'left');
		$this->db->where('r.category_id', $category_id);
		$this->db->where('r.display', 'yes');
		$this->db->order_by("r.created_at", "desc");
		$query = $this->db->get();		
		
		
		// $this->db->from('recipes');
		// $this->db->where('category_id', $category_id);
		// $this->db->where('display', 'yes');
		// $this->db->order_by("created_at", "desc"); 
		// $query = $this->db->get();		
		
		return $query->result_array();

	} // end of - function get_recipes_for_category		

	
	
	/**
 	 * Get some random records.
	 */
	public function get_random_recipes($limit = 5) {

		$sql = "SELECT * FROM recipes WHERE id >= (SELECT FLOOR(MAX(id) * RAND()) FROM recipes) ";
		$sql .= "AND display = 'yes' ";
		$sql .= "ORDER BY id LIMIT $limit";

		$query = $this->db->query($sql);		
		
		return $query->result_array();	

	} // end of - function get_random_recipes	
	
	
} // end of - class 

/* End of file recipes_model.php */
/* Location: ./application/models/recipes_model.php */