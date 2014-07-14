<?php

class Recipe_notes_model extends MY_Model {

	const DB_TABLE = 'recipe_notes';
	const DB_TABLE_PK = 'id';


	/**
 	 * Unique identifier.
 	 * var int
	 */
	public $id;

	/**
 	 * The foreign key.
 	 * var int
	 */
	public $recipe_id;

	/**
 	 * The foreign key.
 	 * var int
	 */
	public $version_id;	

	/**
 	 * The member who posted the note.
 	 * var int
	 */
	public $member_id;	

	/**
 	 * The note title.
 	 * var string
	 */
	public $title;	
	
	/**
 	 * The note content.
 	 * var string
	 */
	public $note;		

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
 	 * Get recipe comments from the DB and return them as an array.
 	 * @param int recipe_id
 	 * @param int version_id
	 */
	public function get_recipe_notes($recipe_id = 0, $version_id = 0) {

		$this->db->from('recipe_notes');
		if ($recipe_id != 0) {
			$this->db->where('recipe_id', $recipe_id);
		}	
		if ($version_id != 0) {
			$this->db->where('version_id', $version_id);
		}				
		$this->db->where('display', 'yes');
		$this->db->order_by("created_at", "desc"); 
		$query = $this->db->get();
		
		return $query->result_array();	

	} // end of - function get_recipe_notes


	/**
 	 * Delete all comments for a specific recipe or recipe version.
 	 * @param int recipe_id
 	 * @param int version_id
	 */
	public function delete_recipe_notes($recipe_id = 0, $version_id = 0) {

		if ($recipe_id != 0) {
			if ($version_id != 0) {
				$this->db->delete('recipe_notes', array('recipe_id' => $recipe_id, 'version_id' => $version_id)); 
			} else {
				$this->db->delete('recipe_notes', array('recipe_id' => $recipe_id)); 
			}						
		}		

	} // end of - function delete_recipe_notes	


} // end of - class 

/* End of file recipe_notes_model.php */
/* Location: ./application/models/recipe_notes_model.php */