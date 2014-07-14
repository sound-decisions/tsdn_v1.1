<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	/**
	 * Index page for the Pages controller.
	 */
	// public function index() 
	// {
	// 	$data['title'] = 'Home Page';

	// 	$this->load->view('templates/header', $data);
	// 	$this->load->view('pages/home', $data);
	// 	$this->load->view('templates/footer', $data);
	// }


	/**
	 * View page for the Pages controller.
	 */
	public function view($page = 'home') {

		if ( ! file_exists('_app/views/pages/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}


		// Remove and _ or - in the page name.
		$page_title = str_replace('_', ' ', $page);
		$page_title = str_replace('-', ' ', $page_title);


		switch (strtoupper($page)) {

			case 'HOME_TUTORIAL':

				// Set the title for the page.
				$page_data['top_menu'] = 'Home: Tutorial';
				$page_data['title'] = ucwords($page_title); // Capitalize the first letter of each word
				
				$data['title'] = 'Home: Tutorial';

				$this->load->view('templates_tutorial/top', $page_data);
				$this->load->view('templates_tutorial/header', $page_data);
				$this->load->view('pages/home_tutorial', $data);
				$this->load->view('templates_tutorial/footer');	

				break;
			
			case 'HOME':
				
				$page_data['top_menu'] = 'Home';
				$page_data['title'] = 'Home';
				
				$data['title'] = 'Home';

				$this->load->view('templates/top', $page_data);
				$this->load->view('templates/header-home-page', $page_data);
				$this->load->view('pages/' . $page, $data);
				//$this->load->view('pages/_home_carousel_images_on_left');
				$this->load->view('templates/footer-home-page');
				
				break;
				
			case 'ABOUT':
				
				// Create the sections content to display.
				$data_for_page['displayed_from_page'] = 'about';
				$sections_view = $this->load->view('templates/_sections', $data_for_page, true);
				
				$page_data['top_menu'] = 'About';
				$page_data['dropdown_menu'] = 'The Site';
				$page_data['title'] = 'About The Site';
				
				$data['title'] = 'About The Site';
				$data['sections_view'] = $sections_view;

				$this->load->view('templates/top', $page_data);
				$this->load->view('templates/header', $page_data);
				$this->load->view('pages/' . $page, $data);
				$this->load->view('templates/footer');
				
				break;
							
			
			case 'ABOUT-MOVIES':
			case 'ABOUT-RECIPES':
			case 'ABOUT-LINKS':
			case 'ABOUT-NOTES':
				
				$page_data['top_menu'] = 'About';
				$page_data['title'] = ucwords($page_title); // Capitalize the first letter of each word
				
				$data['title'] = ucwords($page_title); // Capitalize the first letter of each word

				$this->load->view('templates/top', $page_data);
				$this->load->view('templates/header', $page_data);
				$this->load->view('pages/' . $page, $data);
				$this->load->view('templates/footer');

				break;
				
			default:
				
				$page_data['top_menu'] = ucwords($page_title); // Capitalize the first letter of each word
				$page_data['title'] = ucwords($page_title); // Capitalize the first letter of each word
				
				$data['title'] = ucwords($page_title); // Capitalize the first letter of each word

				$this->load->view('templates/top', $page_data);
				$this->load->view('templates/header', $page_data);
				$this->load->view('pages/' . $page, $data);
				$this->load->view('templates/footer');

				// if (strtoupper($page) == 'ABOUT') {
				// 	$this->load->view('more_js/resize_columns');
				// }			

		} // end of - switch


	} // end of - function view

} // end of - class

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */