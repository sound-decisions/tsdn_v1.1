<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movies extends CI_Controller {


	public function __construct() {

		parent::__construct();
		
		$this->load->model('movies_model');
		
	} // end of - function __construct
	
	
	
	/**
	 * List records.
	 */
	public function index() {

		// Load helpers/libraries/models.
		$this->load->helper('form');
		$this->load->helper('date');

		// Clear search criteria session variables.
		$this->movies_model->clear_search_session_variables();

		$limit = 20;
		$a_movies = array();
		$a_movies = $this->movies_model->get_movies($limit);


		// Get the data for the my recipes list.
		$data_for_list['movies'] = $a_movies;
		$data_for_list['function_name'] = 'index';

		// Create the list to be displayed.
		$movies_list = $this->load->view('movies/_list', $data_for_list, true);		


		// Set the title/data for the page.
		$page_data['top_menu'] = 'Movies';
		$page_data['dropdown_menu'] = 'Browse Movies';
		$page_data['title'] = 'Movies';
		
		//$data['title'] = 'Movies <span class="extra-content">(Last ' . $limit . ' Added)</span>';
		$data['title'] = '<div class="clearfix"><div class="pull-left">Movies</div><div class="pull-right"><span class="extra-content">(Last ' . $limit . ' Added)</span></div></div>';
		//$data['movies'] = $a_movies;
		$data['movies_list'] = $movies_list;
        $data['search_form_action'] = 'movies/search-results';

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('movies/search-form', $data);
		$this->load->view('movies/index', $data);
		$this->load->view('templates/footer');
		$this->load->view('more_js/ajax_movies');

	} // end of - function index	
	
	
	
	
	
	/**
	 * View a record.
	 * @param int $id
	 */
	public function view($id) {

		// Load helpers/libraries/models.
        $this->load->helper('form');

		// $movie = new movies_model();
		// $movie->load($id);
		// if (!$movie->id) {
			// show_404();
		// }
		
		if ($id == '') {
			show_404();
		} else {
			//$a_movies = array();
			$a_movies = $this->movies_model->get_movie_details($id);
		}

		// Set the title for the page.
		$page_data['top_menu'] = 'Movies';
		$page_data['title'] = 'Movie Details';
		
		// Set content for the page.
		$data['title'] = 'Movie Details';
        $data['form_action'] = 'movies/search-results';
		$data['movies'] = $a_movies;
		$data['function_name'] = 'view';
        $data['search_form_action'] = 'movies/search-results';
        $data['form_action'] = 'member-movies/edit-rating/' . $id . '';

		$this->load->view('templates/top', $page_data);
        $this->load->view('more_css/star_rating');
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
        $this->load->view('movies/search-form', $data);
		$this->load->view('movies/view', $data);
		$this->load->view('templates/footer');
		$this->load->view('more_js/ajax_movies');
        $this->load->view('more_js/star_rating');

	} // end of - function view



	/**
	 * Add a record.
	 */
	public function add() {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();


		// Load helpers/libraries/models.
		$this->load->helper('form');
		$this->load->helper('common_functions');
		$this->load->library('form_validation');
		$this->load->library('upload');


		// Form Validation.
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('plot', 'Plot', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');



		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {
			
			// Create the list of items for the genre checkboxes.
            $genre_options = array(  
                'Action' => 'Action', 
                'Adventure' => 'Adventure', 
                'Animation' => 'Animation',                 
                'Anime' => 'Anime', 
                'Children' => 'Children', 
                'Comedy' => 'Comedy', 
                'Crime' => 'Crime', 
                'Drama' => 'Drama', 
                'Documentary' => 'Documentary', 
                'Family' => 'Family', 
                'Fantasy' => 'Fantasy', 
                'Horror' => 'Horror', 
                'Music' => 'Music', 
                'Musical' => 'Musical', 
                'Mystery' => 'Mystery', 
                'Romance' => 'Romance', 
                'Sci Fi' => 'Sci Fi', 
                'Sports' => 'Sports', 
                'Television' => 'Television',  
				'Thriller' => 'Thriller',                                
                'Other' => 'Other'
            );				
			
            // Create the list of items for the drop down.
            $mpaa_rating_options = array(  
                '' => '--MPAA Rating--',
                'G' => 'G', 
                'PG' => 'PG', 
                'PG-13' => 'PG-13',                 
                'R' => 'R', 
                'NC-17' => 'NC-17', 
                'NR' => 'NR'
            );			
			
			// Set the title/data for the page.
			$page_data['top_menu'] = 'Admin Menu';
			$page_data['dropdown_menu'] = 'Add A Movie';
			$page_data['title'] = 'Add A Movie';
			
			$data['title'] = 'Add A Movie';
			$data['form_action'] = 'movies/add';
			$data['genre_options'] = $genre_options;
			$data['mpaa_rating_options'] = $mpaa_rating_options;

			$this->load->view('templates/top', $page_data);
			$this->load->view('templates/header', $page_data);
			$this->load->view('movies/form', $data);
			$this->load->view('templates/footer');

		} else {

			// Set default values.
			$overall_rating = 0.0;
			$inventory_owned = 'no';
			$inventory_burned = 'no';
			$inventory_backedup = 'no';
			$inventory_downloaded = 'no';
			$display = 'yes';
			$featured = 'no';
			$datetime = date('Y-m-d H:i:s', time());


			// Figure out the Genre values selected.
			$genre = '';
			foreach ($this->input->post('genre') as $key => $value)
			{
				if ($genre != '') {
					$genre .= ', ';
				}
				$genre .= $value;  
			} 			

			
			// Save data.
			$movie = new movies_model();
			$movie->title = $this->input->post('title');
			$movie->plot = $this->input->post('plot');
			$movie->genre = $genre;
			$movie->year_released = $this->input->post('year_released');
			$movie->runtime = $this->input->post('runtime');
			$movie->mpaa_rating = $this->input->post('mpaa_rating');
			$movie->overall_rating = $overall_rating;
			$movie->starring = $this->input->post('starring');
			$movie->directed_by = $this->input->post('directed_by');
			$movie->written_by = $this->input->post('written_by');
			$movie->produced_by = $this->input->post('produced_by');			
			//$movie->image = $image;
			$movie->imdb_image_url = $this->input->post('imdb_image_url');
			$movie->inventory_owned = $inventory_owned;
			$movie->inventory_burned = $inventory_burned;
			$movie->inventory_backedup = $inventory_backedup;
			$movie->inventory_downloaded = $inventory_downloaded;
			$movie->imdb_id = $this->input->post('imdb_id');
			$movie->display = $display;
			$movie->featured = $featured;
			$movie->created_at = $datetime;
			
			
			// Remove periods.  They cause problems.
			// $movie->starring = str_replace('.', '', $movie->starring);
			// $movie->directed_by = str_replace('.', '', $movie->directed_by);
			// $movie->written_by = str_replace('.', '', $movie->written_by);
			// $movie->produced_by = str_replace('.', '', $movie->produced_by);
			
			
			// Download the image from IMDB if it hasn't already been.
			// ------------------------------------------------------.
			if (($movie->image == '') && ($movie->imdb_image_url != '')) {
				
				$new_image_name = download_image_from_url_and_save_it_to_the_file_system($movie->imdb_image_url, MOVIE_IMAGE_PATH, $movie->title);				
				
				// Testing.
				//echo '<p>new_image_name = ' . $new_image_name . '</p>';
				
				if ($new_image_name != false) {
					$movie->image = $new_image_name;
				} else {
					// Testing.
					//echo '<p>Image file failed to download.</p>';
				}	
				
			}			
			
						
			$movie->updated_at = $datetime;

			$movie->save();


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'The Movie \'' . html_escape($movie->title) . '\' was Successfully added to the Database!!!');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('movies/view/' . $movie->id, 'refresh');

		}

	} // end of - function add	



	/**
	 * Edit a record.
	 * @param int $id	 
	 */
    public function edit($id) {
        
        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();


		// Load helpers/libraries/models.
		$this->load->helper('form');
		$this->load->helper('common_functions');
		$this->load->library('form_validation');
		$this->load->library('upload');		


		// Form Validation.
		$this->form_validation->set_rules('id', 'Movie ID', 'required');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('plot', 'plot', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');



		// Image Upload Validation.
		$check_file_upload = FALSE;
		if (isset($_FILES['image']['error']) && $_FILES['image']['error'] != 4) {
			$check_file_upload = TRUE;

			// Make sure the image name being uploaded will be unique.
			$current_file_name = $_FILES['image']['name'];

			// If the file name has any spaces in it an error will occur so check it before continuing.
			if (strpos($current_file_name, ' ')) {

				// Set message data and redirect to display the new item.
				$this->session->set_flashdata('message_class', 'alert-danger');
				$this->session->set_flashdata('message', 'The image file selected has at least one space in the file name.  Please remove or replace the spaces and try again.');

				// Redirect instead of loading views to prevent a refresh from running the code again.
				redirect('movies/edit', 'refresh');	

			}

			
			// Create the new file name based on the current file extension and the movie title with the timestamp added at the end.
			$ext = '.' . pathinfo($current_file_name, PATHINFO_EXTENSION);
			$new_file_name = format_string_for_file_name($this->input->post('title')) . '_' . time() . $ext;
			
			//$new_file_name = time() . '_' . $current_file_name;			

			// For Image Uploads.
			$config = array (
				'upload_path' => MOVIE_IMAGE_PATH, 
				'allowed_types' => 'gif|jpg|png', 
				'file_name' => $new_file_name, 
				'max_size' => 2048, 
				'max_width' => 1920, 
				'max_height' => 1080,
			);

			$this->upload->initialize($config);
		}




		// Load the record.
		$movie = new movies_model();
		$movie->load($id);
		if (!$movie->id) {
			show_404();
		}	


		// if ($this->form_validation->run() === FALSE) {
		//if (!$this->form_validation->run()) {
		if (!$this->form_validation->run() || ($check_file_upload && !$this->upload->do_upload('image'))) {

			// Create the list of items for the genre checkboxes.
            $genre_options = array(  
                'Action' => 'Action', 
                'Adventure' => 'Adventure', 
                'Animation' => 'Animation',                 
                'Anime' => 'Anime', 
                'Children' => 'Children', 
                'Comedy' => 'Comedy', 
                'Crime' => 'Crime', 
                'Drama' => 'Drama', 
                'Documentary' => 'Documentary', 
                'Family' => 'Family', 
                'Fantasy' => 'Fantasy', 
                'Horror' => 'Horror', 
                'Music' => 'Music', 
                'Musical' => 'Musical', 
                'Mystery' => 'Mystery', 
                'Romance' => 'Romance', 
                'Sci Fi' => 'Sci Fi', 
                'Sports' => 'Sports', 
                'Television' => 'Television',  
				'Thriller' => 'Thriller',                                
                'Other' => 'Other'
            );				
			
            // Create the list of items for the drop down.
            $mpaa_rating_options = array(  
                '' => '--MPAA Rating--',
                'G' => 'G', 
                'PG' => 'PG', 
                'PG-13' => 'PG-13',                 
                'R' => 'R', 
                'NC-17' => 'NC-17', 
                'NR' => 'NR'
            );	

			// Set the title for the page.
			$page_data['top_menu'] = 'Admin Menu';
			$page_data['title'] = 'Edit Movie Details';
			
			// Set content for the page.		
			$data['title'] = 'Edit Movie Details';
			$data['form_action'] = 'movies/edit/' . $id . '';
			$data['movie'] = $movie;
			$data['genre_options'] = $genre_options;
			$data['mpaa_rating_options'] = $mpaa_rating_options;

			$this->load->view('templates/top', $page_data);
	        $this->load->view('templates/header', $page_data);
	        $this->load->view('movies/form', $data);
	        $this->load->view('templates/footer');

		} else {

			// Set default values.
			$datetime = date('Y-m-d H:i:s', time());
			
			// Figure out the Genre values selected.
			$genre = '';
			foreach ($this->input->post('genre') as $key => $value)
			{
				if ($genre != '') {
					$genre .= ', ';
				}
				$genre .= $value;  
			} 			

			$movie->title = $this->input->post('title');
			$movie->plot = $this->input->post('plot');
			$movie->title = $this->input->post('title');
			$movie->plot = $this->input->post('plot');
			$movie->genre = $genre;
			$movie->year_released = $this->input->post('year_released');
			$movie->runtime = $this->input->post('runtime');
			$movie->mpaa_rating = $this->input->post('mpaa_rating');
			$movie->starring = $this->input->post('starring');
			$movie->directed_by = $this->input->post('directed_by');
			$movie->written_by = $this->input->post('written_by');
			$movie->produced_by = $this->input->post('produced_by');
			$movie->imdb_image_url = $this->input->post('imdb_image_url');
			$movie->imdb_id = $this->input->post('imdb_id');
		

			// Remove periods.  They cause problems.
			// $movie->starring = str_replace('.', '', $movie->starring);
			// $movie->directed_by = str_replace('.', '', $movie->directed_by);
			// $movie->written_by = str_replace('.', '', $movie->written_by);
			// $movie->produced_by = str_replace('.', '', $movie->produced_by);
			

			// Deal with the Uploaded Image.
			if ($check_file_upload) {
				$upload_data = $this->upload->data();
				if (isset($upload_data['file_name'])) {
					$movie->image = $upload_data['file_name'];

					// Resize the uploaded image.
					$this->load->library('Imagetransform');

					$main_file = MOVIE_IMAGE_PATH . $new_file_name;

					$this->imagetransform->resize($main_file, 500, 500, $main_file);

					// Delete the replaced image files if they exist.
					$current_image = $this->input->post('$current_image');
					if (($current_image != '') && (file_exists(MOVIE_IMAGE_PATH . $current_image))) {
						unlink(MOVIE_IMAGE_PATH . $current_image);
					}				
					
				}
			}	



			// Download the image from IMDB if it hasn't already been.
			// ------------------------------------------------------.
			if (($movie->image == '') && ($movie->imdb_image_url != '')) {
				
				$new_image_name = download_image_from_url_and_save_it_to_the_file_system($movie->imdb_image_url, MOVIE_IMAGE_PATH, $movie->title);				
				
				// Testing.
				//echo '<p>new_image_name = ' . $new_image_name . '</p>';
				
				if ($new_image_name != false) {
					$movie->image = $new_image_name;
				} else {
					// Testing.
					//echo '<p>Image file failed to download.</p>';
				}	
				
			}
			
			
			
			$movie->updated_at = $datetime;

			$movie->save();			


			// Set message data and redirect to display the magazine.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'The Movie \'' . html_escape($movie->title) . '\' was Successfully Updated!!!');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('movies/view/' . $id, 'refresh');

		}

    } // end of - function edit	





	/**
	 * List featured movies.
	 */
	public function featured_movies() {

		// Load helpers/libraries/models.
		$this->load->helper('date');
        $this->load->helper('form');

		$limit = 100;
		$a_movies = array();
		$a_movies = $this->movies_model->get_featured_movies($limit);


		// Get the data for the my recipes list.
		$data_for_list['movies'] = $a_movies;
		$data_for_list['function_name'] = 'featured_movies';

		// Create the list to be displayed.
		$movies_list = $this->load->view('movies/_list', $data_for_list, true);		


		// Set the title/data for the page.
		$page_data['top_menu'] = 'Movies';
		$page_data['dropdown_menu'] = 'Featured Movies';
		$page_data['title'] = 'Featured Movies';
		
		$data['title'] = 'Featured Movies';
		$data['movies_list'] = $movies_list;
        $data['search_form_action'] = 'movies/search-results';

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
        $this->load->view('movies/search-form', $data);
		$this->load->view('movies/movie-list', $data);
		$this->load->view('templates/footer');
		$this->load->view('more_js/ajax_movies');

	} // end of - function featured_movies



	/**
	 * List My Watch List movies.
	 */
	public function my_watch_list() {

		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();

		// Load helpers/libraries/models.
		$this->load->helper('date');

		$limit = 500;
		$a_movies = array();
		$a_movies = $this->movies_model->get_my_watch_list_movies($limit);


		// Get the data for the my recipes list.
		$data_for_list['movies'] = $a_movies;
		$data_for_list['function_name'] = 'my_watch_list';

		// Create the list to be displayed.
		$movies_list = $this->load->view('movies/_list', $data_for_list, true);		


		// Set the title/data for the page.
		$page_data['top_menu'] = 'Movies';
		$page_data['dropdown_menu'] = 'My Watch List';
		$page_data['title'] = 'My Watch List';
		
		$data['title'] = 'My Watch List';
		$data['movies_list'] = $movies_list;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('movies/movie-list', $data);
		$this->load->view('templates/footer');
		$this->load->view('more_js/ajax_movies');

	} // end of - function my_watch_list



	
	/**
	 * Display the Search Form.
	 */    
    public function search() {
        
		// Make sure that a member is signed in.
		//$this->accesschecks->check_if_member_signed_in();
        
		// Load helpers/libraries/models.
        $this->load->helper('form');

        // Clear search session variables.
        $this->movies_model->clear_search_session_variables();
        
		// Set the title/data for the page.
		$page_data['top_menu'] = 'Movies';
        $page_data['title'] = 'Search Movies';

        $data['results'] = array();
        $data['search_form_action'] = 'movies/search-results';
        
		$this->load->view('templates/top', $page_data);
        $this->load->view('templates/header', $page_data);
        //$this->load->view('movies/search-page-header', $page_data);
        $this->load->view('movies/search-form', $data);
        $this->load->view('movies/search-instructions');
        $this->load->view('templates/footer');
        
    } // end of - public function search	
	
	
	
    // Display the Movie Search Results.
    public function search_results($persons_name = '') {        
		
		// Make sure that a member is signed in.
		//$this->accesschecks->check_if_member_signed_in();
        
		// Load helpers/libraries/models.
        $this->load->helper('form');
        
		$a_movies = array();
		$a_movies = $this->movies_model->get_movie_search_results($persons_name);		
		
		// Get the data for the my recipes list.
		$data_for_list['movies'] = $a_movies;
		$data_for_list['function_name'] = 'search_results';

		// Create the list to be displayed.
		$movies_list = $this->load->view('movies/_list', $data_for_list, true);	
				
		// Set the title/data for the page.
		$page_data['top_menu'] = 'Movies';
		$page_data['dropdown_menu'] = 'Browse Movies';
        $page_data['title'] = 'Movie Search Results';
		
		$data['title'] = 'Movies <span class="extra-content">(Search Results)</span>';
		//$data['movies'] = $a_movies;
		$data['movies_list'] = $movies_list;
        $data['search_form_action'] = 'movies/search-results';
        
		$this->load->view('templates/top', $page_data);
        $this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
        //$this->load->view('movies/search-page-header', $page_data);
        $this->load->view('movies/search-form', $data);
        //$this->load->view('movies/search-results', $data);    
        $this->load->view('movies/index', $data);
        $this->load->view('templates/footer');
		$this->load->view('more_js/ajax_movies');
        
    } // end of - public function search_results	
	
	

	
	
	
	/**
	 * Search IMDB for a Movie Title.
	 * 	 
	 */
    public function imdb_search() {
        
        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();


		// Load helpers/libraries/models.
		$this->load->helper('form');
		$this->load->library('form_validation');
			


		// Form Validation.
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if (!$this->form_validation->run()) {

			// Set content for the page.
			$page_data['top_menu'] = 'Admin Menu';
			$page_data['dropdown_menu'] = 'Search IMDB';
			$page_data['title'] = 'Search IMDB';
					
			$data['title'] = 'Search IMDB';

			$this->load->view('templates/top', $page_data);
	        $this->load->view('templates/header', $page_data);
	        $this->load->view('movies/imdb-search-form', $data);
	        $this->load->view('templates/footer');

		} else {
			
			// Load helpers/libraries/models.
			$this->load->model('imdb_model');
			
			$title_search = $this->input->post('title');

			// Set content for the page.
			$page_data['title'] = 'IMDB Movie Search Results';
			$data['title'] = 'IMDB Movie Search Results';
			$data['title_search'] = $title_search;
			$data['results'] = $this->imdb_model->search_imdb_movies($title_search);

			$this->load->view('templates/top', $page_data);
	        $this->load->view('templates/header', $page_data);
	        $this->load->view('movies/imdb-search-results', $data);
	        $this->load->view('templates/footer');

		}

    } // end of - function imdb_search		
	
	
	
	
    public function imdb($imdb_id = 0) {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();       
        
        // Load helpers/libraries/models.
        $this->load->model('imdb_model');
        
        if ($imdb_id == 0) {
            $imdb_id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        }
        
        // Get movie data from imdb.
        $results = $this->imdb_model->get_imdb_movie($imdb_id);
        
        $result_status = '';
        
        if (isset($results["Response"])) {
            if ($results["Response"] == "False") {
                $result_status = 'ERROR';
            } else {
                $result_status = 'MOVIE';
            }
        } elseif (isset($results["Search"])) {
            $result_status = 'SEARCH';
        } else {
            $result_status = 'ELSE';
        }        
        
        
        // Set content for the page.
        $page_data['top_menu'] = 'Movies';
        $page_data['title'] = 'IMDB Movies Details';
		
        $data['imdb_id'] = $imdb_id;    
        //$data['results'] = $this->imdb_model->get_imdb_movie($imdb_id);
        $data['results'] = $results;
        $data['result_status'] = $result_status;
        
		$this->load->view('templates/top', $page_data);
        $this->load->view('templates/header', $page_data);
        $this->load->view('movies/imdb-movie', $data);
        $this->load->view('templates/footer');	


    } // end of - function imdb	
	
	
	
	
	
	/**
	 * Display the Movie form with data from IMDB.
	 * @param int $imdb_id	 
	 */
    public function imdb_movie_create($imdb_id = 0) {
        
        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();


		// Load helpers/libraries/models.
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');			
		$this->load->model('imdb_model');
	
	
        if ($imdb_id == 0) {
            $imdb_id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        }
        
        // Get movie data from imdb.
        $results = $this->imdb_model->get_imdb_movie($imdb_id);
        
        $result_status = '';
        
        if (isset($results["Response"])) {
            if ($results["Response"] == "False") {
                $result_status = 'ERROR';
            } else {
                $result_status = 'MOVIE';
            }
        } elseif (isset($results["Search"])) {
            $result_status = 'SEARCH';
        } else {
            $result_status = 'ELSE';
        } 	
		
		
		if ($result_status == 'MOVIE') {
			
		}
		
	
		// Create a new movie.
		$movie = new movies_model();
		$movie->title = $results["Title"];
		$movie->plot = $results["Plot"];
		$movie->genre = $results["Genre"];
		$movie->year_released = $results["Year"];
		$movie->runtime = $results["Runtime"];
		$movie->mpaa_rating = $results["Rated"];
		$movie->overall_rating =  $results['imdbRating'];
		$movie->starring = $results["Actors"];
		$movie->directed_by =  $results["Director"];
		$movie->written_by = $results["Writer"];		
		$movie->imdb_image_url = $results['Poster'];
		$movie->imdb_id = $results['imdbID'];		
				

		// Create the list of items for the genre checkboxes.
        $genre_options = array(  
            'Action' => 'Action', 
            'Adventure' => 'Adventure', 
            'Animation' => 'Animation',                 
            'Anime' => 'Anime', 
            'Children' => 'Children', 
            'Comedy' => 'Comedy', 
            'Crime' => 'Crime', 
            'Drama' => 'Drama', 
            'Documentary' => 'Documentary', 
            'Family' => 'Family', 
            'Fantasy' => 'Fantasy', 
            'Horror' => 'Horror', 
            'Music' => 'Music', 
            'Musical' => 'Musical', 
            'Mystery' => 'Mystery', 
            'Romance' => 'Romance', 
            'Sci Fi' => 'Sci Fi', 
            'Sports' => 'Sports', 
            'Television' => 'Television',  
			'Thriller' => 'Thriller',                                
            'Other' => 'Other'
        );	


        // Create the list of items for the drop down.
        $mpaa_rating_options = array(  
            '' => '--MPAA Rating--',
            'G' => 'G', 
            'PG' => 'PG', 
            'PG-13' => 'PG-13',                 
            'R' => 'R', 
            'NC-17' => 'NC-17', 
            'NR' => 'NR'
        );

		// Set the title for the page.
		$page_data['top_menu'] = 'Movies';
		$page_data['title'] = 'Add Movie based on IMDB Data';
		
		// Set content for the page.		
		$data['title'] = 'Add Movie based on IMDB Data';
		$data['form_action'] = 'movies/add';
		$data['movie'] = $movie;
		$data['genre_options'] = $genre_options;
		$data['mpaa_rating_options'] = $mpaa_rating_options;

		$this->load->view('templates/top', $page_data);
        $this->load->view('templates/header', $page_data);
        $this->load->view('movies/form', $data);
        $this->load->view('templates/footer');

    } // end of - function imdb_movie_create		
	
	
	
	
	
	/**
	 * Display details about this section of the website.
	 */
	public function about() {

		// Set the title for the page.
		$page_data['top_menu'] = 'Movies';
		$page_data['dropdown_menu'] = 'About Movies';
		$page_data['title'] = 'About The Movies Section';
		
		// Set content for the page.
		$data['title'] = 'About The Movies Section';
		
		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('movies/about', $data);
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
	
		// Clear search criteria session variables.
		$this->movies_model->clear_search_session_variables();	
	
		// Load helpers/libraries/models.
		$this->load->helper('form');
		$this->load->helper('date');
		

		// $a_movies = array();
		// $a_movies = $this->movies_model->get_movies();
		
		$limit = 20;
		$a_movies = array();
		$a_movies = $this->movies_model->get_movies($limit);	
		
					
		// SPECIAL CODE.
		// ******************************************************************
		// Download all movie images from imdb if there is no image already.
		///$this->movies_model->upload_images_from_imdb();	
		// ******************************************************************
		

		// Get the data for the my recipes list.
		$data_for_list['movies'] = $a_movies;

		// Create the list to be displayed.
		$movies_list = $this->load->view('movies/_admin_list', $data_for_list, true);		


		// Set the title/data for the page.
		$page_data['top_menu'] = 'Admin Menu';
		$page_data['dropdown_menu'] = 'Movies';
		$page_data['title'] = 'Movies';
		
		$data['title'] = 'Admin Movie List <span class="extra-content">(Last 20 Added)</span>';
		//$data['movies'] = $a_movies;
		$data['movies_list'] = $movies_list;
        $data['search_form_action'] = 'movies/admin-search-results';

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('movies/search-form', $data);
		$this->load->view('movies/index', $data);
		$this->load->view('templates/footer');

	} // end of - function admin_list	
	
	
	
	
	/**
	 * Display the Search Form.
	 */    
    // public function admin_search() {
//         
        // // Make sure that the member is an Admin before displaying this page.
    	// $this->accesschecks->check_if_member_is_admin();
//         
		// // Load helpers/libraries/models.
        // $this->load->helper('form');
// 
        // // Clear search session variables.
        // $this->movies_model->clear_search_session_variables();
//         
		// // Set the title/data for the page.
        // $page_data['title'] = 'Search Movies';
        // $data['results'] = array();
        // $data['search_form_action'] = 'movies/admin-search-results';
//         
		// $this->load->view('templates/top', $page_data);
        // $this->load->view('templates/header', $page_data);
        // //$this->load->view('movies/search-page-header', $page_data);
        // $this->load->view('movies/search-form', $data);
        // $this->load->view('movies/search-instructions');      
        // $this->load->view('templates/footer');
//         
    // } // end of - public function admin_search	
	
	
	
    // Display the Movie Search Results.
    public function admin_search_results() {
        
        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();
        
		// Load helpers/libraries/models.
        $this->load->helper('form');
        
		$a_movies = array();
		$a_movies = $this->movies_model->get_movie_search_results();		
		
		// Get the data for the my recipes list.
		$data_for_list['movies'] = $a_movies;

		// Create the list to be displayed.
		//$movies_list = $this->load->view('movies/_list', $data_for_list, true);	
		$movies_list = $this->load->view('movies/_admin_list', $data_for_list, true);
				
		// Set the title/data for the page.
		$page_data['top_menu'] = 'Admin Menu';
		$page_data['dropdown_menu'] = 'Movies';
        $page_data['title'] = 'Movie Search Results';
		
		$data['title'] = 'Movies <span class="extra-content">(Search Results)</span>';
		//$data['movies'] = $a_movies;
		$data['movies_list'] = $movies_list;
        $data['search_form_action'] = 'movies/admin-search-results';
        
		$this->load->view('templates/top', $page_data);
        $this->load->view('templates/header', $page_data);
        //$this->load->view('movies/search-page-header', $page_data);
        $this->load->view('movies/search-form', $data);
        //$this->load->view('movies/search-results', $data);    
        $this->load->view('movies/index', $data);  
        $this->load->view('templates/footer');
        
    } // end of - public function admin_search_results		
	
	
	
	
	
	/**
	 * Delete a record.
	 * @param int $id
	 */
	public function delete($id) {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();

    	
		$movie = new movies_model();
		$movie->load($id);
		if (!$movie->id) {
			//show_404();

			// Set message data and redirect to display the list of publications.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'Movie Not Found.  No data was deleted.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('movies/admin-list', 'refresh');
		}

		$movie->delete($id);
		
		
		// If a movie is being deleted then all member_movies records associated with the movie needs to be deleted as well.
		$this->load->model('member_movies_model');
		
		$this->member_movies_model->delete_records_based_on_movie_id($id);
		

		// Set message data and redirect to display the list of publications.
		$this->session->set_flashdata('message_class', 'alert-success');
		$this->session->set_flashdata('message', 'Movie \'' . html_escape($movie->title) . '\' was Deleted!!!');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		redirect('movies/admin-list', 'refresh');

	} // end of - function delete	
		
	
	
	
	
	// ***********************************************************************************************
	// START OF - AJAX FUNCTIONS
	// ***********************************************************************************************
	
	
	/**
	 * Toggle the value of the featured field.
	 * Meaning if it is yes change it to no and vise versa.
	 * @param int $id
	 */
	public function toggle_featured($id) {
		
        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();
		
		$movie = new movies_model();
		$movie->load($id);
		if (!$movie->id) {
			echo 'not found';
			return 'not found';
		}
		
		
		// Set default values.
		$datetime = date('Y-m-d H:i:s', time());
		
		if ($movie->featured == 'yes') {
			$movie->featured = 'no';
		} else {
			$movie->featured = 'yes';
		}		
		$movie->updated_at = $datetime;

		$movie->save();
		
		echo $movie->featured;
		return $movie->featured;

	} // end of - function toggle_featured	
	
	
} // end of - class

/* End of file movies.php */
/* Location: ./application/controllers/movies.php */	