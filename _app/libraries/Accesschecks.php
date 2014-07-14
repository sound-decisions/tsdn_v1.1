<?php
/**
 * This class is used to check to see if the person visiting site has the proper access to few certain parts of the site.
*/
class Accesschecks {

	/**
	 * Check if a member is signed in - if not redirect them to the sign_in page.
	 */
	public function check_if_member_signed_in() {

		$CI =& get_instance();

		if (!$CI->session->userdata('member_id')) {

			// Set message data and redirect to display the new item.
			$CI->session->set_flashdata('message_class', 'alert-danger');
			$CI->session->set_flashdata('message', 'You need to be signed into the site to access that area of this site.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('members/sign-in', 'refresh');

		}			

	} // end of - function check_if_member_signed_in




	/**
	 * Check if a member is admin - if not redirect them to the sign_in page.
	 */
	public function check_if_member_is_admin() {

		$CI =& get_instance();
		
		if ($CI->session->userdata('member_access') != 'admin') {

			// Set message data and redirect to display the new item.
			$CI->session->set_flashdata('message_class', 'alert-danger');
			$CI->session->set_flashdata('message', 'You need to be an Admin to access that area of this site.');

			// Redirect instead of loading views to prevent a refresh from running the code again.
			redirect('members/sign-in', 'refresh');

		}			

	} // end of - function check_if_member_is_admin	

} // end of - class

/* End of file Accesschecks.php */
/* Location: ./application/libraries/Accesschecks.php */