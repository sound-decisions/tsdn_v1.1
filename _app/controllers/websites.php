<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Websites extends CI_Controller {



	/**
	 * Display details about this section of the website.
	 */
	public function about() {

		// Set the title for the page.
		$page_data['top_menu'] = 'Websites';
		$page_data['dropdown_menu'] = 'About Websites';
		$page_data['title'] = 'About The Websites Section';
		
		// Set content for the page.
		$data['title'] = 'About The Websites Section';
		
		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('websites/about', $data);
		$this->load->view('templates/footer');

	} // end of - function about
	



	/**
	 * Display information on the I Want To Be A Loser website.
	 */
	public function i_want_to_be_a_loser()
	{
		$page_data['top_menu'] = 'Websites';
		$page_data['dropdown_menu'] = 'I Want To Be A Loser';
		$page_data['title'] = 'I Want To Be A Loser';
		
		$data['title'] = 'I Want To Be A Loser';

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('websites/i_want_to_be_a_loser', $data);
		$this->load->view('templates/footer');
	}
	
	
	
	/**
	 * Display information on the My Movie Collection website.
	 */
	public function my_movie_collection()
	{
		$page_data['top_menu'] = 'Websites';
		$page_data['dropdown_menu'] = 'My Movie Collection';
		$page_data['title'] = 'My Movie Collection';
		
		$data['title'] = 'My Movie Collection';

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('websites/my_movie_collection', $data);
		$this->load->view('templates/footer');
	}
	
	
	/**
	 * Display information on the NFL Football Pool website.
	 */
	public function nfl_football_pool()
	{
		$page_data['top_menu'] = 'Websites';
		$page_data['dropdown_menu'] = 'NFL Football Pool';
		$page_data['title'] = 'NFL Football Pool';
		
		$data['title'] = 'NFL Football Pool';

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('websites/nfl_football_pool', $data);
		$this->load->view('templates/footer');
	}
	
	
	/**
	 * Display information on The Link Vault website.
	 */
	public function the_link_vault()
	{
		$page_data['top_menu'] = 'Websites';
		$page_data['dropdown_menu'] = 'The Link Vault';
		$page_data['title'] = 'The Link Vault';
		
		$data['title'] = 'The Link Vault';

		$this->load->view('templates/top', $page_data);
		$this->load->view('templates/header', $page_data);
		$this->load->view('templates/advertising');
		$this->load->view('websites/the_link_vault', $data);
		$this->load->view('templates/footer');
	}			


} // end of - class

/* End of file websites.php */
/* Location: ./application/controllers/websites.php */