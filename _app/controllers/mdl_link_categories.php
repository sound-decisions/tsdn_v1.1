<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Mdl_link_categories extends CI_Controller {


	public function __construct() {

		parent::__construct();
		
		$this->load->model('mdl_link_categories_model');
		
	} // end of - function __construct



	/**
	 * List records.
	 */
	public function index() {	
				
		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in();				
				
		// Create and return categories array.
		$a_mdl_link_categories = array();
		$a_mdl_link_categories = $this->mdl_link_categories_model->get_category_sub_category_object_array();
	

		// Get the data for the list.
		$data_for_list['mdl_link_categories'] = $a_mdl_link_categories;
		
				
		// Create the list view code.
		$mdl_link_categories_list = $this->load->view('mdl_link_categories/_list_group', $data_for_list, true);	
		//$mdl_link_categories_list = $this->load->view('mdl_link_categories/_simple_list_2', $data_for_list, true);	


		// Set the title for the page.
		$page_data['title'] = 'Link Categories';
		$data['title'] = 'Link Categories';	
		//$data['mdl_link_categories'] = $a_mdl_link_categories;
		$data['mdl_link_categories_list'] = $mdl_link_categories_list;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('mdl_link_categories/index', $data);
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

		$mdl_link_category = new mdl_link_categories_model();
		$mdl_link_category->load($id);
		if (!$mdl_link_category->id) {
			show_404();
		}


		// Get links in the selected category.
		//$a_mdl_links = array();
		$this->load->model('mdl_links_model');
		$a_mdl_links = $this->mdl_links_model->get_mdl_links_for_category($id);


		// Set the title for the page.
		$page_data['title'] = 'Link Category';
		// Set content for the page.
		$data['title'] = 'Link Category';
		$data['link_category'] = $mdl_link_category;
		$data['links'] = $a_mdl_links;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('mdl_link_categories/view', $data);
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
			
			// Get link categories.
			$a_link_categories = array();
			$a_link_categories = $this->mdl_link_categories_model->get_category_sub_category_object_array();			
			
			// Get the data for the my link categories menu.
			$data_for_list['categories'] = $a_link_categories;
	
			// Create the my links list view code.
			$link_categories_view = $this->load->view('mdl_link_categories/_list_group_menu_2', $data_for_list, true);			
			
			
			// Get Categories.
			$link_categories = $this->mdl_link_categories_model->get_mdl_link_categories_with_no_parent();
			$a_link_category_form_options = array();

			$a_link_category_form_options[''] = '--- Select A Category ---';

			foreach ($link_categories as $link_category) {
				$a_link_category_form_options[$link_category['id']] = $link_category['name'];
			} // end of - foreach

			// Set the title for the page.
			$page_data['top_menu'] = 'Links';
			$page_data['dropdown_menu'] = 'Add A Link Category';
			$page_data['title'] = 'Add A Link Category';
			$data['title'] = 'Add A Link Category';
			$data['link_categories_view'] = $link_categories_view;
			$data['link_category_form_options'] = $a_link_category_form_options;

			$this->load->view('templates/top', $page_data);
			$this->load->view('templates/header', $page_data);
			$this->load->view('mdl_link_categories/form', $data);
			$this->load->view('templates/footer');
			$this->load->view('more_js/category_collapse');

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
			$mdl_link_category = new mdl_link_categories_model();
			$mdl_link_category->parent_id = ($this->input->post('parent_id') != '' ? $this->input->post('parent_id') : $parent_id);
			$mdl_link_category->member_id = $member_id;
			$mdl_link_category->name = $this->input->post('name');
			//$mdl_link_category->sort_order = ($this->input->post('sort_order') != '' ? $this->input->post('sort_order') : $sort_order);
			$mdl_link_category->sort_order = $sort_order;
			$mdl_link_category->display = $display;
			$mdl_link_category->featured = $featured;
			$mdl_link_category->status = $status;
			$mdl_link_category->created_at = $datetime;
			$mdl_link_category->updated_at = $datetime;
			$mdl_link_category->save();


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'Link Category \'' . html_escape($mdl_link_category->name) . '\' Created.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('mdl-link-categories', 'refresh');			

		}

	} // end of - function add	



	/**
	 * Edit a record.
	 * @param int $id	 
	 */
    public function edit($id) {
        
		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in();


		// Load helers/libraries/models.
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');	


		// Form Validation.
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('name', 'Category Name', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


		if (!$this->form_validation->run()) {

			// Get link categories.
			$a_link_categories = array();
			$a_link_categories = $this->mdl_link_categories_model->get_category_sub_category_object_array();			
			
			// Get the data for the my link categories menu.
			$data_for_list['categories'] = $a_link_categories;
	
			// Create the my links list view code.
			$link_categories_view = $this->load->view('mdl_link_categories/_list_group_menu_2', $data_for_list, true);	
			

			// Load the record.
			$mdl_link_category = new mdl_link_categories_model();
			$mdl_link_category->load($id);
			if (!$mdl_link_category->id) {
				show_404();
			}


			// Recipe Categories.
			$link_categories = $this->mdl_link_categories_model->get_mdl_link_categories_with_no_parent();
			$a_link_category_form_options = array();

			$a_link_category_form_options[''] = '--- Select A Category ---';

			foreach ($link_categories as $link_category) {
				$a_link_category_form_options[$link_category['id']] = $link_category['name'];
			} // end of - foreach



			// Set the title for the page.
			$page_data['title'] = 'Edit Link Category';
			// Set content for the page.		
			$data['title'] = 'Edit Link Category';	
			$data['link_category'] = $mdl_link_category;
			$data['link_categories_view'] = $link_categories_view;
			$data['link_category_form_options'] = $a_link_category_form_options;

			$this->load->view('templates/top', $page_data);
	        $this->load->view('templates/header', $page_data);
	        $this->load->view('mdl_link_categories/form', $data);
	        $this->load->view('templates/footer');
			$this->load->view('more_js/category_collapse');

		} else {

			// Set default values.
			$parent_id = 0;
			$datetime = date('Y-m-d H:i:s', time());


			// Load the record.
			$mdl_link_category = new mdl_link_categories_model();
			$mdl_link_category->load($id);
			if (!$mdl_link_category->id) {
				show_404();
			}


			// Save the data.
			$mdl_link_category->name = $this->input->post('name');
			$mdl_link_category->parent_id = ($this->input->post('parent_id') != '' ? $this->input->post('parent_id') : $parent_id);
			//$mdl_link_category->sort_order = ($this->input->post('sort_order') != '' ? $this->input->post('sort_order') : $mdl_link_category->sort_order);						
			//$mdl_link_category->display = $mdl_link_category->display;
			//$mdl_link_category->featured = $mdl_link_category->featured;
			//$mdl_link_category->status = $mdl_link_category->status;
			//$mdl_link_category->created_at = $mdl_link_category->created_at;
			$mdl_link_category->updated_at = $datetime;
			$mdl_link_category->save();


			// Set message data and redirect to display the magazine.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'Recipe Category \'' . html_escape($mdl_link_category->name) . '\' Updated.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('mdl-link-categories', 'refresh');

		}

    } // end of - function edit	    



	/**
	 * Delete a record.
	 * @param int $id
	 */
	public function delete($id) {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();
    	

		$mdl_link_category = new mdl_link_categories_model();
		$mdl_link_category->load($id);
		if (!$mdl_link_category->id) {
			//show_404();

			// Set message data and redirect to display the list of publications.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'Recipe Category Not Found.  No data was deleted.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('mdl_link_categories', 'refresh');
		}


		// Need to delete all links associated with this category.
		$this->load->model('mdl_links_model');
		$mdl_link = new mdl_links_model();
		$mdl_link->delete_by_category($id);
		
		
		// Delete the category.
		$mdl_link_category->delete($id);


		// Set message data and redirect to display the list of publications.
		$this->session->set_flashdata('message_class', 'alert-success');
		$this->session->set_flashdata('message', 'Recipe Category \'' . html_escape($mdl_link_category->name) . '\' was Deleted!!!');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		redirect('mdl-link-categories', 'refresh');

	} // end of - function delete	

	
	
	
	// START OF - admin functions
	
	
	
	/**
	 * List records.
	 */
	public function admin_list() {	
				
        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();				
				
		// Create and return categories array.
		$a_mdl_link_categories = array();
		$a_mdl_link_categories = $this->mdl_link_categories_model->get_category_sub_category_object_array();
	

		// Get the data for the list.
		$data_for_list['mdl_link_categories'] = $a_mdl_link_categories;
		
				
		// Create the list view code.
		$mdl_link_categories_list = $this->load->view('mdl_link_categories/_admin_list', $data_for_list, true);	


		// Set the title for the page.
		$page_data['top_menu'] = 'Admin Menu';
		$page_data['dropdown_menu'] = 'Admin Link Categories';
		$page_data['title'] = 'Link Categories';
		$data['title'] = 'Link Categories';	
		//$data['mdl_link_categories'] = $a_mdl_link_categories;
		$data['mdl_link_categories_list'] = $mdl_link_categories_list;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('mdl_link_categories/admin-list', $data);
		$this->load->view('templates/footer');

	} // end of - function admin_list	
	
	
		
	
	
} // end of - class

/* End of file mdl_link_categories.php */
/* Location: ./application/controllers/mdl_link_categories.php */