<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Contact_messages extends CI_Controller {


	public function __construct() {

		parent::__construct();
		
		$this->load->model('contact_messages_model');
		
	} // end of - function __construct


	/**
	 * List records.
	 */
	public function index() {

		// Make sure that a member is signed in and is an admin before displaying this page.
		$this->accesschecks->check_if_member_is_admin();

		// Clear search criteria session variables.
		$this->contact_messages_model->clear_search_session_variables();

		// Load helers/libraries/models.
		$this->load->helper('form');
		$this->load->helper('date');
		
		$limit = 10;
		$a_messages = array();
		$a_messages = $this->contact_messages_model->get_contact_messages($limit);
		
		
		// Get the data for the list.
		$data_for_list['messages'] = $a_messages;		
		
		// Create the list view code.
		//$messages_list = $this->load->view('contact_messages/_panel_list', $data_for_list, true);
        //$messages_list = $this->load->view('contact_messages/_table_list', $data_for_list, true);
		$messages_list = $this->load->view('contact_messages/_simple_list', $data_for_list, true);

		// Create the options list(s) for the search form.
        $status_options = array(  
            '' => '--Status--',
            'new' => 'New', 
            'read' => 'Read', 
            'follow up' => 'Follow Up', 
            'contact' => 'Contact', 
            'contacted' => 'Contacted', 
            'complete' => 'Complete'
        );

		// Set the title for the page.
		$page_data['top_menu'] = 'Admin Menu';
		$page_data['dropdown_menu'] = 'Contact Messages';
		$page_data['title'] = 'Contact Messages';
		
		//$data['title'] = 'Contact Messages <span class="extra-content">(Last ' . $limit . ' Sent)</span>';
		$data['title'] = '<div class="clearfix"><div class="pull-left">Contact Messages</div><div class="pull-right"><span class="extra-content">(Last ' . $limit . ' Sent)</span></div></div>';
		$data['form_action'] = 'contact-messages/search-results';
		$data['status_options'] = $status_options;
		//$data['results'] = $a_messages;
		$data['messages_list'] = $messages_list;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('contact_messages/search-form', $data);
		$this->load->view('contact_messages/index', $data);
		$this->load->view('templates/footer');
		$this->load->view('more_js/contact_messages');

	} // end of - function index



	/**
	 * View a record.
	 */
	public function view($id) {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();

		// Load helers/libraries/models.
		$this->load->helper('date');

		$message = new contact_messages_model();
		$message->load($id);
		if (!$message->id) {
			//show_404();

			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'Contact Message Not Found.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('contact_messages', 'refresh');

		}

		// Set the title for the page.
		$page_data['top_menu'] = 'Contact Message Details';
		$page_data['title'] = 'Contact Message Details';
		
		// Set content for the page.
		$data['title'] = 'Contact Message Details';
		$data['message'] = $message;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('contact_messages/view', $data);
		$this->load->view('templates/footer');

	} // end of - function view

	
	
	/**
	 * Add a record.
	 */
	public function add() {

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
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


		// If form validation fails - display the following.
		if (!$this->form_validation->run()) {

			// Set the title for the page.
			$page_data['top_menu'] = 'About';
			$page_data['dropdown_menu'] = 'Contact';
			$page_data['title'] = 'Contact';
			$data['title'] = 'Contact';

			$this->load->view('templates/top', $page_data);
			$this->load->view('templates/header', $page_data);
			$this->load->view('contact_messages/form-and-info', $data);
			$this->load->view('templates/footer');

		} else {

			// Set default values.
			$status = 'new';
			$datetime = date('Y-m-d H:i:s', time());

			// Save data.
			$contact_message = new contact_messages_model();
			$contact_message->member_id = $this->input->post('member_id');
			$contact_message->name = $this->input->post('name');
			$contact_message->email = $this->input->post('email');
			$contact_message->message = $this->input->post('message');
			$contact_message->status = $status;
			$contact_message->created_at = $datetime;
			$contact_message->updated_at = $datetime;

			$contact_message->save();

			// Confirm values are set and not empty before creating and sending an email.
			if ((isset($contact_message->name)) && (!empty($contact_message->name))) {


				// Set values for email.
				$to = FROM_EMAIL;
				$email_subject = "Contact Form Submission:  Sent By:  $contact_message->name";
				$email_body = "You have received a new message.\n\n " .
								"Here are the details:\n\n " . 
								"Name: $contact_message->name \n " .
								"Email: $contact_message->email\n\n " . 
								"Message \n $contact_message->message";
				$headers = "From: " . FROM_EMAIL . "\n";
				$headers .= "Reply-To: $contact_message->email";


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
					redirect('email-not-sent', 'refresh');

				} // end of - if (SEND_EMAIL == 'yes')

			}			


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'Your message was successfully sent/saved.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('contact-messages/thank-you', 'refresh');

		}

	} // end of - function add	



	/**
	 * Edit a record.
	 */
	public function edit($id) {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();


		// Load helers/libraries/models.
		$this->load->helper('form');
		$this->load->library('form_validation');


		// Form Validation.
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


		if (!$this->form_validation->run()) {

			$contact_message = new contact_messages_model();
			$contact_message->load($id);
			if (!$contact_message->id) {
				//show_404();

				// Set message data and redirect to display the new item.
				$this->session->set_flashdata('message_class', 'alert-danger');
				$this->session->set_flashdata('message', 'Contact Message Not Found.');

				// Redirect instead of loading views to prevent a refresh from running the code again.
				redirect('contact-messages', 'refresh');

			}

			// Create the options list(s) for the search form.
	        $status_options = array(  
	            '' => '--Status--',
	            'new' => 'New', 
	            'read' => 'Read', 
	            'follow up' => 'Follow Up', 
	            'contact' => 'Contact', 
	            'contacted' => 'Contacted', 
	            'complete' => 'Complete'
	        );			

			// Set the title for the page.
			$page_data['top_menu'] = 'Edit Contact Message';
			$page_data['title'] = 'Edit Contact Message';
			
			$data['title'] = 'Edit Contact Message';
			$data['status_options'] = $status_options;
			$data['message'] = $contact_message;

			$this->load->view('templates/top', $page_data);
			$this->load->view('templates/header', $page_data);
			$this->load->view('contact_messages/admin-form', $data);
			$this->load->view('templates/footer');

		} else {

			// Set default values.
			$current_datetime = date('Y-m-d H:i:s', time());
			

			// Save data.
			$contact_message = new contact_messages_model();
			$contact_message->load($this->input->post('id'));
			//$contact_message->member_id = $this->input->post('member_id');
			//$contact_message->member_id = $this->input->post('member_id');
			$contact_message->name = $this->input->post('name');
			$contact_message->email = $this->input->post('email');
			$contact_message->message = $this->input->post('message');
			$contact_message->notes = $this->input->post('notes');
			$contact_message->status = $this->input->post('status');	

			// Set the updated_at valule.
			$contact_message->updated_at = $current_datetime;

			// Save the data to DB.
			$contact_message->save();


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'Contact Message Updated!!!');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('contact-messages', 'refresh');

		}

	} // end of - function edit	



	/**
	 * Delete a record.
	 * @param int $id
	 */
	public function delete($id) {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();

		$contact_message = new contact_messages_model();
		$contact_message->load($id);
		if (!$contact_message->id) {
			//show_404();

			// Set message data and redirect to display the list of publications.
			$this->session->set_flashdata('message_class', 'alert-danger');
			$this->session->set_flashdata('message', 'Contact Message Not Found.  No data was deleted.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('contact-messages', 'refresh');
		}

		$contact_message->delete($id);


		// Set message data and redirect to display the list of publications.
		$this->session->set_flashdata('message_class', 'alert-success');
		$this->session->set_flashdata('message', 'The Contact Message was Deleted!!!');

		// Redirect instead of loading views to prevent a refresh from running the code again.
		redirect('contact-messages', 'refresh');

	} // end of - function delete	



	/* START OF - custom functions */


	/**
	 * Add a record froma modal form.
	 */
	public function add_modal() {

		// Load helers/libraries/models.
		$this->load->helper('security');
		$this->load->helper('form');
		$this->load->library('form_validation');



		// // START OF - Check for SPAM.
		// $this->load->helper('spam_check');
		// $lt = $this->input->post('lt');
		// encrypted_spam_check($lt);
	 //    // END OF - Check for SPAM.


		// // Form Validation.
		// $this->form_validation->set_rules('name', 'Name', 'required');
		// $this->form_validation->set_rules('email', 'Email', 'required');
		// $this->form_validation->set_rules('message', 'Message', 'required');

		// $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


		// // If form validation fails - display the following.
		// // if ($this->form_validation->run() === FALSE) {
		// if (!$this->form_validation->run()) {

		// 	// Redirect instead of loading views to prevent a refresh from running the code again.
		// 	redirect('modals/contact_form/', 'refresh');			

		// } else {

			// Set default values.
			$status = 'new';
			$datetime = date('Y-m-d H:i:s', time());

			// Save data.
			$contact_message = new contact_messages_model();
			$contact_message->name = $this->input->post('name');
			$contact_message->email = $this->input->post('email');
			$contact_message->message = $this->input->post('message');
			$contact_message->status = $status;
			$contact_message->created_at = $datetime;
			$contact_message->updated_at = $datetime;

			$contact_message->save();


			if ((isset($contact_message->name)) && (!empty($contact_message->name))) {

				// Display values.
				echo "<span class=\"alert alert-success\" >Your message has been received. Thanks! Here is what you submitted:</span><br><br>";
				echo "<stong>Name:</strong> " . $contact_message->name . "<br>";
				echo "<stong>Email:</strong> " . $contact_message->email . "<br>";
				echo "<stong>Message:</strong> " . $contact_message->message . "<br>";

				// Handle sending the email
				$myemail = 'jeffsacummings@hotmail.com';

				// Set values for email.
				// $to = $myemail;
				// $email_subject = "Contact form submission: $name";
				// $email_body = "You have received a new message. " .
				// 				" Here are the details:\n Name: $contact_message->name \n " .
				// 				"Email: $contact_message->email\n Message \n $contact_message->message";
				// $headers = "From: $myemail\n";
				// $headers .= "Reply-To: $contact_message->email";

				// // Send email.
				// mail($to, $email_subject, $email_body, $headers);
			}


			// Set message data and redirect to display the new item.
			$this->session->set_flashdata('message_class', 'alert-success');
			$this->session->set_flashdata('message', 'Your Contact Message was successfully saved.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('modals/contact_form', 'refresh');			

		//}

	} // end of - function add_modal	




	/**
	 * Updated the status of the selected contact message.
	 */
	public function update_status() {

        // Make sure that the member is an Admin before displaying this page.
    	$this->accesschecks->check_if_member_is_admin();

		// Load helers/libraries/models.
		$this->load->helper('form');
		$this->load->library('form_validation');


		// Set default values.
		$status = 'new';
		$datetime = date('Y-m-d H:i:s', time());

		// Save data.
		$contact_message = new contact_messages_model();
		$contact_message->load($this->input->post('id'));
		$contact_message->status = $this->input->post('status');
		$contact_message->updated_at = $datetime;

		$contact_message->save();


		if ((isset($contact_message->name)) && (!empty($contact_message->name))) {

			// Display values.
			echo "<span class=\"alert alert-success\" >The contact message's status has been updated.  Thanks! Here is what you submitted:</span><br><br>";
			echo "<stong>ID:</strong> " . $contact_message->id . "<br>";
			echo "<stong>Status:</strong> " . $contact_message->status . "<br>";

		}		

	} // end of - function update_status	





	/**
	 * Display a thank you page after a contact message has been saved/sent.
	 */
	public function thank_you() {

		// Set the title for the page.
		$page_data['top_menu'] = 'Contact';
		$page_data['title'] = 'Thank You For Your Message';
		
		$data['title'] = 'Thank You For Your Message';

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('contact_messages/thank-you', $data);
		$this->load->view('templates/footer');

	} // end of - function thank_you




	/**
	 * List records.
	 */
	public function search_results() {

		// Make sure that a member is signed in and is an admin before displaying this page.
		$this->accesschecks->check_if_member_is_admin();

		// Load helers/libraries/models.
		$this->load->helper('form');
		$this->load->helper('date');
		
		$a_messages = array();
		$a_messages = $this->contact_messages_model->get_contact_messages_search_results();
		
		
		// Get the data for the list.
		$data_for_list['messages'] = $a_messages;		
		
		// Create the list view code.
		//$messages_list = $this->load->view('contact_messages/_panel_list', $data_for_list, true);	
		$messages_list = $this->load->view('contact_messages/_simple_list', $data_for_list, true);	

		// Create the options list(s) for the search form.
        $status_options = array(  
            '' => '--Status--',
            'new' => 'New', 
            'read' => 'Read', 
            'follow up' => 'Follow Up', 
            'contact' => 'Contact', 
            'contacted' => 'Contacted', 
            'complete' => 'Complete'
        );

		// Set the title for the page.
		$page_data['top_menu'] = 'Contact';
		$page_data['title'] = 'Contact Messages Search Results';
		
		$data['title'] = 'Contact Messages <span class="extra-content">(Search Results)</span>';
		$data['form_action'] = 'contact-messages/search-results';
		$data['status_options'] = $status_options;
		//$data['results'] = $a_messages;
		$data['messages_list'] = $messages_list;

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('contact_messages/search-form', $data);
		$this->load->view('contact_messages/index', $data);
		$this->load->view('templates/footer');
		$this->load->view('more_js/contact_messages');

	} // end of - function search_results



} // end of - class

/* End of file contact_messages.php */
/* Location: ./application/controllers/contact_messages.php */