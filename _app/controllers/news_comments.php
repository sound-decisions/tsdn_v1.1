<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class News_comments extends CI_Controller {


	public function __construct() {

		parent::__construct();
		
		$this->load->model('news_comments_model');
		
	} // end of - function __construct



	/**
	 * Add a record.
	 */
	public function add() {


		// Load helers/libraries/models.
		$this->load->helper('security');
		$this->load->helper('form');
		$this->load->library('form_validation');


		// FInd out what page the form was submitted from.
		//$from_page = $this->input->post('from_page');


		// START OF - Check for SPAM.
		// This field should be empty.
		if ($this->input->post('email_address') != '') {
			redirect('spam_detected', 'refresh');
		}
		// END OF - Check for SPAM.		


		// START OF - Check for SPAM.
		// $this->load->helper('spam_check');
		// $lt = $this->input->post('lt');
		// encrypted_spam_check($lt);
	    // END OF - Check for SPAM.		


		// Form Validation.
		$this->form_validation->set_rules('news_id', 'News ID', 'required');
		$this->form_validation->set_rules('comment_text', 'Comment', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


		// If form validation fails - display the following.
		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			$news_id = $this->input->post('news_id');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('news/view/' . $news_id, 'refresh');			

		} else {

			// Set default values.
			$display = 'yes';
			$featured = 'no';
			$status = 'new';
			$datetime = date('Y-m-d H:i:s', time());

			// Save data.
			$comment = new news_comments_model();
			$comment->news_id = $this->input->post('news_id');
			$comment->member_id = $this->input->post('member_id');
			$comment->comment_text = $this->input->post('comment_text');			
			$comment->display = $display;
			$comment->featured = $featured;
			$comment->status = $status;
			$comment->created_at = $datetime;
			$comment->updated_at = $datetime;

			$comment->save();


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'Your comment was successfully saved.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			if ($this->input->post('from_page') == 'view') {
				redirect('news/view/' . $comment->news_id, 'refresh');
			} else {
				redirect('news', 'refresh');
			}			

		}

	} // end of - function add	



	/**
	 * Delete a record.
	 * @param int $id
	 */
	public function delete($id) {

		$comment = new news_comments_model();
		$comment->load($id);
		if (!$comment->id) {
			//show_404();

			// Set message data and redirect to display the list of publications.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'Comment Not Found.  No data was deleted.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('news/view/' . $comment->news_id, 'refresh');			
		}

		$comment->delete($id);


		// Set message data and redirect to display the list of publications.
		$this->session->set_flashdata('message_class', 'alert-success');
		$this->session->set_flashdata('message', 'The Comment was Deleted!!!');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		redirect('news/view/' . $comment->news_id, 'refresh');				

	} // end of - function delete	






	/**
	 * Add an item from the modal form.
	 * NOT USING RIGHT NOW.
	 */
	public function add_modal() {

		// Load helers/libraries/models.
		$this->load->helper('form');
		$this->load->library('form_validation');


		// Set default values.
		$display = 'yes';
		$featured = 'no';
		$status = 'new';
		$datetime = date('Y-m-d H:i:s', time());

		// Save data.
		$comment = new news_comments_model();
		$comment->news_id = $this->input->post('news_id');
		$comment->member_id = $this->input->post('member_id');
		$comment->comment_text = $this->input->post('comment_text');			
		$comment->display = $display;
		$comment->featured = $featured;
		$comment->status = $status;
		$comment->created_at = $datetime;
		$comment->updated_at = $datetime;

		$comment->save();


		// Set message data and redirect to display the new item.
		$this->session->set_flashdata('message_class', 'alert-success');
		$this->session->set_flashdata('message', 'Your comment was successfully saved.');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		redirect('news/view/' . $comment->news_id, 'refresh');			

	} // end of - function add_modal

	

} // end of - class

/* End of file news_comments.php */
/* Location: ./application/controllers/news_comments.php */