<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Recipe_notes extends CI_Controller {


	public function __construct() {

		parent::__construct();
		
		$this->load->model('recipe_notes_model');
		
	} // end of - function __construct


	/**
	 * List records.
	 */
	public function index() {

		$a_recipe_notes = array();
		$a_recipe_notes = $this->recipe_notes_model->get_recipe_notes();


		// Set the title for the page.
		$page_data['title'] = 'Recipe Notes';
		$data['title'] = 'Recipe Notes';	
		$data['recipe_notes'] = $a_recipe_notes;

		$this->load->view('templates/header', $page_data);
		$this->load->view('recipe_notes/index', $data);
		$this->load->view('templates/footer');

	} // end of - function index



	/**
	 * Add a record.
	 */
	public function add($recipe_id = 0) {

		// Load helers/libraries/models.
		$this->load->helper('form');
		$this->load->library('form_validation');


		// Form Validation.
		$this->form_validation->set_rules('recipe_id', 'Recipe ID', 'required');
		$this->form_validation->set_rules('note', 'Note', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


		// If form validation fails - display the following.
		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Set the title for the page.	
			$page_data['title'] = 'Add A Recipe Note';		
			$data['title'] = 'Add A Recipe Note';
			$data['recipe_id'] = $recipe_id;

			$this->load->view('templates/top', $page_data);
			$this->load->view('templates/header', $page_data);
			$this->load->view('templates/advertising');
			$this->load->view('recipe_notes/form', $data);
			$this->load->view('templates/footer');


		} else {

			// Set default values.
			$display = 'yes';
			$featured = 'no';
			$status = 'new';
			$datetime = date('Y-m-d H:i:s', time());
			
			$member_id = $this->session->userdata('member_id');

			// Save data.
			$note = new recipe_notes_model();
			$note->recipe_id = $this->input->post('recipe_id');
			//$note->version_id = $this->input->post('version_id');
			//$note->member_id = $this->input->post('member_id');
			$note->member_id = $member_id;
			$note->title = $this->input->post('title');
			$note->note = $this->input->post('note');			
			$note->display = $display;
			$note->featured = $featured;
			$note->status = $status;
			$note->created_at = $datetime;
			$note->updated_at = $datetime;

			$note->save();


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'Your note was successfully saved.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('recipes/view/' . $note->recipe_id, 'refresh');		

		}

	} // end of - function add	




	/**
	 * Edit an item.
	 * @param int $id	 
	 */
    public function edit($id) {
        
		// Load helers/libraries/models.
		$this->load->helper('security');
		$this->load->helper('form');
		$this->load->library('form_validation');	


		// Form Validation.
		$this->form_validation->set_rules('recipe_id', 'Recipe ID', 'required');
		$this->form_validation->set_rules('note', 'Note', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


		// Load the record.
		$note = new recipe_notes_model();
		$note->load($id);
		if (!$note->id) {
			show_404();
		}		


		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Set the title for the page.
			$page_data['title'] = 'Edit Recipe Note';
			// Set content for the page.		
			$data['title'] = 'Edit Recipe Note';	
			$data['recipe_note'] = $note;
			$data['recipe_id'] = $note->recipe_id;

			$this->load->view('templates/top', $page_data);
	        $this->load->view('templates/header', $page_data);
	        $this->load->view('templates/advertising');
	        $this->load->view('recipe_notes/form', $data);
	        $this->load->view('templates/footer');

		} else {

			// Set default values.
			$datetime = date('Y-m-d H:i:s', time());

			// Save data.
			$note->title = $this->input->post('title');
			$note->note = $this->input->post('note');			
			
			$note->updated_at = $datetime;

			$note->save();


			// Set message data and redirect to display the magazine.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'The Note was Updated!!!');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('recipes/view/' . $note->recipe_id, 'refresh');

		}        

    } // end of - function edit	





	/**
	 * Delete a record.
	 * @param int $id
	 */
	public function delete($id) {

		$note = new recipe_notes_model();
		$note->load($id);
		if (!$note->id) {
			//show_404();

			// Set message data and redirect to display the list of publications.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'Note Not Found.  No data was deleted.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('recipes/view/' . $note->recipe_id, 'refresh');			
		}

		$note->delete($id);


		// Set message data and redirect to display the list of publications.
		$this->session->set_flashdata('message_class', 'alert-success');
		$this->session->set_flashdata('message', 'The Note was Deleted!!!');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		redirect('recipes/view/' . $note->recipe_id, 'refresh');				

	} // end of - function delete	


} // end of - class

/* End of file recipe_notes.php */
/* Location: ./application/controllers/recipe_notes.php */