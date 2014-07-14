<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Mdl_links extends CI_Controller {


	public function __construct() {

		parent::__construct();
		
		$this->load->model('mdl_links_model');
		
	} // end of - function __construct


	/**
	 * List records.
	 */
	public function index() {

		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();

		// Load helers/libraries/models.
		$this->load->helper('date');

		$limit = 500;
		$a_mdl_links = array();
		//$a_mdl_links = $this->mdl_links_model->get_mdl_links($limit);
		$a_mdl_links = $this->mdl_links_model->get_mdl_links_with_category_name($limit);


		// Get the data for the my mdl_links list.
		$data_for_list['mdl_links'] = $a_mdl_links;

		// Create the my mdl_links list view code.
		//$mdl_links_view = $this->load->view('mdl_links/_panel_list', $data_for_list, true);
		$mdl_links_view = $this->load->view('mdl_links/_simple_list', $data_for_list, true);	


		// Set the title for the page.
		$page_data['top_menu'] = 'Admin Menu';
		$page_data['dropdown_menu'] = 'Link List';
		$page_data['title'] = 'Links';
		
		$data['title'] = 'Links';	
		//$data['mdl_links'] = $a_mdl_links;
		$data['mdl_links_view'] = $mdl_links_view;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('mdl_links/index', $data);
		$this->load->view('templates/footer');

	} // end of - function index



	/**
	 * View a record.
	 * @param int $id
	 */
	public function view($id) {

		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();

		// Load helers/libraries/models.
		$this->load->helper('security');
		$this->load->helper('date');

		$link = new mdl_links_model();
		$link->load($id);
		if (!$link->id) {
			show_404();
		}

		// Set the title for the page.
		$page_data['top_menu'] = 'Links';
		//$page_data['dropdown_menu'] = 'Links';
		$page_data['title'] = 'Link';
		
		// Set content for the page.
		$data['title'] = 'Link';
		$data['link'] = $link;
		$data['password'] = decryptIt($link->encrypted_password);
		
		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('mdl_links/view', $data);
		$this->load->view('templates/footer');
		$this->load->view('more_js/mdl_links');

	} // end of - function view



	/**
	 * Add a record.
	 */
	public function add() {

		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();
        

		// START OF - Check for SPAM.
		// $this->load->helper('spam_check');
		// $loadtime = $this->input->post('loadtime');
		// spam_check($loadtime);
	    // END OF - Check for SPAM.


		// Load helers/libraries/models.
		$this->load->helper('security');
		$this->load->helper('form');
		$this->load->library('form_validation');


		// Form Validation.		
		$this->form_validation->set_rules('url', 'URL', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('category_id', 'Category ID', 'required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');	


		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Link Categories.
			$this->load->model('mdl_link_categories_model');

			$categories = $this->mdl_link_categories_model->get_category_sub_category_object_array();
			
			$last_category = '';
			$a_link_category_form_options = array();
			$a_link_category_form_options[''] = '--- Select A Category ---';
			
			foreach ($categories as $category) {
			     	
				$a_link_category_form_options[$category->id] = $category->category;
				
					if ($category->category != $last_category) {
						$a_link_category_form_options[$category->id] = $category->category;
					}			
					if ($category->sub_category != '') {
						$a_link_category_form_options[$category->id] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $category->sub_category;
					}
		
				// Save the last category displayed so that can only display sub categories.
				$last_category = $category->category;
		
			} // end of - foreach			
			
			

			// Set the title for the page.	
			$page_data['top_menu'] = 'Links';
			$page_data['dropdown_menu'] = 'Add A Link';
			$page_data['title'] = 'Add A Link';
			$data['title'] = 'Add A Link';
			$data['link_category_form_options'] = $a_link_category_form_options;

			$this->load->view('templates/top', $page_data);
			$this->load->view('templates/header', $page_data);
			$this->load->view('templates/advertising');
			$this->load->view('mdl_links/form', $data);
			$this->load->view('templates/footer');

		} else {

			// Set default values.
			$member_id = $this->session->userdata('member_id');
			$visit_count = 0;
			$favorite = 'no';
			$display = 'yes';
			$featured = 'no';
			$status = 'new';
			$datetime = date('Y-m-d H:i:s', time());
			
			// Make sure that the url starts with http:// or https://'
			$link_url = $this->input->post('url');
			
			if ((substr($link_url, 0, 7) != "http://") && (substr($link_url, 0, 8) != "https://")) {
			   $link_url = "http://" . $link_url;
			}		
			
			// Encrypt the password.
			$encrypted_password = encryptIt($this->input->post('password'));				
			
			// Save data.
			$link = new mdl_links_model();
			$link->category_id = $this->input->post('category_id');
			$link->member_id = $member_id;
			$link->url = $link_url;
			$link->name = $this->input->post('name');
			$link->description = $this->input->post('description');
			$link->username = $this->input->post('username');
            $link->email = $this->input->post('email');
			$link->encrypted_password = $encrypted_password;
			$link->visit_count = $visit_count;
			$link->favorite = $favorite;
			$link->display = $display;
			$link->featured = $featured;
			$link->status = $status;
			$link->created_at = $datetime;
			$link->updated_at = $datetime;

			$link->save();


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'A Link named \'' . html_escape($link->name) . '\' was successfully saved.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			//redirect('mdl-links/view/' . $link->id, 'refresh');
			redirect('mdl-links/by-category/' . $link->category_id, 'refresh');

		}

	} // end of - function add	



	/**
	 * Edit an item.
	 * @param int $id	 
	 */
    public function edit($id) {
        
		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in(); 		
		
		// Load helers/libraries/models.
		$this->load->helper('security');
		$this->load->helper('form');
		$this->load->library('form_validation');


		// Form Validation.
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('category_id', 'Category ID', 'required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');	


		// Load the record.
		$link = new mdl_links_model();
		$link->load($id);
		if (!$link->id) {
			show_404();
		}		


		// Link Categories.
		$this->load->model('mdl_link_categories_model');

		$categories = $this->mdl_link_categories_model->get_category_sub_category_object_array();
		
		$last_category = '';
		
		foreach ($categories as $category) {
		     	
			$a_link_category_form_options[$category->id] = $category->category;
			
				if ($category->category != $last_category) {
					$a_link_category_form_options[$category->id] = $category->category;
				}			
				if ($category->sub_category != '') {
					$a_link_category_form_options[$category->id] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $category->sub_category;
				}
	
			// Save the last category displayed so that can only display sub categories.
			$last_category = $category->category;
	
		} // end of - foreach				


		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Set the title for the page.
			$page_data['title'] = 'Edit Link';
			// Set content for the page.		
			$data['title'] = 'Edit Link';
			$data['link'] = $link;
			$data['link_category_form_options'] = $a_link_category_form_options;
			if ($link->encrypted_password != '') {
				$data['password'] = decryptIt($link->encrypted_password);
			} else {
				$data['password'] = '';
			}			

			$this->load->view('templates/top', $page_data);
	        $this->load->view('templates/header', $page_data);
	        $this->load->view('templates/advertising');
	        $this->load->view('mdl_links/form', $data);
	        $this->load->view('templates/footer');

		} else {

			// START OF - Check for SPAM.
			// $this->load->helper('spam_check');
			// $loadtime = $this->input->post('loadtime');
			// spam_check($loadtime);
		    // END OF - Check for SPAM.

			// Set default values.
			$datetime = date('Y-m-d H:i:s', time());
			
			// Make sure that the url starts with http:// or https://'
			$link_url = $this->input->post('url');
			
			if ((substr($link_url, 0, 7) != "http://") && (substr($link_url, 0, 8) != "https://")) {
			   $link_url = "http://" . $link_url;
			}			
			
			// Encrypt the password.
			$encrypted_password = encryptIt($this->input->post('password'));

			// Save the data.
			// $link = new mdl_links_model();
			// $link->load($this->input->post('id'));

			$link->category_id = $this->input->post('category_id');	
			$link->url = $link_url;
			$link->name = $this->input->post('name');
			$link->description = $this->input->post('description');
			$link->username = $this->input->post('username');
            $link->email = $this->input->post('email');
			$link->encrypted_password = $encrypted_password;
			//$link->display = $link->display;
			//$link->featured = $link->featured;
			//$link->status = $link->status;
			//$link->created_at = $link->created_at;
			$link->updated_at = $datetime;

			$link->save();


			// Set message data and redirect to display the magazine.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'The Link named \'' . html_escape($link->name) . '\' was successfull updated!!!');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			//redirect('mdl-links/view/' . $id, 'refresh');
			redirect('mdl-links/by-category/' . $link->category_id, 'refresh');

		}        

    } // end of - function edit	



	/**
	 * Delete a record.
	 * @param int $id
	 */
	public function delete($id) {
		
		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();		
		
		$link = new mdl_links_model();
		$link->load($id);
		if (!$link->id) {
			//show_404();

			// Set message data and redirect to display the list of publications.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'Link Not Found.  No data was deleted.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('mdl_links', 'refresh');
		}
		

		$link->delete($id);


		// Set message data and redirect to display the list of publications.
		$this->session->set_flashdata('message_class', 'alert-success');
		$this->session->set_flashdata('message', 'Link \'' . html_escape($link->name) . '\' was Deleted!!!');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		//redirect('mdl-links', 'refresh');
		redirect('mdl-links/list-gbc', 'refresh');

	} // end of - function delete	





	/* START OF - custom functions */


	/**
	 * List records.
	 */
	public function my_mdl_links() {

		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();

		// Load helers/libraries/models.
		$this->load->helper('date');

		$a_mdl_links = array();
		$a_mdl_links = $this->mdl_links_model->get_my_mdl_links($this->session->userdata('member_id'));


		// Get the data for the my mdl_links list.
		$data_for_list['mdl_links'] = $a_mdl_links;

		// Create the my mdl_links list view code.
		$mdl_links_view = $this->load->view('mdl_links/_panel_list', $data_for_list, true);


		// Set the title for the page.
		$page_data['title'] = 'My Links';
		$data['title'] = 'My Links';	
		//$data['mdl_links'] = $a_mdl_links;
		$data['mdl_links_view'] = $mdl_links_view;


		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('mdl_links/my_mdl_links', $data);
		$this->load->view('templates/footer');

	} // end of - function my_mdl_links	



	/**
	 * List records.
	 */
	public function links_by_category($category_id = 0) {

		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();

		// Load helers/libraries/models.
		$this->load->helper('date');
		$this->load->model('mdl_link_categories_model');
		
		// Get links.
		$a_mdl_links = array();
		if ($category_id != 0) {
			$a_mdl_links = $this->mdl_links_model->get_mdl_links_for_category($category_id);
		} else {
			$limit = 20;
			$a_mdl_links = $this->mdl_links_model->get_mdl_links($limit);
		}
				
		
		// Get link categories.
		$a_link_categories = array();
		//$a_link_categories = $this->mdl_link_categories_model->get_mdl_link_categories();	
		//$a_link_categories = $this->mdl_link_categories_model->get_mdl_link_categories_with_number_of_records();	
		$a_link_categories = $this->mdl_link_categories_model->get_category_sub_category_object_array();
		

		// Get the category name.		
		if ($category_id != 0) {
			$a_category_name = $this->mdl_link_categories_model->get_category_name($category_id);
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
			//$page_header = 'Links <span class="extra-content">(20 Most Recent)</span>';
			$page_header = '<div class="clearfix"><div class="pull-left">Links</div><div class="pull-right"><span class="extra-content-right">(20 Most Recent)</span></div></div>';
		}		


		// Get the data for the my links list.
		$data_for_list['links'] = $a_mdl_links;

		// Create the my links list view code.
		$links_view = $this->load->view('mdl_links/_list_group', $data_for_list, true);
		//$mdl_links_view = $this->load->view('mdl_links/_collapse_list', $data_for_list, true);
		//$mdl_links_view = $this->load->view('mdl_links/_simple_panel_list', $data_for_list, true);
		//$mdl_links_view = $this->load->view('mdl_links/_open_panel_list', $data_for_list, true);
		
		// Get the data for the my link categories menu.
		//$data_for_list['link_categories'] = $a_link_categories;
		$data_for_list['categories'] = $a_link_categories;

		// Create the my links list view code.
		//$link_categories_view = $this->load->view('mdl_link_categories/_list_group_menu', $data_for_list, true);
		$link_categories_view = $this->load->view('mdl_link_categories/_list_group_menu_2', $data_for_list, true);
		

		// Set the title for the page.
		$page_data['top_menu'] = 'Links';
		$page_data['dropdown_menu'] = "Links By Category";
		$page_data['title'] = $category_name_for_title . ' Links';
		
		//$data['title'] = "Category: " . $category_name;	
		//$data['title'] = $category_name . ' Links';
		$data['title'] = $page_header;	
		//$data['mdl_links'] = $a_mdl_links;
		//$data['link_notes'] = $a_link_notes;
		$data['link_categories'] = $a_link_categories;
		$data['links_view'] = $links_view;
		$data['link_categories_view'] = $link_categories_view;


		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		//$this->load->view('mdl_links/by_category', $data);
		$this->load->view('mdl_links/by_category_with_category_menu', $data);
		$this->load->view('templates/footer');
		$this->load->view('more_js/category_collapse');
		$this->load->view('more_js/mdl_links');

	} // end of - function mdl_links_by_category





	/**
	 * List records.
	 */
	public function list_grouped_by_category() {

		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();

		// Load helers/libraries/models.
		$this->load->helper('date');

		$limit = 500;
		$a_mdl_links = array();
		//$a_mdl_links = $this->mdl_links_model->get_mdl_links($limit);
		$a_mdl_links = $this->mdl_links_model->get_mdl_links_with_category_name($limit);


		// Get the data for the my mdl_links list.
		$data_for_list['mdl_links'] = $a_mdl_links;

		// Create the my mdl_links list view code.
		$mdl_links_view = $this->load->view('mdl_links/_list_group_by_category', $data_for_list, true);	


		// Set the title for the page.
		$page_data['top_menu'] = 'Links';
		$page_data['dropdown_menu'] = "Grouped By Category";
		$page_data['title'] = 'Links';
		
		$data['title'] = 'Links';	
		//$data['mdl_links'] = $a_mdl_links;
		$data['mdl_links_view'] = $mdl_links_view;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('mdl_links/index', $data);
		$this->load->view('templates/footer');

	} // end of - function list_grouped_by_category





	/**
	 * List records.
	 */
	public function links_most_visited() {

		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();

		// Load helers/libraries/models.
		$this->load->helper('date');

		$limit = 50;
		$a_mdl_links = array();
		//$a_mdl_links = $this->mdl_links_model->get_mdl_links($limit);
		$a_mdl_links = $this->mdl_links_model->get_mdl_links_most_visited($limit);
		
		// Get the data for the my links list.
		$data_for_list['links'] = $a_mdl_links;

		// Create the my links list view code.
		$links_view = $this->load->view('mdl_links/_list_group', $data_for_list, true);		


		// Set the title for the page.
		$page_data['top_menu'] = 'Links';
		$page_data['dropdown_menu'] = "Links Most Visited";
		$page_data['title'] = 'Most Visited Links';
		
		$data['title'] = 'Links Most Visited';	
		//$data['mdl_links'] = $a_mdl_links;
		$data['mdl_links_view'] = $links_view;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('mdl_links/index', $data);
		$this->load->view('templates/footer');
		$this->load->view('more_js/mdl_links');

	} // end of - function links_most_visited



	/**
	 * Update the value of the value of the visit_count by increasing it by one, 
	 * update the last_visited_at value with the current date and time..
	 * @param int $id
	 */
	public function update_visit_count($id) {
		
		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();
		
		$link = new mdl_links_model();
		$link->load($id);
		if (!$link->id) {

			// Link not found.

			return 0;
		}
		
		
		// Set default values.
		$datetime = date('Y-m-d H:i:s', time());
		
		$link->visit_count = $link->visit_count + 1;
		$link->last_visited_at = $datetime;

		$link->save();
		
		return $link->visit_count;

	} // end of - function update_visit_count	





	/**
	 * Display details about this section of the website.
	 */
	public function about() {

		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();


		// Set the title for the page.
		$page_data['top_menu'] = 'Members Only';
		$page_data['dropdown_menu'] = 'About Links';
		$page_data['title'] = 'About The Links Section';
		
		// Set content for the page.
		$data['title'] = 'About The Links Section';
		
		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('mdl_links/about', $data);
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
		$a_mdl_links = array();
		//$a_mdl_links = $this->mdl_links_model->get_mdl_links($limit);
		$a_mdl_links = $this->mdl_links_model->get_mdl_links_with_category_name($limit);


		// Get the data for the my links list.
		$data_for_list['mdl_links'] = $a_mdl_links;

		// Create the my links list view code.
		//$mdl_links_view = $this->load->view('mdl_links/_panel_list', $data_for_list, true);
		$mdl_links_view = $this->load->view('mdl_links/_simple_list', $data_for_list, true);	


		// Set the title for the page.
		$page_data['title'] = 'Links';
		$data['title'] = 'Links';	
		//$data['mdl_links'] = $a_mdl_links;
		$data['mdl_links_view'] = $mdl_links_view;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('mdl_links/index', $data);
		$this->load->view('templates/footer');

	} // end of - function admin_list


} // end of - class

/* End of file mdl_links.php */
/* Location: ./application/controllers/mdl_links.php */