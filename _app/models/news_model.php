<?php

class News_model extends MY_Model {

	const DB_TABLE = 'news';
	const DB_TABLE_PK = 'id';


	/**
 	 * Unique identified.
 	 * var int
	 */
	public $id;

	/**
 	 * The story headline.
 	 * var string
	 */
	public $headline;

	/**
 	 * The actual news story content.
 	 * var string
	 */
	public $story;	

	/**
 	 * The date the news story was posted.
 	 * var string
	 */
	public $date_posted;			

	/**
 	 * The file name of the photo that goes with the news story.
 	 * var string
	 */
	public $photo;

	/**
 	 * The caption for the photo.
 	 * var string
	 */
	public $photo_caption;	

	/**
 	 * A Link or URL related to the story.
 	 * var string
	 */
	public $link;	

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
 	 * Get news items from the DB and return them as an array.
	 */
	public function get_news() {

		$this->db->from('news');
		$this->db->where('display', 'yes');
		$this->db->order_by("date_posted", "desc"); 
		$this->db->order_by("created_at", "desc"); 
		$query = $this->db->get();		
		//$query = $this->db->get('news');
		
		return $query->result_array();	

	} // end of - function get_news



	/**
 	 * Get the latest news items from the DB and return them as an array.
	 */
	public function get_latest_news($limit = 5) {

		$this->db->from('news');
		$this->db->where('display', 'yes');
		$this->db->order_by("date_posted", "desc"); 
		$this->db->order_by("created_at", "desc"); 
		$this->db->limit($limit);
		$query = $this->db->get();		
		//$query = $this->db->get('news');
		
		return $query->result_array();

	} // end of - function get_latest_news	



	/**
 	 * Get some random records.
	 */
	public function get_random_news($limit = 5) {

		$sql = "SELECT * FROM news WHERE id >= (SELECT FLOOR(MAX(id) * RAND()) FROM news) ";
		$sql .= "AND display = 'yes' ";
		$sql .= "ORDER BY id LIMIT $limit";

		$query = $this->db->query($sql);		
		
		return $query->result_array();	

	} // end of - function get_random_news


} // end of - class 

/* End of file news_model.php */
/* Location: ./application/models/news_model.php */