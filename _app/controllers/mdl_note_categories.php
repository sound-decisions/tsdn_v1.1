<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Mdl_note_categories extends CI_Controller {


	public function __construct() {

		parent::__construct();
		
		$this->load->model('mdl_note_categories_model');
		
	} // end of - function __construct




	/**
	 * List records.
	 */
	public function index() {
		
		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in();		
		
		// Create and return categories array.
		$a_mdl_note_categories = array();
		$a_mdl_note_categories = $this->mdl_note_categories_model->get_category_sub_category_object_array();

		// Get the data for the list.
		$data_for_list['mdl_note_categories'] = $a_mdl_note_categories;		
		
		// Create the list view code.
		$mdl_note_categories_list = $this->load->view('mdl_note_categories/_list_group', $data_for_list, true);	
		//$mdl_note_categories_list = $this->load->view('mdl_note_categories/_simple_list_2', $data_for_list, true);


		// Set the title for the page.
		$page_data['top_menu'] = 'Members Only';
		$page_data['title'] = 'Note Categories';
		$data['title'] = 'Note Categories';	
		//$data['mdl_note_categories'] = $a_mdl_note_categories;
		$data['mdl_note_categories_list'] = $mdl_note_categories_list;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('mdl_note_categories/index', $data);
		$this->load->view('templates/footer');

	} // end of - function index



	/**
	 * View a record.
	 * @param int $id
	 */
	public function view($id) {

		// Load helers/libraries/models.
		$this->load->helper('date');

		$mdl_note_category = new mdl_note_categories_model();
		$mdl_note_category->load($id);
		if (!$mdl_note_category->id) {
			show_404();
		}

		// Set the title for the page.
		$page_data['top_menu'] = 'Admin Menu';
		$page_data['dropdown_menu'] = 'Note Categories';
		$page_data['title'] = 'Note Category';
		
		// Set content for the page.
		$data['title'] = 'Link Category';
		$data['note_category'] = $mdl_note_category;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('mdl_note_categories/view', $data);
		$this->load->view('templates/footer');

	} // end of - function view



	/**
	 * Add a record.
	 */
	public function add() {

		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in();	


		// START OF - Check for SPAM.
		$this->load->helper('spam_check');
		$loadtime = $this->input->post('loadtime');
		spam_check($loadtime);
	    // END OF - Check for SPAM.


		// Load helers/libraries/models.
		$this->load->helper('form');
		$this->load->library('form_validation');


		// Form Validation.
		$this->form_validation->set_rules('name', 'Category Name', 'required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');



		if (!$this->form_validation->run()) {

			// Note Categories.
			$note_categories = $this->mdl_note_categories_model->get_mdl_note_categories_with_no_parent();
			$a_note_category_form_options = array();

			$a_note_category_form_options[''] = '--- Select A Category ---';

			foreach ($note_categories as $note_category) {
				$a_note_category_form_options[$note_category['id']] = $note_category['name'];
			} // end of - foreach

			
			
			// Set the title for the page.
			$page_data['top_menu'] = 'Members Only';
			$page_data['dropdown_menu'] = 'Add A Note Category';
			$page_data['title'] = 'Add A Note Category';
			
			$data['title'] = 'Add A Note Category';
			$data['note_category_form_options'] = $a_note_category_form_options;

			$this->load->view('templates/top', $page_data);
			$this->load->view('templates/header', $page_data);
			$this->load->view('mdl_note_categories/form', $data);
			$this->load->view('templates/footer');

		} else {

			// Set default values.
			$parent_id = 0;
			$member_id = $this->session->userdata('member_id');
			$sort_order = 1;
			$display = 'yes';
			$featured = 'no';
			$status = 'active';
			$datetime = date('Y-m-d H:i:s', time());

			// Save data.
			$mdl_note_category = new mdl_note_categories_model();
			$mdl_note_category->parent_id = ($this->input->post('parent_id') != '' ? $this->input->post('parent_id') : $parent_id);
			$mdl_note_category->member_id = $member_id;
			$mdl_note_category->name = $this->input->post('name');
			//$mdl_note_category->sort_order = ($this->input->post('sort_order') != '' ? $this->input->post('sort_order') : $sort_order);
			$mdl_note_category->sort_order = $sort_order;
			$mdl_note_category->display = $display;
			$mdl_note_category->featured = $featured;
			$mdl_note_category->status = $status;
			$mdl_note_category->created_at = $datetime;
			$mdl_note_category->updated_at = $datetime;
			$mdl_note_category->save();
			
			
			// If the parent_id is 0, get the id of the insert and save it as the parent id.
			// if ($mdl_note_category->parent_id == 0) {
				// $mdl_note_category->parent_id = $this->db->insert_id();
// 				
				// $mdl_note_category->save();
			// }


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'Note Category \'' . html_escape($mdl_note_category->name) . '\' Created.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('mdl-note-categories', 'refresh');

		}

	} // end of - function add	



	/**
	 * Edit a record.
	 * @param int $id	 
	 */
    public function edit($id) {
        
        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();


		// Load helers/libraries/models.
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');	


		// Form Validation.
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('name', 'Category Name', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


		if (!$this->form_validation->run()) {


			// Load the record.
			$mdl_note_category = new mdl_note_categories_model();
			$mdl_note_category->load($id);
			if (!$mdl_note_category->id) {
				show_404();
			}


			// Recipe Categories.
			$note_categories = $this->mdl_note_categories_model->get_mdl_note_categories_with_no_parent();
			$a_note_category_form_options = array();

			$a_note_category_form_options[''] = '--- Select A Category ---';

			foreach ($note_categories as $note_category) {
				$a_note_category_form_options[$note_category['id']] = $note_category['name'];
			} // end of - foreach



			// Set the title for the page.
			$page_data['top_menu'] = 'Members Only';
			$page_data['dropdown_menu'] = 'Edit Note Category';
			$page_data['title'] = 'Edit Note Category';
			
			// Set content for the page.		
			$data['title'] = 'Edit Note Category';	
			$data['note_category'] = $mdl_note_category;
			$data['note_category_form_options'] = $a_note_category_form_options;

			$this->load->view('templates/top', $page_data);
	        $this->load->view('templates/header', $page_data);
	        $this->load->view('mdl_note_categories/form', $data);
	        $this->load->view('templates/footer');

		} else {

			// Set default values.
			$parent_id = 0;
			$datetime = date('Y-m-d H:i:s', time());


			// Load the record.
			$mdl_note_category = new mdl_note_categories_model();
			$mdl_note_category->load($id);
			if (!$mdl_note_category->id) {
				show_404();
			}


			// Save the data.
			$mdl_note_category->name = $this->input->post('name');
			$mdl_note_category->parent_id = ($this->input->post('parent_id') != '' ? $this->input->post('parent_id') : $parent_id);
			//$mdl_note_category->sort_order = ($this->input->post('sort_order') != '' ? $this->input->post('sort_order') : $mdl_note_category->sort_order);			
			//$mdl_note_category->display = $mdl_note_category->display;
			//$mdl_note_category->featured = $mdl_note_category->featured;
			//$mdl_note_category->status = $mdl_note_category->status;
			//$mdl_note_category->created_at = $mdl_note_category->created_at;
			$mdl_note_category->updated_at = $datetime;
			$mdl_note_category->save();


			// Set message data and redirect to display the magazine.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'Recipe Category \'' . html_escape($mdl_note_category->name) . '\' Updated.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('mdl-note-categories', 'refresh');

		}

    } // end of - function edit	    



	/**
	 * Delete a record.
	 * @param int $id
	 */
	public function delete($id) {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();
    	

		$mdl_note_category = new mdl_note_categories_model();
		$mdl_note_category->load($id);
		if (!$mdl_note_category->id) {
			//show_404();

			// Set message data and redirect to display the list of publications.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'Recipe Category Not Found.  No data was deleted.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('mdl_note_categories', 'refresh');			
		}


		// Need to delete all comments associated with this recipe.
		// $this->load->model('recipe_comments_model');
		// $this->recipe_comments_model->delete_recipe_comments($id);
		

		$mdl_note_category->delete($id);


		// Set message data and redirect to display the list of publications.
		$this->session->set_flashdata('message_class', 'alert-success');
		$this->session->set_flashdata('message', 'Recipe Category \'' . html_escape($mdl_note_category->name) . '\' was Deleted!!!');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		redirect('mdl-note-categories', 'refresh');				

	} // end of - function delete	

	
	
	
	// START OF - ADMIN functions
	
	
	/**
	 * List records.
	 */
	public function admin_list() {
		
        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();		
		
		// Create and return categories array.
		$a_mdl_note_categories = array();
		$a_mdl_note_categories = $this->mdl_note_categories_model->get_category_sub_category_object_array();

		// Get the data for the list.
		$data_for_list['mdl_note_categories'] = $a_mdl_note_categories;		
		
		// Create the list view code.
		//$mdl_note_categories_list = $this->load->view('mdl_note_categories/_panel_list', $data_for_list, true);	
		//$mdl_note_categories_list = $this->load->view('mdl_note_categories/_simple_list', $data_for_list, true);	
		$mdl_note_categories_list = $this->load->view('mdl_note_categories/_simple_list_2', $data_for_list, true);


		// Set the title for the page.
		$page_data['title'] = 'Note Categories';
		$data['title'] = 'Note Categories';	
		//$data['mdl_note_categories'] = $a_mdl_note_categories;
		$data['mdl_note_categories_list'] = $mdl_note_categories_list;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('mdl_note_categories/index', $data);
		$this->load->view('templates/footer');

	} // end of - function admin_list	
	
	
} // end of - class

/* End of file mdl_note_categories.php */
/* Location: ./application/controllers/mdl_note_categories.php */