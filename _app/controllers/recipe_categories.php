<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Recipe_categories extends CI_Controller {


	public function __construct() {

		parent::__construct();
		
		$this->load->model('recipe_categories_model');
		
	} // end of - function __construct


	/**
	 * List records.
	 */
	public function index() {

		// Load helers/libraries/models.
		$this->load->helper('date');

		$a_recipe_categories = array();
		$a_recipe_categories = $this->recipe_categories_model->get_recipe_categories();

		// Get the data for the list.
		$data_for_list['recipe_categories'] = $a_recipe_categories;		
		
		// Create the list view code.
		//$recipe_categories_list = $this->load->view('recipe_categories/_panel_list', $data_for_list, true);	
		$recipe_categories_list = $this->load->view('recipe_categories/_simple_list', $data_for_list, true);	


		// Set the title for the page.
		$page_data['top_menu'] = 'Admin Menu';
		$page_data['dropdown_menu'] = "Recipe Categories";
		$page_data['title'] = 'Recipe Categories';
		
		$data['title'] = 'Recipe Categories';	
		//$data['recipe_categories'] = $a_recipe_categories;
		$data['recipe_categories_list'] = $recipe_categories_list;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('recipe_categories/index', $data);
		$this->load->view('templates/footer');

	} // end of - function index



	/**
	 * View a record.
	 * @param int $id
	 */
	public function view($id) {

		// Load helers/libraries/models.
		$this->load->helper('date');

		$recipe_category = new recipe_categories_model();
		$recipe_category->load($id);
		if (!$recipe_category->id) {
			show_404();
		}

		// Set the title for the page.
		$page_data['title'] = 'Recipe Category';
		// Set content for the page.
		$data['title'] = 'Recipe Category';			
		$data['recipe_category'] = $recipe_category;	

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('recipe_categories/view', $data);
		$this->load->view('templates/footer');			

	} // end of - function view



	/**
	 * Add a record.
	 */
	public function add() {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();


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
		$this->form_validation->set_rules('name', 'Category Name', 'required');
		//$this->form_validation->set_rules('sort_order', 'Sort Order', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');



		// Image Upload Validation.
		$check_file_upload = FALSE;
		if (isset($_FILES['photo']['error']) && $_FILES['photo']['error'] != 4) {
			$check_file_upload = TRUE;

			// Make sure the image name being uploaded will be unique.
			$current_file_name = $_FILES['photo']['name'];

			// If the file name has any spaces in it an error will occur so check it before continuing.
			if (strpos($current_file_name, ' ')) {

				// Set message data and redirect to display the new item.
				$this->session->set_flashdata('message_class', 'alert-danger');
				$this->session->set_flashdata('message', 'The image file selected has at least one space in the file name.  Please remove or replace the spaces and try again.');

				// Redirect instead of loading views to prevent a refresh from running the code again.
				redirect('recipe_categories/edit/' . $id, 'refresh');	

			}


			$new_file_name = time() . '_' . $current_file_name;
			$tn_file_name = time() . '_tn_' . $current_file_name;

			// For Image Uploads.
			$config = array ( 
				'upload_path' => RECIPE_CATEGORY_PHOTOS_PATH, 
				'allowed_types' => 'gif|jpg|png', 
				'file_name' => $new_file_name, 
				'max_size' => 2048, 
				'max_width' => 1600, 
				'max_height' => 1600,
			);

			$this->upload->initialize($config);
		}




		// if ($this->form_validation->run() === FALSE) {
		//if (!$this->form_validation->run()) {
		if (!$this->form_validation->run() || ($check_file_upload && !$this->upload->do_upload('photo'))) {

			$a_recipe_categories = array();

			// Set the title for the page.
			$page_data['top_menu'] = 'Admin Menu';
			$page_data['dropdown_menu'] = "Add A Recipe Category";
			$page_data['title'] = 'Add A Recipe Category';
								
			$data['title'] = 'Add A Recipe Category';
			$data['recipe_category'] = $a_recipe_categories;

			$this->load->view('templates/top', $page_data);
			$this->load->view('templates/header', $page_data);
			$this->load->view('recipe_categories/form', $data);
			$this->load->view('templates/footer');

		} else {

			// Set default values.
			$sort_order = 1;
			$display = 'yes';
			$featured = 'no';
			$status = 'active';
			$datetime = date('Y-m-d H:i:s', time());

			// Save data.
			$recipe_category = new recipe_categories_model();
			$recipe_category->name = $this->input->post('name');
			$recipe_category->description = $this->input->post('description');
			//$recipe_category->sort_order = $this->input->post('sort_order');
			$recipe_category->sort_order = ($this->input->post('sort_order') != '' ? $this->input->post('sort_order') : $sort_order);
			
			$recipe_category->display = $display;
			$recipe_category->featured = $featured;
			$recipe_category->status = $status;
			$recipe_category->created_at = $datetime;
			$recipe_category->updated_at = $datetime;
			
			
			
			// Deal with the Uploaded Image.
			$current_photo = $this->input->post('current_photo');
			$current_photo_tn = $this->input->post('current_photo_tn');				
			
			
			if ($check_file_upload) {
				$upload_data = $this->upload->data();
				if (isset($upload_data['file_name'])) {
					$recipe_category->photo = $upload_data['file_name'];
					$recipe_category->photo_tn = $tn_file_name;

					// Create a thumbnail of the uploaded image.
					$this->load->library('Imagetransform');

					$main_file = RECIPE_CATEGORY_PHOTOS_PATH . $new_file_name;
					$tn_file = RECIPE_CATEGORY_PHOTOS_PATH . $tn_file_name;

					//$this->imagetransform->resize($main_file, 500, 500, $main_file);
					$this->imagetransform->crop($main_file, 500, 500);
					$this->imagetransform->crop($main_file, 100, 100, $tn_file);

					// Delete the replaced image files if they exist.
					if (($current_photo != '') && (file_exists(RECIPE_CATEGORY_PHOTOS_PATH . $current_photo))) {
						unlink(RECIPE_CATEGORY_PHOTOS_PATH . $current_photo);
					}
					//if ($current_profile_photo_tn != '') {
					if (($current_photo_tn != '') && (file_exists(RECIPE_CATEGORY_PHOTOS_PATH . $current_photo_tn))) {
						unlink(RECIPE_CATEGORY_PHOTOS_PATH . $current_photo_tn);
					}					
					
				}
			} else {
				// $member->profile_photo = $current_profile_photo;
				// $member->profile_photo_tn = $current_profile_photo_tn;
			}
			
			
			
			$recipe_category->save();


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'Recipe Category \'' . html_escape($recipe_category->name) . '\' Created.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('recipe_categories', 'refresh');			

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


		// Image Upload Validation.
		$check_file_upload = FALSE;
		if (isset($_FILES['photo']['error']) && $_FILES['photo']['error'] != 4) {
			$check_file_upload = TRUE;

			// Make sure the image name being uploaded will be unique.
			$current_file_name = $_FILES['photo']['name'];

			// If the file name has any spaces in it an error will occur so check it before continuing.
			if (strpos($current_file_name, ' ')) {

				// Set message data and redirect to display the new item.
				$this->session->set_flashdata('message_class', 'alert-danger');
				$this->session->set_flashdata('message', 'The image file selected has at least one space in the file name.  Please remove or replace the spaces and try again.');

				// Redirect instead of loading views to prevent a refresh from running the code again.
				redirect('recipe_categories/edit/' . $id, 'refresh');	

			}


			$new_file_name = time() . '_' . $current_file_name;
			$tn_file_name = time() . '_tn_' . $current_file_name;

			// For Image Uploads.
			$config = array ( 
				'upload_path' => RECIPE_CATEGORY_PHOTOS_PATH, 
				'allowed_types' => 'gif|jpg|png', 
				'file_name' => $new_file_name, 
				'max_size' => 2048, 
				'max_width' => 1600, 
				'max_height' => 1600,
			);

			$this->upload->initialize($config);
		}



		// if ($this->form_validation->run() === FALSE) {
		//if (!$this->form_validation->run()) {
		if (!$this->form_validation->run() || ($check_file_upload && !$this->upload->do_upload('photo'))) {


			// Load the record.
			$recipe_category = new recipe_categories_model();
			$recipe_category->load($id);
			if (!$recipe_category->id) {
				show_404();
			}


			// Set the title for the page.
			$page_data['title'] = 'Edit Recipe Category';
			// Set content for the page.		
			$data['title'] = 'Edit Recipe Category';	
			$data['recipe_category'] = $recipe_category;

			$this->load->view('templates/top', $page_data);
	        $this->load->view('templates/header', $page_data);
	        $this->load->view('recipe_categories/form', $data);
	        $this->load->view('templates/footer');

		} else {

			// Set default values.
			$datetime = date('Y-m-d H:i:s', time());


			// Load the record.
			$recipe_category = new recipe_categories_model();
			$recipe_category->load($id);
			if (!$recipe_category->id) {
				show_404();
			}


			// Save the data.
			$recipe_category->name = $this->input->post('name');
			$recipe_category->description = $this->input->post('description');
			$recipe_category->sort_order = ($this->input->post('sort_order') != '' ? $this->input->post('sort_order') : $recipe_category->sort_order);			
			
			$recipe_category->display = $recipe_category->display;
			$recipe_category->featured = $recipe_category->featured;
			$recipe_category->status = $recipe_category->status;
			$recipe_category->created_at = $recipe_category->created_at;
	


			// Deal with the Uploaded Image.
			$current_photo = $this->input->post('current_photo');
			$current_photo_tn = $this->input->post('current_photo_tn');				
			
			
			if ($check_file_upload) {
				$upload_data = $this->upload->data();
				if (isset($upload_data['file_name'])) {
					$recipe_category->photo = $upload_data['file_name'];
					$recipe_category->photo_tn = $tn_file_name;

					// Create a thumbnail of the uploaded image.
					$this->load->library('Imagetransform');

					$main_file = RECIPE_CATEGORY_PHOTOS_PATH . $new_file_name;
					$tn_file = RECIPE_CATEGORY_PHOTOS_PATH . $tn_file_name;

					//$this->imagetransform->resize($main_file, 500, 500, $main_file);
					$this->imagetransform->crop($main_file, 500, 500);
					$this->imagetransform->crop($main_file, 100, 100, $tn_file);

					// Delete the replaced image files if they exist.
					if (($current_photo != '') && (file_exists(RECIPE_CATEGORY_PHOTOS_PATH . $current_photo))) {
						unlink(RECIPE_CATEGORY_PHOTOS_PATH . $current_photo);
					}
					//if ($current_profile_photo_tn != '') {
					if (($current_photo_tn != '') && (file_exists(RECIPE_CATEGORY_PHOTOS_PATH . $current_photo_tn))) {
						unlink(RECIPE_CATEGORY_PHOTOS_PATH . $current_photo_tn);
					}					
					
				}
			} else {
				// $member->profile_photo = $current_profile_photo;
				// $member->profile_photo_tn = $current_profile_photo_tn;
			}



			$recipe_category->updated_at = $datetime;

			$recipe_category->save();


			// Set message data and redirect to display the magazine.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'Recipe Category \'' . html_escape($recipe_category->name) . '\' Updated.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('recipe_categories', 'refresh');

		}

    } // end of - function edit	    



	/**
	 * Delete a record.
	 * @param int $id
	 */
	public function delete($id) {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();
    	

		$recipe_category = new recipe_categories_model();
		$recipe_category->load($id);
		if (!$recipe_category->id) {
			//show_404();

			// Set message data and redirect to display the list of publications.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'Recipe Category Not Found.  No data was deleted.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('recipe_categories', 'refresh');			
		}


		// Need to delete all comments associated with this recipe.
		// $this->load->model('recipe_comments_model');
		// $this->recipe_comments_model->delete_recipe_comments($id);
		

		$recipe_category->delete($id);


		// Set message data and redirect to display the list of publications.
		$this->session->set_flashdata('message_class', 'alert-success');
		$this->session->set_flashdata('message', 'Recipe Category \'' . html_escape($recipe_category->name) . '\' was Deleted!!!');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		redirect('recipe_categories', 'refresh');				

	} // end of - function delete	

	
	
	
	// START OF - custom functions
	
	
	/**
	 * List records.
	 */
	public function select() {

		// Load helers/libraries/models.
		$this->load->helper('date');

		$a_recipe_categories = array();
		$a_recipe_categories = $this->recipe_categories_model->get_recipe_categories();


		// Set the title for the page.
		$page_data['dropdown_title'] = 'By Category';
		$page_data['title'] = 'Recipe Categories';
		$data['title'] = 'Recipe Categories';	
		$data['recipe_categories'] = $a_recipe_categories;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('recipe_categories/select', $data);
		$this->load->view('templates/footer');
		$this->load->view('more_js/isotope');

	} // end of - function select		
	
	
	
} // end of - class

/* End of file recipe_categories.php */
/* Location: ./application/controllers/recipe_categories.php */