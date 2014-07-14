<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class News extends CI_Controller {


	public function __construct() {

		parent::__construct();
		
		$this->load->model('news_model');
		
	} // end of - function __construct


	/**
	 * List records.
	 */
	public function index() {

		// Load helers/libraries/models.
		$this->load->helper('date');
		$this->load->helper('security');
		$this->load->helper('form');
		$this->load->model('news_comments_model');

		$a_news = array();
		$a_news = $this->news_model->get_news();


		// Get the news comments for all news items.
		$a_news_comments = array();

		$news_comments_model = new news_comments_model();
		//$a_news_comments = $this->news_comments_model->get_news_comments();	
		$a_news_comments = $this->news_comments_model->get_news_comments_with_member_name();


		// Get the data for the my news list.
		$data_for_list['news_items'] = $a_news;
		$data_for_list['comments'] = $a_news_comments;

		// Create the news list view code.
		$news_view = $this->load->view('news/news_list', $data_for_list, true);


		// Set the title for the page.
		$page_data['top_menu'] = 'About';
		$page_data['dropdown_menu'] = 'News';
		$page_data['title'] = 'The News';

		$data['title'] = 'The News';
		$data['news_items'] = $a_news;
		$data['news_view'] = $news_view;
		$data['comments'] = $a_news_comments;

		$this->load->view('templates/top', $data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('news/index', $data);
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
		$this->load->model('news_comments_model');
		

		$news_item = new news_model();
		$news_item->load($id);
		if (!$news_item->id) {
			show_404();
		}

		// Get the news comments for this news item.
		$a_news_comments = array();

		$news_comments_model = new news_comments_model();
		//$a_news_comments = $this->news_comments_model->get_news_comments($id);
		$a_news_comments = $this->news_comments_model->get_news_comments_with_member_name($id);

		// Set the title for the page.
		$page_data['title'] = 'News Item';
		// Set content for the page.
		$data['title'] = 'News Item';			
		$data['news_item'] = $news_item;	
		$data['comments'] = $a_news_comments;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('news/view', $data);
		$this->load->view('news_comments/form_and_comments', $data);
		$this->load->view('templates/footer');			

	} // end of - function view



	/**
	 * Add a record.
	 */
	public function add() {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();


		// Load helers/libraries/models.
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');


		// Form Validation.
		$this->form_validation->set_rules('headline', 'Story Header', 'required');
		$this->form_validation->set_rules('story', 'Story Text', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');



		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Set the title for the page.
			$page_data['top_menu'] = 'Admin Menu';
			$page_data['dropdown_menu'] = 'Add A News Item';
			$page_data['title'] = 'Add A News Item';
			
			$data['title'] = 'Add A News Item';

			$this->load->view('templates/top', $page_data);
			$this->load->view('templates/header', $page_data);
			$this->load->view('templates/advertising');
			$this->load->view('news/form', $data);
			$this->load->view('templates/footer');

		} else {

			// Set default values.
			$date_posted = date('Y-m-d', time());
			$display = 'yes';
			$featured = 'no';
			$status = 'new';
			$datetime = date('Y-m-d H:i:s', time());

			// Save data.
			$news_item = new news_model();
			$news_item->headline = $this->input->post('headline');
			$news_item->story = $this->input->post('story');
			$news_item->date_posted = $date_posted;
			$news_item->display = $display;
			$news_item->featured = $featured;
			$news_item->status = $status;
			$news_item->created_at = $datetime;
			$news_item->updated_at = $datetime;

			$news_item->save();


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'News Item \'' . html_escape($news_item->headline) . '\' Created!!!');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('news/view/' . $news_item->id, 'refresh');			

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
		$this->form_validation->set_rules('id', 'News ID', 'required');
		$this->form_validation->set_rules('headline', 'Story Header', 'required');
		$this->form_validation->set_rules('story', 'Story Text', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


		// Load the record.
		$news_item = new news_model();
		$news_item->load($id);
		if (!$news_item->id) {
			show_404();
		}	


		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Set the title for the page.
			$page_data['title'] = 'Edit News Item Details';
			$page_data['top_menu'] = 'About';
			$page_data['dropdown_menu'] = 'News';
					
			// Set content for the page.		
			$data['title'] = 'Edit News Item Details';	
			$data['news_item'] = $news_item;

			$this->load->view('templates/top', $page_data);
	        $this->load->view('templates/header', $page_data);
	        $this->load->view('templates/advertising');
	        $this->load->view('news/form', $data);
	        $this->load->view('templates/footer');

		} else {

			// Set default values.
			$datetime = date('Y-m-d H:i:s', time());

			$news_item->headline = $this->input->post('headline');
			$news_item->story = $this->input->post('story');
			// $news_item->date_posted = $news_item->date_posted;
			// $news_item->display = $news_item->display;
			// $news_item->featured = $news_item->featured;
			// $news_item->status = $news_item->status;
			// $news_item->created_at = $news_item->created_at;
			$news_item->updated_at = $datetime;

			$news_item->save();


			// Set message data and redirect to display the magazine.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'News Item \'' . html_escape($news_item->headline) . '\' Updated!!!');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('news/view/' . $id, 'refresh');

		}

    } // end of - function edit	




	/**
	 * Delete a record.
	 * @param int $id
	 */
	public function delete($id) {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();

    	
		$news_item = new news_model();
		$news_item->load($id);
		if (!$news_item->id) {
			//show_404();

			// Set message data and redirect to display the list of publications.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'News Item Not Found.  No data was deleted.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('news', 'refresh');			
		}


		// Need to delete all comments associated with this news item.
		$this->load->model('news_comments_model');
		$this->news_comments_model->delete_news_item_news_comments($id);
		

		$news_item->delete($id);


		// Set message data and redirect to display the list of publications.
		$this->session->set_flashdata('message_class', 'alert-success');
		$this->session->set_flashdata('message', 'News Item \'' . html_escape($news_item->headline) . '\' was Deleted!!!');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		redirect('news', 'refresh');

	} // end of - function delete	

	
	
	
	
	/**
	 * List records.
	 */
	public function news_headlines_with_ajax_story() {

		// Load helers/libraries/models.
		$this->load->helper('date');

		// Get the newest news story to be displayed first.
		//$news_view = '<div id="news_item_content">News Item Content Will Go Here</div>' . chr(10);


		// Get the Latest News.
		$limit = 10;
		$a_latest_news = array();
		$a_latest_news = $this->news_model->get_latest_news($limit);
		
		
		// Create the initial news item view.
		$data_for_list['news_items'] = $a_latest_news;

		// Create the news list view code.
		$news_view = $this->load->view('news/_news_item', $data_for_list, true);
		
		
		// Create the menu view.
		$data_for_menu['latest_news'] = $a_latest_news;

		// Create the news list view code.
		$news_headline_menu_view = $this->load->view('news/_news_headline_menu', $data_for_menu, true);



		// Set the title for the page.
		$page_data['top_menu'] = 'About';
		$page_data['dropdown_menu'] = 'News';
		$page_data['title'] = 'The News';

		$data['title'] = 'The News';
		$data['news_view'] = $news_view;
		$data['news_headline_menu_view'] = $news_headline_menu_view;

		$this->load->view('templates/top', $data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('news/news_list_ajax', $data);
		$this->load->view('templates/footer');
		$this->load->view('more_js/ajax_news');

	} // end of - function news_headlines_with_ajax_story	
	
	
	
	/**
	 * List records.
	 */
	public function get_news_item_using_ajax($id) {

		// Load helers/libraries/models.
		$this->load->helper('date');

		$news_item = new news_model();
		$news_item->load($id);
		if (!$news_item->id) {
			echo 'not found';
			return 'not found';
		}
		
		// Create the initial news item view.
		$data['news_item'] = $news_item;

		// Create the news list view code.
		$news_view = $this->load->view('news/_news_item_object', $data, true);

		echo $news_view;

	} // end of - function get_news_item_using_ajax		
	
	
	
} // end of - class

/* End of file news.php */
/* Location: ./application/controllers/news.php */