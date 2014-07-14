<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Member_movies extends CI_Controller {


	public function __construct() {

		parent::__construct();
		
		$this->load->model('member_movies_model');
		
	} // end of - function __construct
	
	
	
	
	
	
	/**
	 * Add a record.
	 */
	public function add() {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();


		// Load helers/libraries/models.
		$this->load->helper('date');
		$this->load->helper('form');
		$this->load->library('form_validation');


		// Form Validation.
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('plot', 'Plot', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');



		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {		
			
			// Set the title/data for the page.
			$page_data['top_menu'] = 'Admin Menu';
			$page_data['dropdown_menu'] = 'Add A Movie';
			$page_data['title'] = 'Add A Movie';
			
			$data['title'] = 'Add A Movie';
			$data['form_action'] = 'movies/add';

			$this->load->view('templates/top', $page_data);
			$this->load->view('templates/header', $page_data);
			$this->load->view('movies/form', $data);
			$this->load->view('templates/footer');

		} else {

			// Set default values.
			$member_id = $this->session->userdata('member_id');
			$movie_id = 0;
			$index_number = null;
			$review_rating = 0.0;
			$review_text = '';
			$on_watch_list = 'no';
			$seen_it = 'no';
			$own_it = 'no';
			$burned_it = 'no';
			$backed_up = 'no';
			$downloaded_it = 'no';
			$in_collection = 'no';
			$in_720 = 'no';
			$in_1080 = 'no';
			$in_3d = 'no';
			$datetime = date('Y-m-d H:i:s', time());

			// Save data.
			$member_movie = new member_movies_model();
			$member_movie->member_id = $member_id;
			$member_movie->movie_id = $movie_id;
			$member_movie->index_number = $index_number;
			$member_movie->$review_rating = $review_rating;
			$member_movie->$review_text = $review_text;
			$member_movie->on_watch_list = $on_watch_list;
			$member_movie->seen_it = $seen_it;
			$member_movie->own_it = $own_it;
			$member_movie->burned_it = $burned_it;
			$member_movie->backed_up = $backed_up;
			$member_movie->downloaded_it = $downloaded_it;
			$member_movie->in_collection = $in_collection;
			$member_movie->in_720 = $in_720;
			$member_movie->in_1080 = $in_1080;
			$member_movie->in_3d = $in_3d;
			$member_movie->created_at = $datetime;
			$member_movie->updated_at = $datetime;

			$member_movie->save();


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


		// Load helers/libraries/models.
		$this->load->helper('date');
		$this->load->helper('form');
		$this->load->library('form_validation');


		// Form Validation.
		$this->form_validation->set_rules('id', 'Movie ID', 'required');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('plot', 'plot', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		// Load the record.
		$movie = new movies_model();
		$movie->load($id);
		if (!$movie->id) {
			show_404();
		}	


		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Set the title for the page.
			$page_data['top_menu'] = 'Admin Menu';
			$page_data['title'] = 'Edit Movie Details';
			
			// Set content for the page.		
			$data['title'] = 'Edit Movie Details';
			$data['form_action'] = 'movies/edit/' . $id . '';
			$data['movie'] = $movie;

			$this->load->view('templates/top', $page_data);
	        $this->load->view('templates/header', $page_data);
	        $this->load->view('movies/form', $data);
	        $this->load->view('templates/footer');

		} else {

			// Set default values.
			$datetime = date('Y-m-d H:i:s', time());

			// Set default values.
			$member_id = $this->session->userdata('member_id');
			$movie_id = 0;
			$index_number = null;
			$review_rating = 0.0;
			$review_text = '';
			$on_watch_list = 'no';
			$seen_it = 'no';
			$own_it = 'no';
			$burned_it = 'no';
			$backed_up = 'no';
			$downloaded_it = 'no';
			$in_collection = 'no';
			$in_720 = 'no';
			$in_1080 = 'no';
			$in_3d = 'no';
			$datetime = date('Y-m-d H:i:s', time());

			// Save data.
			$member_movie = new member_movies_model();
			$member_movie->index_number = $index_number;
			$member_movie->$review_rating = $review_rating;
			$member_movie->$review_text = $review_text;
			$member_movie->on_watch_list = $on_watch_list;
			$member_movie->seen_it = $seen_it;
			$member_movie->own_it = $own_it;
			$member_movie->burned_it = $burned_it;
			$member_movie->backed_up = $backed_up;
			$member_movie->downloaded_it = $downloaded_it;
			$member_movie->in_collection = $in_collection;
			$member_movie->in_720 = $in_720;
			$member_movie->in_1080 = $in_1080;
			$member_movie->in_3d = $in_3d;
			$member_movie->updated_at = $datetime;

			$member_movie->save();

			// Set message data and redirect to display the magazine.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'The Movie \'' . html_escape($movie->title) . '\' was Successfully Updated!!!');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('movies/view/' . $id, 'refresh');

		}

    } // end of - function edit		







    /**
     * Edit a member_movie rating.
     * @param int $id
     */
    public function edit_rating($id) {

        // Make sure that a member is signed in.
        $this->accesschecks->check_if_member_signed_in();

        // Load helers/libraries/models.
        $this->load->helper('date');
        $this->load->helper('form');


        // Get form values.
        $movie_id = $this->input->post('id');
        $member_movie_id = $this->input->post('member_movie_id');
        $review_rating = $this->input->post('review_rating');
        $review_text = $this->input->post('review_text');


        // Try to load the member_movie model based on the member_movie_id.
        $member_movie = new member_movies_model();
        $member_movie->load($member_movie_id);
        if (!$member_movie->id) {

            // Try loading the member_movies record by member_id and movie_id.
            $member_id = $this->session->userdata('member_id');
            $member_movie->load_using_member_id_and_movie_id($member_id, $movie_id);

            if (!$member_movie->id) {

                // Create a new member_movies record for the selected movie and signed in member.
                $member_movie_id = $this->simple_add($movie_id);

                // Try loading the member_movie record again.
                $member_movie->load($member_movie_id);
                if (!$member_movie->id) {
                    echo 'not found';
                    return 'not found';
                }

            }
        }


        // Set default values.
        $datetime = date('Y-m-d H:i:s', time());

        $member_movie->review_rating = $review_rating;
        $member_movie->review_text = $review_text;
        $member_movie->updated_at = $datetime;

        $member_movie->save();

        // Set message data and redirect to display the magazine.
        $this->session->set_flashdata('message_class', 'alert-success');
        $this->session->set_flashdata('message', 'Your Rating and/or Review for this Movie was Successfully Updated!!!');

        // Redirect instead of loading views to prevent a refresh from running the code again.
        redirect('movies/view/' . $movie_id, 'refresh');

    } // end of - function edit_rating







	/**
	 * Add a record.
	 */
	public function simple_add($movie_id) {

		// Load helers/libraries/models.
		$this->load->helper('date');


		// Set default values.
		$member_id = $this->session->userdata('member_id');
		$movie_id = $movie_id;
		$datetime = date('Y-m-d H:i:s', time());

		// Save data.
		$member_movie = new member_movies_model();
		$member_movie->member_id = $member_id;
		$member_movie->movie_id = $movie_id;
		$member_movie->created_at = $datetime;
		$member_movie->updated_at = $datetime;

		$member_movie->save();
		
		// Return the member_movie id.
		return $member_movie->id;

	} // end of - function simple_add		
	
	
	
	
	/**
	 * Toggle the value of the on_watch_list field.
	 * Meaning if it is yes change it to no and vise versa.
	 * @param int $id
	 */
	public function toggle_on_watch_list($id) {
		
 		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();
		
		// The value $id can contain the movie id as well as the member_movie_id.
		$a_ids = explode('-', $id);
		$movie_id = $a_ids[0];
		$member_movie_id = $a_ids[1];
		
		
		$member_movie = new member_movies_model();
		$member_movie->load($member_movie_id);
		if (!$member_movie->id) {
			
			// Try loading the member_movies record by member_id and movie_id.
			$member_id = $this->session->userdata('member_id');
			$member_movie->load_using_member_id_and_movie_id($member_id, $movie_id);
			
			if (!$member_movie->id) {
			
				// Create a new member_movies record for the selected movie and signed in member.
				$member_movie_id = $this->simple_add($movie_id);
				
				// Try loading the member_movie record again.
				$member_movie->load($member_movie_id);
				if (!$member_movie->id) {
					echo 'not found';
					return 'not found';
				}		
				
			}	
		}


		// Set default values.
		$datetime = date('Y-m-d H:i:s', time());

		if ($member_movie->on_watch_list == 'yes') {
			$member_movie->on_watch_list = 'no';
		} else {
			$member_movie->on_watch_list = 'yes';
		}
		$member_movie->updated_at = $datetime;

		$member_movie->save();

		echo $member_movie->on_watch_list;
		return $member_movie->on_watch_list;

	} // end of - function toggle_on_watch_list		
	
	
	
	/**
	 * Toggle the value of the seen_it field.
	 * Meaning if it is yes change it to no and vise versa.
	 * @param int $id
	 */
	public function toggle_seen_it($id) {
		
		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();
		
		// The value $id can contain the movie id as well as the member_movie_id.
		$a_ids = explode('-', $id);
		$movie_id = $a_ids[0];
		$member_movie_id = $a_ids[1];
		
		
		$member_movie = new member_movies_model();
		$member_movie->load($member_movie_id);
		if (!$member_movie->id) {
			
			// Try loading the member_movies record by member_id and movie_id.
			$member_id = $this->session->userdata('member_id');
			$member_movie->load_using_member_id_and_movie_id($member_id, $movie_id);
			
			if (!$member_movie->id) {
			
				// Create a new member_movies record for the selected movie and signed in member.
				$member_movie_id = $this->simple_add($movie_id);
				
				// Try loading the member_movie record again.
				$member_movie->load($member_movie_id);
				if (!$member_movie->id) {
					echo 'not found';
					return 'not found';
				}		
				
			}	
		}
		
		
		// Set default values.
		$datetime = date('Y-m-d H:i:s', time());
		
		if ($member_movie->seen_it == 'yes') {
			$member_movie->seen_it = 'no';
		} else {
			$member_movie->seen_it = 'yes';
		}		
		$member_movie->updated_at = $datetime;

		$member_movie->save();
		
		echo $member_movie->seen_it;
		return $member_movie->seen_it;

	} // end of - function toggle_seen_it		
	
	
	
	
	/**
	 * Toggle the value of the in_720 field.
	 * Meaning if it is yes change it to no and vise versa.
	 * @param int $id
	 */
	public function toggle_in_720($id) {
		
		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();
		
		// The value $id can contain the movie id as well as the member_movie_id.
		$a_ids = explode('-', $id);
		$movie_id = $a_ids[0];
		$member_movie_id = $a_ids[1];
		
		
		$member_movie = new member_movies_model();
		$member_movie->load($member_movie_id);
		if (!$member_movie->id) {
			
			// Try loading the member_movies record by member_id and movie_id.
			$member_id = $this->session->userdata('member_id');
			$member_movie->load_using_member_id_and_movie_id($member_id, $movie_id);
			
			if (!$member_movie->id) {
			
				// Create a new member_movies record for the selected movie and signed in member.
				$member_movie_id = $this->simple_add($movie_id);
				
				// Try loading the member_movie record again.
				$member_movie->load($member_movie_id);
				if (!$member_movie->id) {
					echo 'not found';
					return 'not found';
				}		
				
			}	
		}
		
		
		// Set default values.
		$datetime = date('Y-m-d H:i:s', time());
		
		if ($member_movie->in_720 == 'yes') {
			$member_movie->in_720 = 'no';
		} else {
			$member_movie->in_720 = 'yes';
		}		
		$member_movie->updated_at = $datetime;

		$member_movie->save();
		
		echo $member_movie->in_720;
		return $member_movie->in_720;

	} // end of - function toggle_in_720		
	
	
	/**
	 * Toggle the value of the in_1080 field.
	 * Meaning if it is yes change it to no and vise versa.
	 * @param int $id
	 */
	public function toggle_in_1080($id) {
		
		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();
		
		// The value $id can contain the movie id as well as the member_movie_id.
		$a_ids = explode('-', $id);
		$movie_id = $a_ids[0];
		$member_movie_id = $a_ids[1];
		
		
		$member_movie = new member_movies_model();
		$member_movie->load($member_movie_id);
		if (!$member_movie->id) {
			
			// Try loading the member_movies record by member_id and movie_id.
			$member_id = $this->session->userdata('member_id');
			$member_movie->load_using_member_id_and_movie_id($member_id, $movie_id);
			
			if (!$member_movie->id) {
			
				// Create a new member_movies record for the selected movie and signed in member.
				$member_movie_id = $this->simple_add($movie_id);
				
				// Try loading the member_movie record again.
				$member_movie->load($member_movie_id);
				if (!$member_movie->id) {
					echo 'not found';
					return 'not found';
				}		
				
			}	
		}
		
		
		// Set default values.
		$datetime = date('Y-m-d H:i:s', time());
		
		if ($member_movie->in_1080 == 'yes') {
			$member_movie->in_1080 = 'no';
		} else {
			$member_movie->in_1080 = 'yes';
		}		
		$member_movie->updated_at = $datetime;

		$member_movie->save();
		
		echo $member_movie->in_1080;
		return $member_movie->in_1080;

	} // end of - function toggle_in_1080
	
	
	/**
	 * Toggle the value of the in_3d field.
	 * Meaning if it is yes change it to no and vise versa.
	 * @param int $id
	 */
	public function toggle_in_3d($id) {
		
		// Make sure that a member is signed in.
		$this->accesschecks->check_if_member_signed_in();
		
		// The value $id can contain the movie id as well as the member_movie_id.
		$a_ids = explode('-', $id);
		$movie_id = $a_ids[0];
		$member_movie_id = $a_ids[1];
		
		
		$member_movie = new member_movies_model();
		$member_movie->load($member_movie_id);
		if (!$member_movie->id) {
			
			// Try loading the member_movies record by member_id and movie_id.
			$member_id = $this->session->userdata('member_id');
			$member_movie->load_using_member_id_and_movie_id($member_id, $movie_id);
			
			if (!$member_movie->id) {
			
				// Create a new member_movies record for the selected movie and signed in member.
				$member_movie_id = $this->simple_add($movie_id);
				
				// Try loading the member_movie record again.
				$member_movie->load($member_movie_id);
				if (!$member_movie->id) {
					echo 'not found';
					return 'not found';
				}		
				
			}	
		}
		
		
		// Set default values.
		$datetime = date('Y-m-d H:i:s', time());
		
		if ($member_movie->in_3d == 'yes') {
			$member_movie->in_3d = 'no';
		} else {
			$member_movie->in_3d = 'yes';
		}		
		$member_movie->updated_at = $datetime;

		$member_movie->save();
		
		echo $member_movie->in_3d;
		return $member_movie->in_3d;

	} // end of - function toggle_in_3d		
	
	
} // end of - class

/* End of file member_movies.php */
/* Location: ./application/controllers/member_movies.php */		