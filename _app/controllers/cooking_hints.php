<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Cooking_hints extends CI_Controller {


	public function __construct() {

		parent::__construct();
		
		$this->load->model('cooking_hints_model');
		
	} // end of - function __construct


	/**
	 * List records.
	 */
	public function index() {
		
		// Load helers/libraries/models.
        $this->load->helper('form');		
		
		// Make sure that search criteria isn't being used.
		$this->session->set_userdata('cooking_hints_title_search', '');
		
		$limit = 5;
		$a_cooking_hints = array();
		$a_cooking_hints = $this->cooking_hints_model->get_cooking_hints($limit);


		// Set the title for the page.
		$page_data['top_menu'] = 'Members Only';
		$page_data['dropdown_menu'] = 'Cooking Hints';
		$page_data['title'] = 'Cooking Hints';
		
		$data['title'] = 'Cooking Hints <span class="extra-content">(Last ' . $limit . ' Added)</span>';	
		$data['cooking_hints'] = $a_cooking_hints;
		$data['form_action'] = 'cooking_hints/search-results';
		
		$this->load->view('templates/top', $data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('cooking_hints/search-form', $data);
		$this->load->view('cooking_hints/index', $data);
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
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


		// If form validation fails - display the following.
		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Set the title/data for the page.
			$page_data['top_menu'] = 'Admin Menu';
			$page_data['dropdown_menu'] = "Add A Cooking Hint";			
			$page_data['title'] = 'Add A Cooking Hint';
			
			$data['title'] = 'Add A Cooking Hint';
			$data['form_action'] = 'cooking_hint/add';

			$this->load->view('templates/top', $page_data);
			$this->load->view('templates/header', $page_data);
			$this->load->view('cooking_hints/form', $data);
			$this->load->view('templates/footer');

		} else {

			// Set default values.
			$display = 'yes';
			$featured = 'no';
			$status = 'new';
			$datetime = date('Y-m-d H:i:s', time());

			// Save data.
			$cooking_hint = new cooking_hints_model();
			$cooking_hint->title = $this->input->post('title');
			$cooking_hint->content = $this->input->post('content');			
			$cooking_hint->display = $display;
			$cooking_hint->featured = $featured;
			$cooking_hint->status = $status;
			$cooking_hint->created_at = $datetime;
			$cooking_hint->updated_at = $datetime;

			$cooking_hint->save();


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'Your Cooking Hint was successfully saved.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			if ($this->input->post('from_page') == 'view') {
				redirect('cooking_hints/view/' . $cooking_hint->id, 'refresh');
			} else {
				redirect('cooking_hints', 'refresh');
			}			

		}

	} // end of - function add	



	/**
	 * Delete a record.
	 * @param int $id
	 */
	public function delete($id) {

		$cooking_hint = new cooking_hints_model();
		$cooking_hint->load($id);
		if (!$cooking_hint->id) {
			//show_404();

			// Set message data and redirect to display the list of publications.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'Cooking Hint Not Found.  No data was deleted.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('cooking_hints', 'refresh');
		}

		$cooking_hint->delete($id);


		// Set message data and redirect to display the list of publications.
		$this->session->set_flashdata('message_class', 'alert-success');
		$this->session->set_flashdata('message', 'The Cooking Hint \'' . $cooking_hint->title . '\' was Deleted!!!');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		redirect('cooking_hints', 'refresh');

	} // end of - function delete	





    // Display the Movie Search Results.
    public function search_results() {
        
		// Make sure that a member is signed in before displaying this page.
		//$this->accesschecks->check_if_member_signed_in();
        
		// Load helers/libraries/models.
        $this->load->helper('form');
        
		$a_cooking_hints = array();
		$a_cooking_hints = $this->cooking_hints_model->get_cooking_hints_search_results();		
		
		// Get the data for the my recipes list.
		//$data_for_list['cooking_hints'] = $a_cooking_hints;

		// Create the list to be displayed.
		//$cooking_hints_list = $this->load->view('cooking_hints/_list', $data_for_list, true);	
				
		// Set the title/data for the page.
        $page_data['title'] = 'Cooking Hints Search Results';
		$data['title'] = 'Cooking Hints <span class="extra-content">(Search Results)</span>';
		$data['form_action'] = 'cooking_hints/search-results';
		$data['cooking_hints'] = $a_cooking_hints;
		//$data['cooking_hints_list'] = $cooking_hints_list;		
        
		$this->load->view('templates/top', $page_data);
        $this->load->view('templates/header', $page_data);
        $this->load->view('cooking_hints/search-form', $data);    
        $this->load->view('cooking_hints/index', $data);  
        $this->load->view('templates/footer');
        
    } // end of - public function search_results	







} // end of - class

/* End of file cooking_hints.php */
/* Location: ./application/controllers/cooking_hints.php */