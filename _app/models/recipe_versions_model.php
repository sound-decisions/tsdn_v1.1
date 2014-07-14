<?php

class Recipe_versions_model extends MY_Model {

	const DB_TABLE = 'recipe_versions';
	const DB_TABLE_PK = 'id';


	/**
 	 * Unique identified.
 	 * var int
	 */
	public $id;

	/**
 	 * The foreign key.
 	 * var int
	 */
	public $recipe_id;	

	/**
 	 * The member who posted the recipe.
 	 * var int
	 */
	public $member_id;		

	/**
 	 * The name of the recipe version.
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
	public $note_title;

	/**
 	 * 
 	 * var string
	 */
	public $note;	

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
 	 * The date and time the record was created.
 	 * var datetime
	 */
	public $created_at;	

	/**
 	 * The date and time the record was last updated.
 	 * var datetime
	 */
	public $updated_at;		


} // end of - class 

/* End of file recipe_versions_model.php */
/* Location: ./application/models/recipe_versions_model.php */