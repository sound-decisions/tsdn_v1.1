<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Recipes extends CI_Controller {


	public function __construct() {

		parent::__construct();
		
		$this->load->model('recipes_model');
		
	} // end of - function __construct


	/**
	 * List records.
	 */
	public function index() {

		// Load helers/libraries/models.
		$this->load->helper('date');

		$limit = 5;
		$a_recipes = array();
		//$a_recipes = $this->recipes_model->get_recipes($limit);
		$a_recipes = $this->recipes_model->get_recipes_with_category_name($limit);


		// Get the data for the my recipes list.
		$data_for_list['recipes'] = $a_recipes;

		// Create the my recipes list view code.
		//$recipes_view = $this->load->view('recipes/_panel_list', $data_for_list, true);
		$recipes_view = $this->load->view('recipes/_simple_list', $data_for_list, true);	


		// Set the title for the page.
		$page_data['top_menu'] = 'Recipes';
		$page_data['title'] = 'Recipes';
		
		$data['title'] = 'Recipes';	
		//$data['recipes'] = $a_recipes;
		$data['recipes_view'] = $recipes_view;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('recipes/index', $data);
		$this->load->view('templates/footer');

	} // end of - function index



	/**
	 * View a record.
	 * @param int $id
	 */
	public function view($id) {

		// Load helers/libraries/models.
		$this->load->helper('date');
		$this->load->helper('security');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('recipe_notes_model');

		$recipe = new recipes_model();
		$recipe->load($id);
		if (!$recipe->id) {
			show_404();
		}

		// Set the title for the page.
		$page_data['top_menu'] = 'Recipes';
		$page_data['title'] = 'Recipe';
		
		// Set content for the page.
		$data['title'] = 'Recipe';
		$data['recipe'] = $recipe;	
		
		// Only allow signed in members to add recipe notes.
		if ($this->session->userdata('member_id') != '') {
					
			// Get recipe notes.
			$a_recipe_notes = array();
			$a_recipe_notes = $this->recipe_notes_model->get_recipe_notes($id);
			$data['recipe_notes'] = $a_recipe_notes;
			$data['recipe_id'] = $id;
			
		}

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('recipes/view', $data);
		
		// Only allow signed in members to add recipe notes.
		if ($this->session->userdata('member_id') != '') {			
			$this->load->view('recipe_notes/form_and_notes', $data);
		}
		$this->load->view('templates/footer');	
		// More JS for accordion.
		$this->load->view('more_js/recipe_notes');

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

			$a_recipe_category_form_options[''] = 'Select A Category';

			foreach ($recipe_categories as $recipe_category) {
				$a_recipe_category_form_options[$recipe_category['id']] = $recipe_category['name'];
			} // end of - foreach

			
            // Create the list of items for the drop down.
            $access_options = array(  
                'private' => 'Just Me', 
                'public' => 'Everyone', 
                'connections' => 'My Connections'
            );				
			

			// Set the title for the page.	
			$page_data['top_menu'] = 'Recipes';
			$page_data['dropdown_menu'] = "Add A Recipe";
			$page_data['title'] = 'Add A Recipe';
			
			$data['title'] = 'Add A Recipe';
			$data['recipe_category_form_options'] = $a_recipe_category_form_options;
			$data['access_form_options'] = $access_options;

			$this->load->view('templates/top', $page_data);
			$this->load->view('templates/header', $page_data);
			$this->load->view('templates/advertising');
			$this->load->view('recipes/form', $data);
			$this->load->view('templates/footer');

		} else {

			// Set default values.
			$display = 'yes';
			$featured = 'no';
			$status = 'new';
			$datetime = date('Y-m-d H:i:s', time());

			// Save data.
			$recipe = new recipes_model();
			$recipe->member_id = $this->session->userdata('member_id');
			$recipe->category_id = $this->input->post('category_id');
			$recipe->name = $this->input->post('name');
			$recipe->description = $this->input->post('description');
			$recipe->ingredients = $this->input->post('ingredients');
			$recipe->directions = $this->input->post('directions');

			$recipe->display = $display;
			$recipe->featured = $featured;
			$recipe->status = $status;
			$recipe->access = $this->input->post('access');
			if ($recipe->access == '') {
				$recipe->access == 'private';
			}
			$recipe->created_at = $datetime;
			$recipe->updated_at = $datetime;

			$recipe->save();


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'The Recipe for \'' . html_escape($recipe->name) . '\' was successfully saved.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('recipes/view/' . $recipe->id, 'refresh');

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
		$recipe = new recipes_model();
		$recipe->load($id);
		if (!$recipe->id) {
			show_404();
		}		


		// Recipe Categories.
		$this->load->model('recipe_categories_model');
		$recipe_categories = $this->recipe_categories_model->get_recipe_categories();
		$a_recipe_category_form_options = array();

		foreach ($recipe_categories as $recipe_category) {
			$a_recipe_category_form_options[$recipe_category['id']] = $recipe_category['name'];
		} // end of - foreach	

        // Create the list of items for the drop down.
        $access_options = array(  
            'private' => 'Just Me', 
            'public' => 'Everyone', 
            'connections' => 'My Connections'
        );		
		

		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Set the title for the page.
			$page_data['top_menu'] = 'Recipes';
			$page_data['title'] = 'Edit Recipe';
			
			// Set content for the page.		
			$data['title'] = 'Edit Recipe';
			$data['recipe'] = $recipe;
			$data['recipe_category_form_options'] = $a_recipe_category_form_options;
			$data['access_form_options'] = $access_options;

			$this->load->view('templates/top', $page_data);
	        $this->load->view('templates/header', $page_data);
	        $this->load->view('templates/advertising');
	        $this->load->view('recipes/form', $data);
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
			// $recipe = new recipes_model();
			// $recipe->load($this->input->post('id'));

			$recipe->category_id = $this->input->post('category_id');
			$recipe->name = $this->input->post('name');
			$recipe->description = $this->input->post('description');
			$recipe->ingredients = $this->input->post('ingredients');
			$recipe->directions = $this->input->post('directions');

			$recipe->display = $recipe->display;
			$recipe->featured = $recipe->featured;
			$recipe->status = $recipe->status;
			$recipe->access = $this->input->post('access');
			if ($recipe->access == '') {
				$recipe->access == 'private';
			}			
			$recipe->created_at = $recipe->created_at;
			$recipe->updated_at = $datetime;

			$recipe->save();


			// Set message data and redirect to display the magazine.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'The Recipe for \'' . html_escape($recipe->name) . '\' Updated!!!');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('recipes/view/' . $id, 'refresh');

		}        

    } // end of - function edit	



	/**
	 * Delete a record.
	 * @param int $id
	 */
	public function delete($id) {
		
		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in();
		
		$recipe = new recipes_model();
		$recipe->load($id);
		if (!$recipe->id) {
			//show_404();

			// Set message data and redirect to display the list of publications.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'News Item Not Found.  No data was deleted.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('recipes', 'refresh');			
		}


		// // Need to delete all comments associated with this recipe.
		// $this->load->model('recipe_comments_model');
		// $this->news_comments_model->delete_recipe_comments($id);
		

		$recipe->delete($id);


		// Set message data and redirect to display the list of publications.
		$this->session->set_flashdata('message_class', 'alert-success');
		$this->session->set_flashdata('message', 'Recipe \'' . html_escape($recipe->name) . '\' was Deleted!!!');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		redirect('recipes', 'refresh');

	} // end of - function delete	



	/* START OF - custom functions */


	/**
	 * List records.
	 */
	public function my_recipes() {

		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in();

		// Load helers/libraries/models.
		$this->load->helper('date');

		$a_recipes = array();
		$a_recipes = $this->recipes_model->get_my_recipes($this->session->userdata('member_id'));


		// Get the data for the my recipes list.
		$data_for_list['recipes'] = $a_recipes;

		// Create the my recipes list view code.
		$recipes_view = $this->load->view('recipes/_panel_list', $data_for_list, true);


		// Set the title for the page.
		$page_data['top_menu'] = 'Recipes';
		$page_data['dropdown_menu'] = "My Recipes";
		$page_data['title'] = 'My Recipes';
		
		$data['title'] = 'My Recipes';	
		//$data['recipes'] = $a_recipes;
		$data['recipes_view'] = $recipes_view;


		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('recipes/my-recipes', $data);
		$this->load->view('templates/footer');

	} // end of - function my_recipes	



	/**
	 * List records by category.
	 */
	public function recipes_by_category($category_id = 0) {

		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in();

		// Load helers/libraries/models.
		$this->load->helper('date');
		$this->load->model('recipe_categories_model');
		$this->load->model('recipe_notes_model');
		
		// Get recipes.
		$a_recipes = array();
		if ($category_id != 0) {
			$a_recipes = $this->recipes_model->get_recipes_for_category($category_id);
		} else {
			$limit = 20;
			$a_recipes = $this->recipes_model->get_recipes($limit);
		}
				
		
		// Get the data for the my recipes list.
		$data_for_list['recipes'] = $a_recipes;

		// Create the my recipes list view code.
		$recipes_view = $this->load->view('recipes/_list_group', $data_for_list, true);
		//$recipes_view = $this->load->view('recipes/_collapse_list', $data_for_list, true);
		//$recipes_view = $this->load->view('recipes/_simple_panel_list', $data_for_list, true);
		//$recipes_view = $this->load->view('recipes/_open_panel_list', $data_for_list, true);
						
		
		// Get recipe categories.
		$a_recipe_categories = array();
		//$a_recipe_categories = $this->recipe_categories_model->get_recipe_categories();	
		$a_recipe_categories = $this->recipe_categories_model->get_recipe_categories_with_number_of_recipes();	
		

		// Get the category name.
		//$category_name = $this->recipe_categories_model->get_recipe_category_name($category_id);
		if (empty($a_recipes)) {
			if ($category_id != 0) {
				$category_name = $this->recipe_categories_model->get_recipe_category_name($category_id);
				// Set the value for the page header.
				$page_header = $category_name;
			} else {
				$category_name = '';
				// Set the value for the page header.
				$page_header = '<div class="clearfix"><div class="pull-left">Recipes</div><div class="pull-right"><span class="extra-content-right">(20 Most Recent)</span></div></div>';
			}
		} else {
			if ($category_id != 0) {	
				$category_name = $a_recipes[0]['category_name'];
				// Set the value for the page header.
				$page_header = $category_name;
			} else {
				$category_name = '';
				// Set the value for the page header.
				//$page_header = 'Recipes <span class="extra-content">(20 Most Recent)</span>';
				$page_header = '<div class="clearfix"><div class="pull-left">Recipes</div><div class="pull-right"><span class="extra-content-right">(20 Most Recent)</span></div></div>';
			}
		}

		// Get the data for the my recipe categories menu.
		$data_for_list['recipe_categories'] = $a_recipe_categories;

		// Create the my recipes list view code.
		$recipe_categories_view = $this->load->view('recipe_categories/_list_group_menu', $data_for_list, true);		
		

		// Set the title for the page.
		$page_data['top_menu'] = 'Recipes';
		$page_data['dropdown_menu'] = "By Category";
		if ($category_name != '') {
			$page_data['title'] = $category_name . ' Recipes';
		} else {
			$page_data['title'] = 'Recipes';
		}		
		
		$data['title'] = $page_header;
		
		//$data['title'] = $category_name . ' Recipes';	
		//$data['recipes'] = $a_recipes;
		//$data['recipe_notes'] = $a_recipe_notes;
		$data['recipe_categories'] = $a_recipe_categories;
		$data['recipes_view'] = $recipes_view;
		$data['recipe_categories_view'] = $recipe_categories_view;


		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		//$this->load->view('recipes/by-category', $data);
		$this->load->view('recipes/by-category-with-category-menu', $data);
		$this->load->view('templates/footer');

	} // end of - function recipes_by_category




	/**
	 * List records by category.
	 */
	public function recipes_by_category_public($category_id = 0) {

		// Make sure that a member is signed in before displaying this page.
		//$this->accesschecks->check_if_member_signed_in();

		// Load helers/libraries/models.
		$this->load->helper('date');
		$this->load->model('recipe_categories_model');
		$this->load->model('recipe_notes_model');
		
		// Get recipes.
		$a_recipes = array();
		if ($category_id != 0) {
			$a_recipes = $this->recipes_model->get_recipes_for_category($category_id);
		} else {
			$limit = 20;
			$a_recipes = $this->recipes_model->get_recipes($limit);
		}
				
		
		// Get the data for the my recipes list.
		$data_for_list['recipes'] = $a_recipes;

		// Create the my recipes list view code.
		$recipes_view = $this->load->view('recipes/_list_group', $data_for_list, true);
		//$recipes_view = $this->load->view('recipes/_collapse_list', $data_for_list, true);
		//$recipes_view = $this->load->view('recipes/_simple_panel_list', $data_for_list, true);
		//$recipes_view = $this->load->view('recipes/_open_panel_list', $data_for_list, true);
						
		
		// Get recipe categories.
		$a_recipe_categories = array();
		//$a_recipe_categories = $this->recipe_categories_model->get_recipe_categories();	
		$a_recipe_categories = $this->recipe_categories_model->get_recipe_categories_with_number_of_recipes();	
		

		// Get the category name.
		//$category_name = $this->recipe_categories_model->get_recipe_category_name($category_id);
		if (empty($a_recipes)) {
			if ($category_id != 0) {
				$category_name = $this->recipe_categories_model->get_recipe_category_name($category_id);
				// Set the value for the page header.
				$page_header = $category_name;
			} else {
				$category_name = '';
				// Set the value for the page header.
				$page_header = '<div class="clearfix"><div class="pull-left">Recipes</div><div class="pull-right"><span class="extra-content-right">(20 Most Recent)</span></div></div>';
			}
		} else {
			if ($category_id != 0) {	
				$category_name = $a_recipes[0]['category_name'];
				// Set the value for the page header.
				$page_header = $category_name;
			} else {
				$category_name = '';
				// Set the value for the page header.
				//$page_header = 'Recipes <span class="extra-content">(20 Most Recent)</span>';
				$page_header = '<div class="clearfix"><div class="pull-left">Recipes</div><div class="pull-right"><span class="extra-content-right">(20 Most Recent)</span></div></div>';
			}
		}

		// Get the data for the my recipe categories menu.
		$data_for_list['recipe_categories'] = $a_recipe_categories;

		// Create the my recipes list view code.
		$recipe_categories_view = $this->load->view('recipe_categories/_list_group_menu', $data_for_list, true);		
		

		// Set the title for the page.
		$page_data['top_menu'] = 'Recipes';
		$page_data['dropdown_menu'] = "By Category";
		if ($category_name != '') {
			$page_data['title'] = $category_name . ' Recipes';
		} else {
			$page_data['title'] = 'Recipes';
		}		
		
		$data['title'] = $page_header;
		
		//$data['title'] = $category_name . ' Recipes';	
		//$data['recipes'] = $a_recipes;
		//$data['recipe_notes'] = $a_recipe_notes;
		$data['recipe_categories'] = $a_recipe_categories;
		$data['recipes_view'] = $recipes_view;
		$data['recipe_categories_view'] = $recipe_categories_view;


		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		//$this->load->view('recipes/by-category', $data);
		$this->load->view('recipes/by-category-with-category-menu', $data);
		$this->load->view('templates/footer');

	} // end of - function recipes_by_category_public



	/**
	 * Display details about this section of the website.
	 */
	public function about() {

		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();


		// Set the title for the page.
		$page_data['top_menu'] = 'Members Only';
		$page_data['dropdown_menu'] = 'About Recipes';
		$page_data['title'] = 'About The Recipes Section';
		
		// Set content for the page.
		$data['title'] = 'About The Recipes Section';
		
		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('recipes/about', $data);
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
		$a_recipes = array();
		//$a_recipes = $this->recipes_model->get_recipes($limit);
		$a_recipes = $this->recipes_model->get_recipes_with_category_name($limit);


		// Get the data for the my recipes list.
		$data_for_list['recipes'] = $a_recipes;

		// Create the my recipes list view code.
		//$recipes_view = $this->load->view('recipes/_panel_list', $data_for_list, true);
		$recipes_view = $this->load->view('recipes/_simple_list', $data_for_list, true);	


		// Set the title for the page.
		$page_data['top_menu'] = 'Admin Menu';
		$page_data['dropdown_menu'] = "Recipes";
		$page_data['title'] = 'Recipes';
		
		$data['title'] = 'Recipes';	
		//$data['recipes'] = $a_recipes;
		$data['recipes_view'] = $recipes_view;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('recipes/index', $data);
		$this->load->view('templates/footer');

	} // end of - function admin_list


} // end of - class

/* End of file recipes.php */
/* Location: ./application/controllers/recipes.php */