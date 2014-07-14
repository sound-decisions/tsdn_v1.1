<?php
echo '<div class="navbar navbar-inverse navbar-default navbar-fixed-top yamm" role="navigation">' . chr(10);
	echo '<div class="container">' . chr(10);

		echo '<div class="navbar-header">' . chr(10);
			echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only">Toggle navigation</span>MENU</button>' . chr(10);
			echo '<a class="navbar-brand visible-xs" href="' . site_url('home') . '">The Sound Decisions Network</a>' . chr(10);
			//echo '<a class="navbar-brand" href="' . site_url('home') . '">Up and Running</a>' . chr(10);
			//echo '<a class="navbar-brand" href="' . site_url('home') . '"><img src="' . base_url("images/sdn/the_sound_decisions_header_logo_yellow_350x60_ul.png") . '" class="img-responsive" id="header-logo" /></a>' . chr(10);
		echo '</div>' . chr(10); // end of - navbar-header

		echo '<div class="navbar-collapse collapse">' . chr(10);
				
			echo '<ul class="nav navbar-nav">' . chr(10);
				echo '<li ' . (@$top_menu == 'Home' ? 'class="active"' : '') . '><a href="' . site_url('home') . '">Home</a></li>' . chr(10);
				//echo '<li ' . (@$top_menu == 'About' ? 'class="active"' : '') . '><a href="' . site_url('about') . '">About</a></li>' . chr(10);											
				//echo '<li ' . (@$top_menu == 'News' ? 'class="active"' : '') . '><a href="' . site_url('news') . '">News</a></li>' . chr(10);
				//echo '<li ' . (@$top_menu == 'Contact' ? 'class="active"' : '') . '><a href="' . site_url('contact_messages/add') . '">Contact</a></li>' . chr(10);				
				
				
				// Include menu dropdown section(s).
				include_once('_about_dropdown_menu.php');
				include_once('_movies_dropdown_menu.php');
				//include_once('_recipes_dropdown_menu.php');
				
				
				// Display the Members Only Menu Items.
				if ($this->session->userdata('member_id') != '') {
																																													
					// Include menu dropdown section(s).
					include_once('_members_only_dropdown_menu.php');
					//include_once('_recipes_dropdown_menu.php');
					//include_once('_links_dropdown_menu.php');
					//include_once('_notes_dropdown_menu.php');
					
				} // end of - members only
							
								
				// Include menu dropdown section(s).
				include_once('_websites_dropdown_menu.php');

			echo '</ul>' . chr(10); // end of - left side menu.
			

			// START OF - Right Side Menu
			echo '<ul class="nav navbar-nav navbar-right">' . chr(10);			
			
				// Only display the admin menu dropdown for admins.
				if ($this->session->userdata('member_access') == 'admin') {
							
					// Include menu dropdown section(s).
					include_once('_admin_dropdown_menu.php');

				} // end of - admin menu			

			echo '</ul>' . chr(10); // end of - right side menu
			// END OF - Right Side Menu
			
		echo '</div>' . chr(10); // end of - nav-collapse
		
	echo '</div>' . chr(10); // end of - container
echo '</div>' . chr(10); // end of - navbar navbar-default navbar-fixed-top
?>