<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Mdl_notes extends CI_Controller {


	public function __construct() {

		parent::__construct();
		
		$this->load->model('mdl_notes_model');
		
	} // end of - function __construct


	/**
	 * List records.
	 */
	public function index() {

		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in();

		// Load helers/libraries/models.
		$this->load->helper('date');

		$limit = 500;
		$a_mdl_notes = array();
		//$a_mdl_notes = $this->mdl_notes_model->get_mdl_notes($limit);
		$a_mdl_notes = $this->mdl_notes_model->get_mdl_notes_with_category_name($limit);


		// Get the data for the my mdl_notes list.
		$data_for_list['mdl_notes'] = $a_mdl_notes;

		// Create the my mdl_notes list view code.
		//$mdl_notes_view = $this->load->view('mdl_notes/_panel_list', $data_for_list, true);
		$mdl_notes_view = $this->load->view('mdl_notes/_simple_list', $data_for_list, true);	


		// Set the title for the page.
		$page_data['title'] = 'Notes';
		$data['title'] = 'Notes';	
		//$data['mdl_notes'] = $a_mdl_notes;
		$data['mdl_notes_view'] = $mdl_notes_view;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('mdl_notes/index', $data);
		$this->load->view('templates/footer');

	} // end of - function index



	/**
	 * View a record.
	 * @param int $id
	 */
	public function view($id) {

		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in();

		// Load helers/libraries/models.
		$this->load->helper('date');

		$note = new mdl_notes_model();
		$note->load($id);
		if (!$note->id) {
			show_404();
		}

		// Set the title for the page.
		$page_data['title'] = 'Note';
		// Set content for the page.
		$data['title'] = 'Note';
		$data['note'] = $note;	
		
		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('mdl_notes/view', $data);
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
		$this->form_validation->set_rules('note_title', 'Title', 'required');
		$this->form_validation->set_rules('note_content', 'Content', 'required');
		$this->form_validation->set_rules('category_id', 'Category ID', 'required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');	


		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Note Categories.
			$this->load->model('mdl_note_categories_model');

			$categories = $this->mdl_note_categories_model->get_category_sub_category_object_array();
			
			$last_category = '';
			$a_note_category_form_options = array();
			$a_note_category_form_options[''] = '--- Select A Category ---';
			
			foreach ($categories as $category) {
			     	
				$a_note_category_form_options[$category->id] = $category->category;
				
					if ($category->category != $last_category) {
						$a_note_category_form_options[$category->id] = $category->category;
					}			
					if ($category->sub_category != '') {
						$a_note_category_form_options[$category->id] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $category->sub_category;
					}
		
				// Save the last category displayed so that can only display sub categories.
				$last_category = $category->category;
		
			} // end of - foreach				
			


			// Set the title for the page.	
			$page_data['top_menu'] = 'Notes';
			$page_data['dropdown_menu'] = 'Add A Note';
			$page_data['title'] = 'Add A Note';
			$data['title'] = 'Add A Note';
			$data['note_category_form_options'] = $a_note_category_form_options;

			$this->load->view('templates/top', $page_data);
			$this->load->view('templates/header', $page_data);
			$this->load->view('templates/advertising');
			$this->load->view('mdl_notes/form', $data);
			$this->load->view('templates/footer');

		} else {

			// Set default values.
			$member_id = $this->session->userdata('member_id');
			$display = 'yes';
			$featured = 'no';
			$status = 'new';
			$datetime = date('Y-m-d H:i:s', time());

			// Save data.
			$note = new mdl_notes_model();
			$note->category_id = $this->input->post('category_id');
			$note->member_id = $member_id;
			$note->note_title = $this->input->post('note_title');
			$note->note_content = $this->input->post('note_content');
			$note->display = $display;
			$note->featured = $featured;
			$note->status = $status;
			$note->created_at = $datetime;
			$note->updated_at = $datetime;

			$note->save();


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'A Note titled \'' . html_escape($note->note_title) . '\' was successfully saved.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			// redirect('mdl-notes/view/' . $note->id, 'refresh');
			redirect('mdl-notes/by-category/' . $note->category_id, 'refresh');

		}

	} // end of - function add	



	/**
	 * Edit an item.
	 * @param int $id	 
	 */
    public function edit($id) {
        
		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in(); 		
		
		// Load helers/libraries/models.
		$this->load->helper('form');
		$this->load->library('form_validation');	


		// Form Validation.
		$this->form_validation->set_rules('note_title', 'Title', 'required');
		$this->form_validation->set_rules('note_content', 'Content', 'required');
		$this->form_validation->set_rules('category_id', 'Category ID', 'required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


		// Load the record.
		$note = new mdl_notes_model();
		$note->load($id);
		if (!$note->id) {
			show_404();
		}		


		// Note Categories.
		$this->load->model('mdl_note_categories_model');

		$categories = $this->mdl_note_categories_model->get_category_sub_category_object_array();
		
		$last_category = '';
		
		foreach ($categories as $category) {
		     	
			$a_note_category_form_options[$category->id] = $category->category;
			
				if ($category->category != $last_category) {
					$a_note_category_form_options[$category->id] = $category->category;
				}			
				if ($category->sub_category != '') {
					$a_note_category_form_options[$category->id] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $category->sub_category;
				}
	
			// Save the last category displayed so that can only display sub categories.
			$last_category = $category->category;
	
		} // end of - foreach			
			


		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Set the title for the page.
			$page_data['title'] = 'Edit Note';
			// Set content for the page.		
			$data['title'] = 'Edit Note';	
			$data['note'] = $note;
			$data['note_category_form_options'] = $a_note_category_form_options;

			$this->load->view('templates/top', $page_data);
	        $this->load->view('templates/header', $page_data);
	        $this->load->view('templates/advertising');
	        $this->load->view('mdl_notes/form', $data);
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
			// $note = new mdl_notes_model();
			// $note->load($this->input->post('id'));

			$note->category_id = $this->input->post('category_id');	
			$note->note_title = $this->input->post('note_title');
			$note->note_content = $this->input->post('note_content');
			//$note->featured = $note->featured;
			//$note->status = $note->status;
			//$note->created_at = $note->created_at;
			$note->updated_at = $datetime;

			$note->save();


			// Set message data and redirect to display the magazine.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'The Note titled \'' . html_escape($note->note_title) . '\' was successfull updated!!!');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			//redirect('mdl-notes/view/' . $id, 'refresh');
			redirect('mdl-notes/by-category/' . $note->category_id, 'refresh');

		}        

    } // end of - function edit	



	/**
	 * Delete a record.
	 * @param int $id
	 */
	public function delete($id) {
		
		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in();		
		
		$note = new mdl_notes_model();
		$note->load($id);
		if (!$note->id) {
			//show_404();

			// Set message data and redirect to display the list of publications.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'News Item Not Found.  No data was deleted.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('mdl_notes', 'refresh');			
		}
		

		$note->delete($id);


		// Set message data and redirect to display the list of publications.
		$this->session->set_flashdata('message_class', 'alert-success');
		$this->session->set_flashdata('message', 'Note titled \'' . html_escape($note->note_title) . '\' was Deleted!!!');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		//redirect('mdl-notes', 'refresh');
		redirect('mdl-notes/list-gbc', 'refresh');

	} // end of - function delete	



	/* START OF - custom functions */


	/**
	 * List records.
	 */
	public function my_mdl_notes() {

		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in();

		// Load helers/libraries/models.
		$this->load->helper('date');

		$a_mdl_notes = array();
		$a_mdl_notes = $this->mdl_notes_model->get_my_mdl_notes($this->session->userdata('member_id'));


		// Get the data for the my mdl_notes list.
		$data_for_list['mdl_notes'] = $a_mdl_notes;

		// Create the my mdl_notes list view code.
		$mdl_notes_view = $this->load->view('mdl_notes/_panel_list', $data_for_list, true);


		// Set the title for the page.
		$page_data['title'] = 'My Notes';
		$data['title'] = 'My Notes';	
		//$data['mdl_notes'] = $a_mdl_notes;
		$data['mdl_notes_view'] = $mdl_notes_view;


		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('mdl_notes/my_mdl_notes', $data);
		$this->load->view('templates/footer');

	} // end of - function my_mdl_notes	



	/**
	 * List records.
	 */
	public function notes_by_category($category_id = 0) {

		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in();

		// Load helers/libraries/models.
		$this->load->helper('date');
		$this->load->model('mdl_note_categories_model');
		
		// Get notes.
		$a_mdl_notes = array();
		if ($category_id != 0) {
			$a_mdl_notes = $this->mdl_notes_model->get_mdl_notes_for_category($category_id);	
		} else {
			$limit = 20;
			$a_mdl_notes = $this->mdl_notes_model->get_mdl_notes($limit);
		}
				
		
		// Get note categories.
		$a_note_categories = array();
		//$a_note_categories = $this->mdl_note_categories_model->get_mdl_note_categories();	
		//$a_note_categories = $this->mdl_note_categories_model->get_mdl_note_categories_with_number_of_records();	
		$a_note_categories = $this->mdl_note_categories_model->get_category_sub_category_object_array();
		

		// Get the category name.
		if (empty($a_mdl_notes)) {
			if ($category_id != 0) {
				$category_name = $this->mdl_note_categories_model->get_category_name($category_id);
			} else {
				$category_name = '';
			}
		} else {
			if ($category_id != 0) {	
				$category_name = $a_mdl_notes[0]['category_name'];
			} else {
				$category_name = '';
			}
		}
		
		
		
		// Get the category name.		
		if ($category_id != 0) {
			$a_category_name = $this->mdl_note_categories_model->get_category_name($category_id);
			if ($a_category_name->parent_name != '') {
				$category_name = $a_category_name->parent_name . '<span class="padding-right-10">:</span>' . $a_category_name->name;
				$category_name_for_title = $a_category_name->parent_name . ':  ' . $a_category_name->name;
				
				// Set the value for the page header.
				//$page_header = $a_category_name->parent_name . ':<br class="visible-sm" /><span class="padding-right-10"></span>' . $a_category_name->name;
				$page_header = $a_category_name->parent_name . ':<span class="padding-right-10"></span>' . $a_category_name->name;
			} else {
				$category_name = $a_category_name->name;
				$category_name_for_title = $a_category_name->name;
				
			// Set the value for the page header.
			$page_header = $a_category_name->name;
			}				
		} else {
			$category_name = '';
			$category_name_for_title = '';
			// Set the value for the page header.
			//$page_header = 'Notes <span class="extra-content">(20 Most Recent)</span>';
			$page_header = '<div class="clearfix"><div class="pull-left">Notes</div><div class="pull-right"><span class="extra-content-right">(20 Most Recent)</span></div></div>';
		}			
		
		


		// Get the data for the my notes list.
		$data_for_list['notes'] = $a_mdl_notes;

		// Create the my notes list view code.
		$notes_view = $this->load->view('mdl_notes/_list_group', $data_for_list, true);
		//$mdl_notes_view = $this->load->view('mdl_notes/_collapse_list', $data_for_list, true);
		//$mdl_notes_view = $this->load->view('mdl_notes/_simple_panel_list', $data_for_list, true);
		//$mdl_notes_view = $this->load->view('mdl_notes/_open_panel_list', $data_for_list, true);
		
		// Get the data for the my note categories menu.
		//$data_for_list['note_categories'] = $a_note_categories;
		$data_for_list['categories'] = $a_note_categories;

		// Create the my notes list view code.
		//$note_categories_view = $this->load->view('mdl_note_categories/_list_group_menu', $data_for_list, true);
		$note_categories_view = $this->load->view('mdl_note_categories/_list_group_menu_2', $data_for_list, true);		
		

		// Set the title for the page.		
		$page_data['top_menu'] = 'Notes';
		$page_data['dropdown_menu'] = 'Notes By Category';
		$page_data['title'] = 'Notes for:  ' . $category_name_for_title;
		//$data['title'] = "Category: " . $category_name;	
		//$data['title'] = $category_name . ' Notes';	
		$data['title'] = $page_header;
		//$data['mdl_notes'] = $a_mdl_notes;
		//$data['note_notes'] = $a_note_notes;
		$data['note_categories'] = $a_note_categories;
		$data['notes_view'] = $notes_view;
		$data['note_categories_view'] = $note_categories_view;


		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		//$this->load->view('mdl_notes/by_category', $data);
		$this->load->view('mdl_notes/by_category_with_category_menu', $data);
		$this->load->view('templates/footer');
		$this->load->view('more_js/category_collapse');

	} // end of - function mdl_notes_by_category





	/**
	 * List records.
	 */
	public function list_grouped_by_category() {

		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in();

		// Load helers/libraries/models.
		$this->load->helper('date');

		$limit = 500;
		$a_mdl_notes = array();
		//$a_mdl_notes = $this->mdl_notes_model->get_mdl_notes($limit);
		$a_mdl_notes = $this->mdl_notes_model->get_mdl_notes_with_category_name($limit);


		// Get the data for the my mdl_notes list.
		$data_for_list['mdl_notes'] = $a_mdl_notes;

		// Create the my mdl_notes list view code.
		$mdl_notes_view = $this->load->view('mdl_notes/_list_group_by_category', $data_for_list, true);	


		// Set the title for the page.
		$page_data['title'] = 'Notes';
		$data['title'] = 'Notes';	
		//$data['mdl_notes'] = $a_mdl_notes;
		$data['mdl_notes_view'] = $mdl_notes_view;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('mdl_notes/index', $data);
		$this->load->view('templates/footer');

	} // end of - function list_grouped_by_category





	/**
	 * Display details about this section of the website.
	 */
	public function about() {

		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();


		// Set the title for the page.
		$page_data['top_menu'] = 'Members Only';
		$page_data['dropdown_menu'] = 'About Notes';
		$page_data['title'] = 'About The Notes Section';
		
		// Set content for the page.
		$data['title'] = 'About The Notes Section';
		
		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('mdl_notes/about', $data);
		$this->load->view('templates/footer');

	} // end of - function about





	// ***********************************************************************************************
	// START OF - ADMIN SECTION
	// ***********************************************************************************************



	/**
	 * List records.
	 */
	public function admin_list() {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();

		// Load helers/libraries/models.
		$this->load->helper('date');

		$limit = 5;
		$a_mdl_notes = array();
		//$a_mdl_notes = $this->mdl_notes_model->get_mdl_notes($limit);
		$a_mdl_notes = $this->mdl_notes_model->get_mdl_notes_with_category_name($limit);


		// Get the data for the my notes list.
		$data_for_list['mdl_notes'] = $a_mdl_notes;

		// Create the my notes list view code.
		//$mdl_notes_view = $this->load->view('mdl_notes/_panel_list', $data_for_list, true);
		$mdl_notes_view = $this->load->view('mdl_notes/_simple_list', $data_for_list, true);	


		// Set the title for the page.
		$page_data['title'] = 'Notes';
		$data['title'] = 'Notes';	
		//$data['mdl_notes'] = $a_mdl_notes;
		$data['mdl_notes_view'] = $mdl_notes_view;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('mdl_notes/index', $data);
		$this->load->view('templates/footer');

	} // end of - function admin_list


} // end of - class

/* End of file mdl_notes.php */
/* Location: ./application/controllers/mdl_notes.php */