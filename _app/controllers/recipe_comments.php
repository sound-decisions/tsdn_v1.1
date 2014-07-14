<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Recipe_comments extends CI_Controller {


	public function __construct() {

		parent::__construct();
		
		$this->load->model('recipe_comments_model');
		
	} // end of - function __construct


	/**
	 * List records.
	 */
	public function index() {

		$a_recipe_comments = array();
		$a_recipe_comments = $this->recipe_comments_model->get_recipe_comments();


		// Set the title for the page.
		$page_data['title'] = 'Recipe Comments';
		$data['title'] = 'Recipe Comments';	
		$data['recipe_comments'] = $a_recipe_comments;

		$this->load->view('templates/top', $data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('recipe_comments/index', $data);
		$this->load->view('templates/footer');

	} // end of - function index



	/**
	 * Add a record.
	 */
	public function add() {

		// START OF - Check for SPAM.
		$this->load->helper('spam_check');
		$loadtime = $this->input->post('loadtime');
		spam_check($loadtime);
	    // END OF - Check for SPAM.


		// Load helers/libraries/models.
		$this->load->helper('form');
		$this->load->library('form_validation');


		// Form Validation.
		$this->form_validation->set_rules('recipe_id', 'Recipe ID', 'required');
		$this->form_validation->set_rules('comment_text', 'Comment', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


		// If form validation fails - display the following.
		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			$recipe_id = $this->input->post('recipe_id');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('recipes/view/' . $recipe_id, 'refresh');			

		} else {

			// Set default values.
			$display = 'yes';
			$featured = 'no';
			$status = 'new';
			$datetime = date('Y-m-d H:i:s', time());

			// Save data.
			$comment = new recipe_comments_model();
			$comment->recipe_id = $this->input->post('recipe_id');
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
				redirect('recipes/view/' . $comment->recipe_id, 'refresh');
			} else {
				redirect('recipes', 'refresh');
			}			

		}

	} // end of - function add	



	/**
	 * Delete a record.
	 * @param int $id
	 */
	public function delete($id) {

		$comment = new recipe_comments_model();
		$comment->load($id);
		if (!$comment->id) {
			//show_404();

			// Set message data and redirect to display the list of publications.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'Comment Not Found.  No data was deleted.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('recipes/view/' . $comment->recipe_id, 'refresh');			
		}

		$comment->delete($id);


		// Set message data and redirect to display the list of publications.
		$this->session->set_flashdata('message_class', 'alert-success');
		$this->session->set_flashdata('message', 'The Comment was Deleted!!!');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		redirect('recipes/view/' . $comment->recipe_id, 'refresh');				

	} // end of - function delete	


} // end of - class

/* End of file recipe_comments.php */
/* Location: ./application/controllers/recipe_comments.php */