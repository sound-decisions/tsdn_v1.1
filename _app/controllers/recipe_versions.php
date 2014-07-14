<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Recipe_versions extends CI_Controller {


	public function __construct() {

		parent::__construct();
		
		$this->load->model('recipe_versions_model');
		
	} // end of - function __construct


	/**
	 * List records.
	 */
	public function index() {

		// Load helers/libraries/models.
		$this->load->helper('form');

		$a_recipe_versions = array();
		$a_recipe_versions = $this->recipe_versions_model->get_recipe_versions();


		// Set the title for the page.
		$page_data['title'] = 'Recipe Versions';
		$data['title'] = 'Recipe Versions';	
		$data['recipe_versions'] = $a_recipe_versions;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('recipe_versions/index', $data);
		$this->load->view('templates/footer');

	} // end of - function index



	/**
	 * View a record.
	 * @param int $id
	 */
	public function view($id) {

		// Load helers/libraries/models.
		$this->load->helper('date');

		$recipe_version = new recipe_versions_model();
		$recipe_version->load($id);
		if (!$recipe_version->id) {
			show_404();
		}

		// Set the title for the page.
		$page_data['title'] = 'Recipe Version';
		// Set content for the page.
		$data['title'] = 'Recipe Version';			
		$data['recipe_version'] = $recipe_version;	

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('recipe_versions/view', $data);
		$this->load->view('templates/footer');			

	} // end of - function view



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
		$this->load->library('upload');


		// Form Validation.
		$this->form_validation->set_rules('category_id', 'Category ID', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('ingredients', 'Ingredients', 'required');
		$this->form_validation->set_rules('directions', 'Directions', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');	


		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Recipe Categories.
			$this->load->model('recipe_categories_model');
			$recipe_categories = $this->recipe_categories_model->get_recipe_categories();
			$a_recipe_category_form_options = array();

			$a_recipe_category_form_options[''] = '--- Select A Category ---';

			foreach ($recipe_categories as $recipe_category) {
				$a_recipe_category_form_options[$recipe_category['id']] = $recipe_category['name'];
			} // end of - foreach


			// Set the title for the page.	
			$page_data['title'] = 'Add A Recipe Version';		
			$data['title'] = 'Add A Recipe Version';
			$data['recipe_category_form_options'] = $a_recipe_category_form_options;

			$this->load->view('templates/top', $page_data);
			$this->load->view('templates/header', $page_data);
			$this->load->view('recipe_versions/form', $data);
			$this->load->view('templates/footer');

		} else {

			// Set default values.
			$display = 'yes';
			$featured = 'no';
			$status = 'new';
			$datetime = date('Y-m-d H:i:s', time());

			// Save data.
			$recipe_version = new recipe_versions_model();
			$recipe_version->member_id = $this->session->userdata('member_id');
			$recipe_version->category_id = $this->input->post('category_id');
			$recipe_version->name = $this->input->post('name');
			$recipe_version->description = $this->input->post('description');
			$recipe_version->ingredients = $this->input->post('ingredients');
			$recipe_version->directions = $this->input->post('directions');

			$recipe_version->display = $display;
			$recipe_version->featured = $featured;
			$recipe_version->status = $status;
			$recipe_version->created_at = $datetime;
			$recipe_version->updated_at = $datetime;

			$recipe_version->save();


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'The Recipe Version for \'' . html_escape($recipe_version->name) . '\' was successfully saved.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('recipe_versions/view/' . $recipe_version->id, 'refresh');			

		}

	} // end of - function add	



	/**
	 * Edit an item.
	 * @param int $id	 
	 */
    public function edit($id) {
        
		// Load helers/libraries/models.
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');		


		// Form Validation.
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('category_id', 'Category ID', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('ingredients', 'Ingredients', 'required');
		$this->form_validation->set_rules('directions', 'Directions', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


		// Load the record.
		$recipe_version = new recipe_versions_model();
		$recipe_version->load($id);
		if (!$recipe_version->id) {
			show_404();
		}		


		// Recipe Categories.
		$this->load->model('recipe_categories_model');
		$recipe_categories = $this->recipe_categories_model->get_recipe_categories();
		$a_recipe_category_form_options = array();

		foreach ($recipe_categories as $recipe_category) {
			$a_recipe_category_form_options[$recipe_category['id']] = $recipe_category['name'];
		} // end of - foreach	


		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Set the title for the page.
			$page_data['title'] = 'Edit Recipe Version';
			// Set content for the page.		
			$data['title'] = 'Edit Recipe Version';	
			$data['recipe_version'] = $recipe_version;
			$data['recipe_category_form_options'] = $a_recipe_category_form_options;

			$this->load->view('templates/top', $page_data);
	        $this->load->view('templates/header', $page_data);
	        $this->load->view('recipe_versions/form', $data);
	        $this->load->view('templates/footer');

		} else {

			// START OF - Check for SPAM.
			$this->load->helper('spam_check');
			$loadtime = $this->input->post('loadtime');
			spam_check($loadtime);
		    // END OF - Check for SPAM.

			// Set default values.
			$datetime = date('Y-m-d H:i:s', time());

			// Save the data.
			// $recipe_version = new recipe_versions_model();
			// $recipe_version->load($this->input->post('id'));

			$recipe_version->category_id = $this->input->post('category_id');
			$recipe_version->name = $this->input->post('name');
			$recipe_version->description = $this->input->post('description');
			$recipe_version->ingredients = $this->input->post('ingredients');
			$recipe_version->directions = $this->input->post('directions');

			$recipe_version->display = $recipe_version->display;
			$recipe_version->featured = $recipe_version->featured;
			$recipe_version->status = $recipe_version->status;
			$recipe_version->created_at = $recipe_version->created_at;
			$recipe_version->updated_at = $datetime;

			$recipe_version->save();


			// Set message data and redirect to display the magazine.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'The Recipe Version for \'' . html_escape($recipe_version->name) . '\' Updated!!!');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('recipes/view/' . $id, 'refresh');

		}        

    } // end of - function edit	



	/**
	 * Delete a record.
	 * @param int $id
	 */
	public function delete($id) {

		$recipe_version = new recipe_versions_model();
		$recipe_version->load($id);
		if (!$recipe_version->id) {
			//show_404();

			// Set message data and redirect to display the list of publications.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'Recipe Version Not Found.  No data was deleted.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('recipe_versions', 'refresh');			
		}


		// Need to delete all comments associated with this recipe.
		$this->load->model('recipe_comments_model');
		$this->recipe_comments_model->delete_recipe_comments($id);
		

		$recipe_version->delete($id);


		// Set message data and redirect to display the list of publications.
		$this->session->set_flashdata('message_class', 'alert-success');
		$this->session->set_flashdata('message', 'Recipe Version \'' . html_escape($recipe->name) . '\' was Deleted!!!');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		redirect('recipe_versions', 'refresh');				

	} // end of - function delete	

} // end of - class

/* End of file recipe_versions.php */
/* Location: ./application/controllers/recipe_versions.php */