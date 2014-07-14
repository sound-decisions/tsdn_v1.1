<?php

class News_comments_model extends MY_Model {

	const DB_TABLE = 'news_comments';
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
	public $news_id;

	/**
 	 * The member who posted the comment.
 	 * var int
	 */
	public $member_id;	

	/**
 	 * The comment text.
 	 * var string
	 */
	public $comment_text;	

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
 	 * Get news comments from the DB and return them as an array.
 	 * int news_id
	 */
	public function get_news_comments($news_id = 0) {

		$this->db->from('news_comments');
		if ($news_id != 0) {
			$this->db->where('news_id', $news_id);
		}		
		$this->db->where('display', 'yes');
		$this->db->order_by("created_at", "desc"); 
		$query = $this->db->get();
		
		return $query->result_array();	

	} // end of - function get_news_comments


	/**
 	 * Get news comments from the DB and return them as an array.
 	 * int news_id
	 */
	public function get_news_comments_with_member_name($news_id = 0) {

		$this->db->select('nc.id, nc.news_id, nc.member_id, nc.comment_text, nc.created_at, m.first_name, m.last_name');
		$this->db->from('news_comments nc');
		$this->db->join('members m', 'm.id = nc.member_id', 'left');
		if ($news_id != 0) {
			$this->db->where('nc.news_id', $news_id);
		}		
		$this->db->where('nc.display', 'yes');
		$this->db->order_by("nc.created_at", "desc"); 
		$query = $this->db->get();
		
		return $query->result_array();	

	} // end of - function get_news_comments	


	/**
 	 * Delete all comments for a specific news item.
 	 * int news_id
	 */
	public function delete_news_item_news_comments($news_id) {

		$this->db->delete('news_comments', array('news_id' => $news_id)); 

	} // end of - function delete_news_item_news_comments	


} // end of - class 

/* End of file news_comments_model.php */
/* Location: ./application/models/news_comments_model.php */