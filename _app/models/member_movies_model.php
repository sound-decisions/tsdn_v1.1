<?php

class Member_movies_model extends MY_Model {

	const DB_TABLE = 'member_movies';
	const DB_TABLE_PK = 'id';


	/**
 	 * Issue unique identified.
 	 * var int
	 */
	public $id;

	/**
 	 * The member who posted the recipe.
 	 * var int
	 */
	public $member_id;	

	/**
 	 * The movie ID.
 	 * var int
	 */
	public $movie_id;

	/**
 	 * The index number.
 	 * var int
	 */
	public $index_number;

	/**
 	 * 
 	 * var decimal
	 */
	public $review_rating;

	/**
 	 * 
 	 * var string
	 */
	public $review_text;

	/**
 	 * 
 	 * var string
	 */
	public $on_watch_list;	

	/**
 	 * 
 	 * var string
	 */
	public $seen_it;

	/**
 	 * 
 	 * var string
	 */
	public $own_it;

	/**
 	 * 
 	 * var string
	 */
	public $burned_it;

	/**
 	 * 
 	 * var string
	 */
	public $backed_up;				

	/**
 	 * 
 	 * var string
	 */
	public $downloaded_it;

	/**
 	 * 
 	 * var string
	 */
	public $in_collection;	

	/**
 	 * 
 	 * var string
	 */
	public $in_720;			

	/**
 	 * 
 	 * var string
	 */
	public $in_1080;

	/**
 	 * 
 	 * var string
	 */
	public $in_3d;	

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
 	 * Load a member_movies record based on member_id and movie_id.
	 * @param int $member_id
	 * @param int $movie_id
	 */
	public function load_using_member_id_and_movie_id($member_id, $movie_id) {

		$query = $this->db->get_where('member_movies', array (
			'member_id' => $member_id, 
			'movie_id' => $movie_id, 
		));
		
		return $query->row();

	} // end of - function load_using_member_id_and_movie_id




	/**
 	 * Delete all records based on movie_id.
	 * @param int $movie_id
	 */
	public function delete_records_based_on_movie_id($movie_id) {

        $sql = 'DELETE FROM member_movies ' . 
                'WHERE movie_id = ' . $movie_id . ' ';
		
		$query = $this->db->query($sql);

	} // end of - function delete_records_based_on_movie_id



	
} // end of - class 

/* End of file member_movies_model.php */
/* Location: ./application/models/member_movies_model.php */
