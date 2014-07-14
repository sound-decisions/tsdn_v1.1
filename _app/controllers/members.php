<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Members extends CI_Controller {


	public function __construct() {

		parent::__construct();
		
		$this->load->model('members_model');
		
	} // end of - function __construct



	/**
	 * List records.
	 */
	public function index() {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();

		// Load helers/libraries/models.
		$this->load->helper('form');
		$this->load->helper('date');

		$limit = 10;
		$a_members = array();
		$a_members = $this->members_model->get_members($limit);	
		
		// Get the data for the list.
		$data_for_list['members'] = $a_members;		
		
		// Create the list view code.
		//$members_list = $this->load->view('members/_detailed_list', $data_for_list, true);
		$members_list = $this->load->view('members/_simple_list', $data_for_list, true);

		// Create the options list(s) for the search form.
        $status_options = array(  
            '' => '--Status--',
            'active' => 'Active', 
            'inactive' => 'Inactive'
        );		
		
        $access_options = array(  
            '' => '--Access--',
            'normal' => 'Normal', 
            'admin' => 'Admin'
        );		


		// Set the title for the page.
		$page_data['top_menu'] = 'Admin Menu';
		$page_data['dropdown_menu'] = 'Member List';
		$page_data['title'] = 'Members';
		
		$data['title'] = 'Members <span class="extra-content">(Last ' . $limit . ' Added)</span>';	
		$data['form_action'] = 'members/search-results';
		$data['status_options'] = $status_options;
		$data['access_options'] = $access_options;
		//$data['members'] = $a_members;
		$data['members_list'] = $members_list;

		$this->load->view('templates/top', $data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('members/search-form', $data);
		$this->load->view('members/index', $data);
		$this->load->view('templates/footer');
		$this->load->view('more_js/ekko_lightbox');

	} // end of - function index



	/**
	 * View a record.
	 */
	public function view($id) {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();

		// Load helers/libraries/models.
		$this->load->helper('date');

		$member = new members_model();
		$member->load($id);
		if (!$member->id) {
			//show_404();

			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'Member Not Found.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('members', 'refresh');	

		}

		// Set the title for the page.
		$page_data['title'] = 'Member Details';
		// Set content for the page.
		$data['title'] = 'Member Details';
		$data['member'] = $member;	

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('members/view', $data);
		$this->load->view('templates/footer');

	} // end of - function view



	/**
	 * Add a record.
	 */
	public function add() {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();

		// Load helers/libraries/models.
		$this->load->helper('security');
		$this->load->helper('form');
		$this->load->library('form_validation');


		// // START OF - Check for SPAM.
		// // This field should be empty.
		// if ($this->input->post('email_address') != '') {
		// 	redirect('spam_detected', 'refresh');
		// }
		// // END OF - Check for SPAM.

		
		// // START OF - Check for SPAM.
		// $this->load->helper('spam_check');
		// $lt = $this->input->post('lt');
		// encrypted_spam_check($lt);
	 //    // END OF - Check for SPAM.


		// Form Validation.
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[members.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required');
		//$this->form_validation->set_rules('city', 'City', 'required');
		//$this->form_validation->set_rules('province', 'Province/State', 'required');
		//$this->form_validation->set_rules('country', 'Country', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		// Set a custom error message for the uniqueness of the email address which is used to sign in.
		$this->form_validation->set_message('is_unique', 'The %s entered is already being used.  If this is your email address then you have already signed up.  Sign In instead.');



		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Set the title for the page.			
			$data['title'] = 'Add Member';

			$this->load->view('templates/top', $data);
			$this->load->view('templates/header', $data);
			$this->load->view('members/form', $data);
			$this->load->view('templates/footer');

		} else {

			// Encrypt the password.
			$encrypted_password = do_hash($this->input->post('password'), 'md5');

			// Set default values.
			$current_datetime = date('Y-m-d H:i:s', time());

			$city = '';
			$province = '';
			$country = '';
			$gender = '';
			$date_of_birth = '';
			$profile_photo = time() . '_' . DEFAULT_PROFILE_PHOTO;
			$profile_photo_tn = time() . '_' .  DEFAULT_PROFILE_PHOTO_TN;
			$email_confirmed = 'no';
			$sign_in_count = 0;
			$current_sign_in_at = '';
			$last_sign_in_at = '';
			$display = 'yes';
			$featured = 'no';
			$status = 'active';
			$access = 'normal';
			$membership_level = 'Free Membership';
			$role = 'member';

			// Save data.
			$member = new members_model();
			$member->first_name = $this->input->post('first_name');
			$member->last_name = $this->input->post('last_name');
			$member->email = $this->input->post('email');
			$member->password = $this->input->post('password');

			$member->encrypted_password = $encrypted_password;

			// Default values (for now anyway)
			$member->city = $city;
			$member->province = $province;
			$member->country = $country;
			$member->gender = $gender;
			$member->date_of_birth = $date_of_birth;
			$member->profile_photo = $profile_photo;
			$member->profile_photo_tn = $profile_photo_tn;
			$member->email_confirmed = $email_confirmed;
			$member->sign_in_count = $sign_in_count;
			$member->current_sign_in_at = $current_sign_in_at;
			$member->last_sign_in_at = $last_sign_in_at;
			$member->display = $display;
			$member->featured = $featured;
			$member->status = $status;
			$member->access = $access;
			$member->membership_level = $membership_level;
			$member->role = $role;
			$member->created_at = $current_datetime;
			$member->updated_at = $current_datetime;

			$member->save();


			// Copy the default profile photo.
			if (!copy(MEMBER_PHOTOS_PATH . DEFAULT_PROFILE_PHOTO, MEMBER_PHOTOS_PATH . $profile_photo)) {
			    //echo "failed to copy $file...\n";
			}		
			if (!copy(MEMBER_PHOTOS_PATH . DEFAULT_PROFILE_PHOTO_TN, MEMBER_PHOTOS_PATH . $profile_photo_tn)) {
			    //echo "failed to copy $file...\n";
			}				


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'Member ' . html_escape($member->first_name) . ' ' . html_escape($member->last_name) . ' has been successfully added.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('members', 'refresh');		

		}

	} // end of - function add	



	/**
	 * Edit a record.
	 */
	public function edit($id) {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();


		// Load helers/libraries/models.
		$this->load->helper('security');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');


		// Form Validation.
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required');

		//$this->form_validation->set_rules('city', 'City', 'required');
		//$this->form_validation->set_rules('province', 'Province/State', 'required');
		//$this->form_validation->set_rules('country', 'Country', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');



		// Image Upload Validation.
		$check_file_upload = FALSE;
		if (isset($_FILES['profile_photo']['error']) && $_FILES['profile_photo']['error'] != 4) {
			$check_file_upload = TRUE;

			// Make sure the image name being uploaded will be unique.
			$current_file_name = $_FILES['profile_photo']['name'];

			// If the file name has any spaces in it an error will occur so check it before continuing.
			if (strpos($current_file_name, ' ')) {

				// Set message data and redirect to display the new item.
				$this->session->set_flashdata('message_class', 'alert-danger');
				$this->session->set_flashdata('message', 'The image file selected has at least one space in the file name.  Please remove or replace the spaces and try again.');

				// Redirect instead of loading views to prevent a refresh from running the code again.
				redirect('members/edit_profile', 'refresh');

			}


			$new_file_name = time() . '_' . $current_file_name;
			$tn_file_name = time() . '_tn_' . $current_file_name;

			// For Image Uploads.
			$config = array (
				//'upload_path' => 'uploads/issue_covers/', 
				'upload_path' => MEMBER_PHOTOS_PATH, 
				'allowed_types' => 'gif|jpg|png', 
				'file_name' => $new_file_name, 
				'max_size' => 2048, 
				'max_width' => 1920, 
				'max_height' => 1080,
			);

			$this->upload->initialize($config);
		}



		// if ($this->form_validation->run() === FALSE) {
		//if (!$this->form_validation->run()) {
		if (!$this->form_validation->run() || ($check_file_upload && !$this->upload->do_upload('profile_photo'))) {

			$member = new members_model();
			$member->load($id);
			if (!$member->id) {
				//show_404();

				// Set message data and redirect to display the new item.
				$this->session->set_flashdata('message_class', 'alert-danger');
				$this->session->set_flashdata('message', 'Member Not Found - OR - Profile Photo Not Uploaded.');

				// Redirect instead of loading views to prevent a refresh from running the code again.
				redirect('members', 'refresh');	

			}

			// Set the title for the page.			
			$page_data['title'] = 'Edit Member Details';
			$data['title'] = 'Edit Member Details';
			$data['member'] = $member;

			$this->load->view('templates/top', $page_data);
			$this->load->view('templates/header', $page_data);
			$this->load->view('members/form', $data);
			$this->load->view('templates/footer');

		} else {

			// Encrypt the password.
			$encrypted_password = do_hash($this->input->post('password'), 'md5');

			// Set default values.
			$current_datetime = date('Y-m-d H:i:s', time());
			

			// Save data.
			$member = new members_model();
			//$member->load($this->session->userdata('member_id'));
			$member->load($this->input->post('id'));

			$member->first_name = $this->input->post('first_name');
			$member->last_name = $this->input->post('last_name');
			$member->email = $this->input->post('email');
			$member->password = $this->input->post('password');
			
			$member->encrypted_password = $encrypted_password;

			// $member->city = $this->input->post('city');
			// $member->province = $this->input->post('province');
			// $member->country = $this->input->post('country');
			// $member->gender = $this->input->post('gender');
			// $member->date_of_birth = $this->input->post('date_of_birth');
			// $member->profile_photo = $this->input->post('profile_photo');
			// $member->profile_photo_tn = $this->input->post('profile_photo_tn');
			// $member->email_confirmed = $this->input->post('email_confirmed');
			// $member->sign_in_count = $this->input->post('sign_in_count');
			// $member->current_sign_in_at = $this->input->post('current_sign_in_at');
			// $member->last_sign_in_at = $this->input->post('last_sign_in_at');
			// $member->display = $this->input->post('display');
			// $member->featured = $this->input->post('featured');
			// $member->status = $this->input->post('status');
			// $member->access = $this->input->post('access');
			// $member->membership_level = $this->input->post('membership_level');
			// $member->created_at = $this->input->post('created_at');


			$current_profile_photo = $this->input->post('current_profile_photo');
			$current_profile_photo_tn = $this->input->post('current_profile_photo_tn');			


			// Deal with the Uploaded Image.
			if ($check_file_upload) {
				$upload_data = $this->upload->data();
				if (isset($upload_data['file_name'])) {
					$member->profile_photo = $upload_data['file_name'];
					$member->profile_photo_tn = $tn_file_name;

					// Create a thumbnail of the uploaded image.
					$this->load->library('Imagetransform');

					$main_file = MEMBER_PHOTOS_PATH . $new_file_name;
					$tn_file = MEMBER_PHOTOS_PATH . $tn_file_name;

					$this->imagetransform->resize($main_file, 500, 500, $main_file);
					$this->imagetransform->crop($main_file, 100, 100, $tn_file);

					// Delete the replaced image files if they exist.
					if (($current_profile_photo != '') && (file_exists(MEMBER_PHOTOS_PATH . $current_profile_photo))) {
						unlink(MEMBER_PHOTOS_PATH . $current_profile_photo);
					}
					//if ($current_profile_photo_tn != '') {
					if (($current_profile_photo_tn != '') && (file_exists(MEMBER_PHOTOS_PATH . $current_profile_photo_tn))) {
						unlink(MEMBER_PHOTOS_PATH . $current_profile_photo_tn);
					}					
					
				}
			} else {
				// $member->profile_photo = $current_profile_photo;
				// $member->profile_photo_tn = $current_profile_photo_tn;
			}


			// Set the updated_at valule.
			$member->updated_at = $current_datetime;

			// Save the data to DB.
			$member->save();


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'Member \'' . html_escape($member->first_name . ' ' . $member->last_name) . '\' Updated!!!');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('members/view/' . $id . '', 'refresh');			

		}

	} // end of - function edit	




	/**
	 * Delete a record.
	 * @param int $id
	 */
	public function delete($id) {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();

		$member = new members_model();
		$member->load($id);
		if (!$member->id) {
			//show_404();

			// Set message data and redirect to display the list of publications.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'Profile not found.  No data was deleted.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('members/profile', 'refresh');			
		}


		// Delete image files if they exist.
		if ($member->profile_photo != '') {
			unlink(MEMBER_PHOTOS_PATH . $member->profile_photo);
		}
		if ($member->profile_photo_tn != '') {
			unlink(MEMBER_PHOTOS_PATH . $member->profile_photo_tn);
		}


		$member->delete($id);


		// Set message data and redirect to display the list of publications.
		$this->session->set_flashdata('message_class', 'alert-success');
		//$this->session->set_flashdata('message', 'Your Profile has been deleted ' . html_escape($member->first_name) . '.  We are sad to see you go.');
		$this->session->set_flashdata('message', 'Member ' . html_escape($member->first_name) . ' ' . html_escape($member->last_name) . ' has been deleted.');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		redirect('members', 'refresh');

	} // end of - function delete	





	/* Custom Functions */


	/**
	 * Member Sign Up Functionality.
	 */
	public function sign_up() {

		// Load helers/libraries/models.
		$this->load->helper('security');
		$this->load->helper('form');
		$this->load->library('form_validation');


		// START OF - Check for SPAM.
		// This field should be empty.
		if ($this->input->post('email_address') != '') {
			redirect('spam_detected', 'refresh');
		}
		// END OF - Check for SPAM.

		
		// START OF - Check for SPAM.
		$this->load->helper('spam_check');
		$lt = $this->input->post('lt');
		encrypted_spam_check($lt);
	    // END OF - Check for SPAM.


		// Form Validation.
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[members.email]|matches[email_confirm]');
		$this->form_validation->set_rules('email_confirm', 'Confirm Email Address', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required');
		//$this->form_validation->set_rules('city', 'City', 'required');
		//$this->form_validation->set_rules('province', 'Province/State', 'required');
		//$this->form_validation->set_rules('country', 'Country', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		// Set a custom error message for the uniqueness of the email address which is used to sign in.
		$this->form_validation->set_message('is_unique', 'The %s entered is already being used.  If this is your email address then you have already signed up.  Sign In instead.');



		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Set the title for the page.			
			$data['title'] = 'Sign Up';

			$this->load->view('templates/top', $data);
			$this->load->view('templates/header', $data);
			$this->load->view('members/sign-up', $data);
			$this->load->view('templates/footer');

		} else {

			// Encrypt the password.
			$encrypted_password = do_hash($this->input->post('password'), 'md5');

			// Set default values.
			$current_datetime = date('Y-m-d H:i:s', time());

			$city = '';
			$province = '';
			$country = '';
			$gender = '';
			$date_of_birth = '';
			$profile_photo = time() . '_' . DEFAULT_PROFILE_PHOTO;
			$profile_photo_tn = time() . '_' .  DEFAULT_PROFILE_PHOTO_TN;
			$email_confirmed = 'no';
			$sign_in_count = 0;
			$current_sign_in_at = '';
			$last_sign_in_at = '';
			$display = 'yes';
			$featured = 'no';
			$status = 'active';
			$access = 'normal';
			$membership_level = 'Free Membership';
			$role = 'member';
			

			// Save data.
			$member = new members_model();
			$member->first_name = $this->input->post('first_name');
			$member->last_name = $this->input->post('last_name');
			$member->email = $this->input->post('email');
			$member->password = $this->input->post('password');

			$member->encrypted_password = $encrypted_password;

			// Default values (for now anyway)
			$member->city = $city;
			$member->province = $province;
			$member->country = $country;
			$member->gender = $gender;
			$member->date_of_birth = $date_of_birth;
			$member->profile_photo = $profile_photo;
			$member->profile_photo_tn = $profile_photo_tn;
			$member->email_confirmed = $email_confirmed;
			$member->sign_in_count = $sign_in_count;
			$member->current_sign_in_at = $current_sign_in_at;
			$member->last_sign_in_at = $last_sign_in_at;
			$member->display = $display;
			$member->featured = $featured;
			$member->status = $status;
			$member->access = $access;
			$member->membership_level = $membership_level;
			$member->role = $role;
			$member->created_at = $current_datetime;
			$member->updated_at = $current_datetime;

			$member->save();


			// Copy the default profile photo.
			if (!copy(MEMBER_PHOTOS_PATH . DEFAULT_PROFILE_PHOTO, MEMBER_PHOTOS_PATH . $profile_photo)) {
			    //echo "failed to copy $file...\n";
			}		
			if (!copy(MEMBER_PHOTOS_PATH . DEFAULT_PROFILE_PHOTO_TN, MEMBER_PHOTOS_PATH . $profile_photo_tn)) {
			    //echo "failed to copy $file...\n";
			}				


			// Perform an actual sign in - update and save values in the DB and set Session Values.
			$this->perform_sign_in($member->id);

		}

	} // end of - function sign_up		




	/**
	 * Member Sign In Functionality.
	 */
	public function sign_in() {

		// Load helers/libraries/models.
		$this->load->helper('security');
		$this->load->helper('form');
		$this->load->library('form_validation');


		// Form Validation.
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');



		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Set the title for the page.			
			$data['title'] = 'Sign In';

			$this->load->view('templates/top', $data);
			$this->load->view('templates/header', $data);
			$this->load->view('members/sign-in', $data);
			$this->load->view('templates/footer');

		} else {

			// Get form values.
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
			// Encrypt the password.
			$encrypted_password = do_hash($this->input->post('password'), 'md5'); // MD

			$member = array();
			$member = $this->members_model->member_sign_in($email, $encrypted_password);

			if (empty($member)) {

				// Set message data and redirect to display the new item.
				$this->session->set_flashdata('message_class', 'alert-danger');
				$this->session->set_flashdata('message', 'The Email Address and Password entered do not match our records.');

				// Redirect instead of loading views to prevent a refresh from running the code again.
				redirect('members/sign-in', 'refresh');	

			} else {				

				// Set cookie values.
				$this->input->set_cookie('member_email', $member->email, COOKIE_EXPIRES);
				$this->input->set_cookie('member_password', $member->password, COOKIE_EXPIRES);


				// Perform an actual sign in - update and save values in the DB and set Session Values.
				$this->perform_sign_in($member->id);

			}		

		}

	} // end of - function sign_in




	/**
	 * Member Sign In Functionality.
	 */
	public function perform_sign_in($id) {

		// Load member record.
		$member = new members_model();
		$member->load($id);
		if (!$member->id) {

		} else {
			$current_datetime = date('Y-m-d H:i:s', time());

			// Update values.
			$member->sign_in_count += 1;
			$member->current_sign_in_at = $current_datetime;
			if ($member->sign_in_count == 1) {
				$member->last_sign_in_at = $current_datetime;
			} else {
				$member->last_sign_in_at = $member->current_sign_in_at;
			}			
			$member->save();


			// Save Member Session Data.
			$this->set_member_session_values($member);


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');

			// If the sign in count is 1 then the member just signed up.
			if ($member->sign_in_count == 1) {
				$this->session->set_flashdata('message', 'Welcome to the ' . SITE_NAME . ' ' . html_escape($member->first_name) . '.');
			} else {
				$this->session->set_flashdata('message', 'Welcome Back ' . html_escape($member->first_name) . '.');
			}

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('members/dashboard', 'refresh');

		}	

	} // end of - function perform_sign_in




	/**
	 * Member Sign Out Functionality.
	 */
	public function sign_out() {

		// Save the first name of the signed in member so it can be used in a message.
		$first_name = $this->session->userdata('member_first_name');

		// Destroy the session which clears all values.
		$this->session->sess_destroy();

		// Set message data and redirect to display the new item.
		$this->session->set_flashdata('message_class', 'alert-success');
		$this->session->set_flashdata('message', 'You have successfully signed out ' . html_escape($first_name) . '.  Come back soon.');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		redirect('members/sign-in', 'refresh');

	} // end of - function sign_out




	/**
	 * Display the members dashboard.
	 */
	public function dashboard() {

		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in();


		// Load helers/libraries/models.
		$this->load->helper('date');
		$this->load->model('news_model');
		$this->load->model('recipes_model');
		$this->load->model('mdl_links_model');
		

		// Load the latest news to be displayed in the dashboard.
		$news = new news_model();
		$a_latest_news = array();
		$a_latest_news = $news->get_latest_news();


		// Load the members recipes and create the content to display.
		$recipes = new recipes_model();
		$a_my_recipes = array();
		$a_my_recipes = $recipes->get_my_recipes($this->session->userdata('member_id'));

		// Get the data for the my recipes list.
		$data_for_list['recipes'] = $a_my_recipes;

		// Create the my recipes list view code.
		//$my_recipes_view = $this->load->view('recipes/_panel_list', $data_for_list, true);
		$my_recipes_view = $this->load->view('recipes/_list_group', $data_for_list, true);


		// Load the members most visited links and create the content to display.
		$limit = 20;
		$a_mdl_links = array();
		$a_mdl_links = $this->mdl_links_model->get_mdl_links_most_visited($limit);
		
		// Get the data for the my links list.
		$data_for_list['links'] = $a_mdl_links;

		// Create the my links list view code.
		$links_view = $this->load->view('mdl_links/_list_group', $data_for_list, true);	


		// Create the sections content to display.
		$data_for_page['displayed_from_page'] = 'dashboard';
		$sections_view = $this->load->view('templates/_sections', $data_for_page, true);	


		// Set the title for the page.			
		$page_data['title'] = 'Dashboard';
		$data['title'] = 'Dashboard';
		$data['latest_news'] = $a_latest_news;
		$data['my_recipes_view'] = $my_recipes_view;
		$data['mdl_links_view'] = $links_view;
		$data['sections_view'] = $sections_view;


		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('members/dashboard', $data);
		$this->load->view('templates/footer');
		$this->load->view('more_js/mdl_links');

	} // end of - function dashboard		



	/**
	 * View member profile.
	 */
	public function profile() {

		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in();

		// Load helers/libraries/models.
		$this->load->helper('date');

		$member = new members_model();
		$member->load($this->session->userdata('member_id'));
		if (!$member->id) {
			//show_404();

			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'Profile Not Found.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('members/dashboard', 'refresh');

		}

		// Set the title for the page.
		$page_data['title'] = 'My Profile';
		// Set content for the page.
		$data['title'] = 'My Profile';
		$data['member'] = $member;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('members/profile', $data);
		$this->load->view('templates/footer');

	} // end of - function profile




	/**
	 * Edit Member Profile Functionality.
	 */
	public function edit_profile() {

		// Make sure that a member is signed in before displaying this page.
		$this->accesschecks->check_if_member_signed_in();


		// Load helers/libraries/models.
		$this->load->helper('security');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');


		// Form Validation.
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required');

		//$this->form_validation->set_rules('city', 'City', 'required');
		//$this->form_validation->set_rules('province', 'Province/State', 'required');
		//$this->form_validation->set_rules('country', 'Country', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');



		// Image Upload Validation.
		$check_file_upload = FALSE;
		if (isset($_FILES['profile_photo']['error']) && $_FILES['profile_photo']['error'] != 4) {
			$check_file_upload = TRUE;

			// Make sure the image name being uploaded will be unique.
			$current_file_name = $_FILES['profile_photo']['name'];

			// If the file name has any spaces in it an error will occur so check it before continuing.
			if (strpos($current_file_name, ' ')) {

				// Set message data and redirect to display the new item.
				$this->session->set_flashdata('message_class', 'alert-danger');
				$this->session->set_flashdata('message', 'The image file selected has at least one space in the file name.  Please remove or replace the spaces and try again.');

				// Redirect instead of loading views to prevent a refresh from running the code again.
				redirect('members/edit-profile', 'refresh');

			}


			$new_file_name = time() . '_' . $current_file_name;
			$tn_file_name = time() . '_tn_' . $current_file_name;

			// For Image Uploads.
			$config = array (
				//'upload_path' => 'uploads/issue_covers/', 
				'upload_path' => MEMBER_PHOTOS_PATH, 
				'allowed_types' => 'gif|jpg|png', 
				'file_name' => $new_file_name, 
				'max_size' => 2048, 
				'max_width' => 1920, 
				'max_height' => 1080,
			);

			$this->upload->initialize($config);
		}



		// if ($this->form_validation->run() === FALSE) {
		//if (!$this->form_validation->run()) {
		if (!$this->form_validation->run() || ($check_file_upload && !$this->upload->do_upload('profile_photo'))) {

			$member = new members_model();
			$member->load($this->session->userdata('member_id'));
			if (!$member->id) {
				//show_404();

				// Set message data and redirect to display the new item.
				$this->session->set_flashdata('message_class', 'alert-danger');
				$this->session->set_flashdata('message', 'Profile Not Found - OR - Profile Photo Not Uploaded.');

				// Redirect instead of loading views to prevent a refresh from running the code again.
				redirect('members/dashboard', 'refresh');

			}

			// Set the title for the page.			
			$page_data['title'] = 'Edit Profile';
			$data['title'] = 'Edit Profile';
			$data['member'] = $member;

			$this->load->view('templates/top', $page_data);
			$this->load->view('templates/header', $page_data);
			$this->load->view('templates/advertising');
			$this->load->view('members/profile-edit', $data);
			$this->load->view('templates/footer');

		} else {

			// Encrypt the password.
			$encrypted_password = do_hash($this->input->post('password'), 'md5');

			// Set default values.
			$current_datetime = date('Y-m-d H:i:s', time());
			

			// Save data.
			$member = new members_model();
			//$member->load($this->session->userdata('member_id'));
			$member->load($this->input->post('id'));

			$member->first_name = $this->input->post('first_name');
			$member->last_name = $this->input->post('last_name');
			$member->email = $this->input->post('email');
			$member->password = $this->input->post('password');
			
			$member->encrypted_password = $encrypted_password;

			// $member->city = $this->input->post('city');
			// $member->province = $this->input->post('province');
			// $member->country = $this->input->post('country');
			// $member->gender = $this->input->post('gender');
			// $member->date_of_birth = $this->input->post('date_of_birth');
			// $member->profile_photo = $this->input->post('profile_photo');
			// $member->profile_photo_tn = $this->input->post('profile_photo_tn');
			// $member->email_confirmed = $this->input->post('email_confirmed');
			// $member->sign_in_count = $this->input->post('sign_in_count');
			// $member->current_sign_in_at = $this->input->post('current_sign_in_at');
			// $member->last_sign_in_at = $this->input->post('last_sign_in_at');
			// $member->display = $this->input->post('display');
			// $member->featured = $this->input->post('featured');
			// $member->status = $this->input->post('status');
			// $member->access = $this->input->post('access');
			// $member->membership_level = $this->input->post('membership_level');
			// $member->created_at = $this->input->post('created_at');


			$current_profile_photo = $this->input->post('current_profile_photo');
			$current_profile_photo_tn = $this->input->post('current_profile_photo_tn');			


			// Deal with the Uploaded Image.
			if ($check_file_upload) {
				$upload_data = $this->upload->data();
				if (isset($upload_data['file_name'])) {
					$member->profile_photo = $upload_data['file_name'];
					$member->profile_photo_tn = $tn_file_name;

					// Create a thumbnail of the uploaded image.
					$this->load->library('Imagetransform');

					$main_file = MEMBER_PHOTOS_PATH . $new_file_name;
					$tn_file = MEMBER_PHOTOS_PATH . $tn_file_name;

					$this->imagetransform->resize($main_file, 500, 500, $main_file);
					$this->imagetransform->crop($main_file, 100, 100, $tn_file);

					// Delete the replaced image files if they exist.
					if (($current_profile_photo != '') && (file_exists(MEMBER_PHOTOS_PATH . $current_profile_photo))) {
						unlink(MEMBER_PHOTOS_PATH . $current_profile_photo);
					}
					//if ($current_profile_photo_tn != '') {
					if (($current_profile_photo_tn != '') && (file_exists(MEMBER_PHOTOS_PATH . $current_profile_photo_tn))) {
						unlink(MEMBER_PHOTOS_PATH . $current_profile_photo_tn);
					}					
					
				}
			} else {
				// $member->profile_photo = $current_profile_photo;
				// $member->profile_photo_tn = $current_profile_photo_tn;
			}


			// Set the updated_at valule.
			$member->updated_at = $current_datetime;

			// Save the data to DB.
			$member->save();


			// Save Member Session Data.
			$this->set_member_session_values($member);	


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'Your Profile has been updated.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('members/profile', 'refresh');

		}

	} // end of - function edit_profile		





	/**
	 * Handle displaying the forgot password form and it's submission including setting a temporary password and emailing it to the member.
	 */
	public function forgot_password() {

		// Load helers/libraries/models.
		$this->load->helper('security');
		$this->load->helper('form');
		$this->load->library('form_validation');


		// START OF - Check for SPAM.
		// This field should be empty.
		if ($this->input->post('email_address') != '') {
			redirect('spam_detected', 'refresh');
		}
		// END OF - Check for SPAM.


		// Form Validation.
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


		// if ($this->form_validation->run() === FALSE) {
		if (!$this->form_validation->run()) {

			// Set the title for the page.			
			$data['title'] = 'Forgot Password';

			$this->load->view('templates/top', $data);
			$this->load->view('templates/header', $data);
			$this->load->view('members/forgot-password', $data);
			$this->load->view('templates/footer');

		} else {


			// Check to see if the eneted data matches a members record.
			$first_name =  $this->input->post('first_name');
			$last_name =  $this->input->post('last_name');
			$email =  $this->input->post('email');


			$a_member = array();
			$a_member = $this->members_model->does_member_exits($first_name, $last_name, $email);


			// If a member record isn't returned.
			if (empty($a_member)) {

				// Set message data and redirect to display the new item.
				$this->session->set_flashdata('message_class', 'alert-danger');
				$this->session->set_flashdata('message', 'The Name and Email Address entered do not match our records.');

				// Redirect instead of loading views to prevent a refresh from running the code again.
				redirect('members/forgot-password', 'refresh');

			} else {				

				// Create a new temp password.
				$temp_password = $this->create_temp_password(10);

				// Encrypt the password.
				$encrypted_password = do_hash($temp_password, 'md5'); // MD

				// Set default values.
				$current_datetime = date('Y-m-d H:i:s', time());


				// Save data.
				$member = new members_model();
				$member->load($a_member->id);

				$member->password = $temp_password;
				$member->encrypted_password = $encrypted_password;
				$member->updated_at = $current_datetime;

				$member->save();


				// Set values for email.
				$to = $email;
				$email_subject = "Password reset on " . SITE_NAME . " website";
				$email_body = "You indicated that you forgot your password so it has been reset to the following: \n\n " .
								"Temporary Password:  " . $temp_password . " \n\n " . 
								"Please sign into " . SITE_NAME . " and change your password to something you can easily remember.";
				$headers = "From: " . $email . " \n";
				$headers .= "Reply-To: " . FROM_EMAIL . "";


				// Send an email if indicated it will work.
				if (SEND_EMAIL == 'yes') {

					// Send email.
					mail($to, $email_subject, $email_body, $headers);

				} else {

					$email_body = str_replace("\n", "<br />", $email_body);

					$email_details = $email_subject . "<br /><br />" . 
										$email_body . "<br /><br />" . 
										$headers . "<br /><br />";

					// Set message data and redirect to display the new item.
					$this->session->set_flashdata('message_class', 'alert-success');
					$this->session->set_flashdata('message', $email_details);

					// Redirect instead of loading views to prevent a refresh from running the code again.
					redirect('email_not_sent', 'refresh');

				}



				// Set message data and redirect to display the new item.
				$this->session->set_flashdata('message_class', 'alert-success');
				$this->session->set_flashdata('message', 'temp_password = ' . $temp_password . '<br /><br />An email has been sent to ' . $email . ' with a temporary password.  Please use this password to sign into the site and change your password in the Edit Profile section.');

				// Redirect instead of loading views to prevent a refresh from running the code again.
				redirect('members/sign-in', 'refresh');	

			}

		}

	} // end of - function forgot_password



	/**
	 * Create and return a random string.
	 * @param length integer
	 */
	private function create_temp_password($length) {

		$charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	    $str = '';

	    $count = strlen($charset);

	    while ($length--) {
	        $str .= $charset[mt_rand(0, $count - 1)];
	    }

	    return $str;

	} // end of - function create_temp_password



	/**
	 * Save member data to session variables so they can be used throughout the site.
	 * @param member object
	 */
	private function set_member_session_values($member) {

		$this->session->set_userdata('member_id', $member->id);
		$this->session->set_userdata('member_first_name', $member->first_name);
		$this->session->set_userdata('member_last_name', $member->last_name);
		$this->session->set_userdata('member_email', $member->email);
		// Check to see if the files exist before setting the session variables.
		($member->profile_photo != '' ? $this->session->set_userdata('member_profile_photo', MEMBER_PHOTOS_PATH . $member->profile_photo) : $this->session->set_userdata('member_profile_photo', ''));
		($member->profile_photo_tn != '' ? $this->session->set_userdata('member_profile_photo_tn', MEMBER_PHOTOS_PATH . $member->profile_photo_tn) : $this->session->set_userdata('member_profile_photo_tn', ''));			
		$this->session->set_userdata('member_status', $member->status);
		$this->session->set_userdata('member_access', $member->access);
		$this->session->set_userdata('member_membership_level', $member->membership_level);

	} // end of - function set_member_session_values




	public function check_if_email_address_is_already_being_used() {

		// Get the passed in value.
		$email = $this->input->post('email');

		$a_member = array();
		$a_member = $this->members_model->is_email_being_used($email);


		// If a member record isn't returned.
		if (empty($a_member)) {
			$used = FALSE;
		} else {
			$used = TRUE;
		}

		echo $used;

	} // end of - function check_if_email_address_is_already_being_used




    // Display the Movie Search Results.
    public function search_results() {
        
        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();
        
		// Load helers/libraries/models.
        $this->load->helper('form');
		$this->load->helper('date');
        
		$a_members = array();
		$a_members = $this->members_model->get_member_search_results();		

		// Get the data for the list.
		$data_for_list['members'] = $a_members;		
		
		// Create the list view code.
		//$members_list = $this->load->view('members/_detailed_list', $data_for_list, true);
		$members_list = $this->load->view('members/_simple_list', $data_for_list, true);

		// Create the options list(s) for the search form.
        $status_options = array(  
            '' => '--Status--',
            'active' => 'Active', 
            'inactive' => 'Inactive'
        );		
		
        $access_options = array(  
            '' => '--Access--',
            'normal' => 'Normal', 
            'admin' => 'Admin'
        );	

		// Set the title/data for the page.
        $page_data['title'] = 'Member Search Results';
		$data['title'] = 'Members <span class="extra-content">(Search Results)</span>';
		$data['form_action'] = 'members/search-results';
		$data['status_options'] = $status_options;
		$data['access_options'] = $access_options;		
		//$data['members'] = $a_members;
		$data['members_list'] = $members_list;
        
		$this->load->view('templates/top', $page_data);
        $this->load->view('templates/header', $page_data);
        $this->load->view('members/search-form', $data);  
        $this->load->view('members/index', $data); 
        $this->load->view('templates/footer');
        
    } // end of - public function search_results	




} // end of - class

/* End of file members.php */
/* Location: ./application/controllers/members.php */