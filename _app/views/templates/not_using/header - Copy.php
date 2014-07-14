
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom.css'); ?>" />		

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->	
</head>
<body>


<div class="header-container">
	<div class="container">

		<div class="row">
			<div class="col col-lg-12">
				<header class="clearfix">	
									
					<?php
					echo '<div class="pull-left margin-top-5 hidden-xs" id="header-logo-container">';
						echo '<a href="' . site_url('home') . '">';
							echo '<img src="' . base_url("images/sdn/the_sound_decisions_header_logo_yellow_350x60_ul.png") . '" class="img-responsive" id="header-logo" />';
						echo '</a>' . chr(10);
					echo '</div>' . chr(10);
					
					echo '<div class="pull-left margin-top-5 visible-xs">';
						echo '<a href="' . site_url('home') . '">';
							echo '<img src="' . base_url("images/logos/sd_logo_yellow_50x50.png") . '" class="img-responsive" />';
						echo '</a>' . chr(10);
					echo '</div>' . chr(10);
						


					echo '<div class="pull-right" id="header-links">' . chr(10);
						
						echo '<table class="right-side-links">' . chr(10);
							echo '<tr>' . chr(10);

								if ($this->session->userdata('member_id') != '') {

									echo '<td class="text-right">' . chr(10);
										echo '<a  href="' . site_url('members/profile') . '">' . $this->session->userdata('member_first_name') . ' ' . $this->session->userdata('member_last_name') . '</a>' . chr(10);
										echo '<br />' . chr(10);
										echo '<a  href="' . site_url('members/dashboard') . '">Dashboard</a>';
										echo '<span class="link_separator_big">|</span>';
										echo '<a  href="' . site_url('members/sign-out') . '">Sign Out</a>';
									echo '</td>' . chr(10);

									// Check to see if the profile photo exists before displaying it.
									if (file_exists($this->session->userdata('member_profile_photo_tn'))) {
		
										$image_properties = array(
										          'src' => base_url($this->session->userdata('member_profile_photo_tn')),
										          'alt' => 'My Profile Photo',
										          'class' => 'img-responsive img-rounded',
										          'width' => '40',
										          'height' => '40',
										          //'title' => 'Profile Photo',
										);

										echo '<td class="padding-left-10">' . chr(10);
											echo '<a href="' . site_url('members/profile') . '">' . chr(10);
												echo img($image_properties) . chr(10);
											echo '</a>' . chr(10);
										echo '</td>' . chr(10);
									}	

								} else {

									echo '<td class="text-right">' . chr(10);
										echo '<a  href="' . site_url('members/sign-up') . '">Sign Up</a>';
										echo '<span class="link_separator_big">|</span>';
										echo '<a  href="' . site_url('members/sign-in') . '">Sign In</a>';
									echo '</td>' . chr(10);
								}

							echo '</tr>' . chr(10);
						echo '</table>' . chr(10);

					echo '</div>' . chr(10); // end of - header-links	




					if ("A" == "B") {
						
						echo '<div class="pull-right" id="header-links">' . chr(10);
							
							if ($this->session->userdata('member_id') != '') {						
	
								echo '<div class="right-side-links-2-line">' . chr(10);
									echo '<a  href="' . site_url('members/profile') . '">' . $this->session->userdata('member_first_name') . ' ' . $this->session->userdata('member_last_name') . '</a>' . chr(10);
									echo '<br />' . chr(10);
									echo '<a  href="' . site_url('members/dashboard') . '">Dashboard</a>';
									echo '<span class="link_separator_big">|</span>';
									echo '<a  href="' . site_url('members/sign_out') . '">Sign Out</a>';
								echo '</div>' . chr(10);
								
								// Check to see if the profile photo exists before displaying it.
								if (file_exists($this->session->userdata('member_profile_photo_tn'))) {
	
									$image_properties = array(
									          'src' => base_url($this->session->userdata('member_profile_photo_tn')),
									          'alt' => 'My Profile Photo',
									          'class' => 'img-responsive img-rounded',
									          'width' => '40',
									          'height' => '40',
									          //'title' => 'Profile Photo',
									);
	
									//echo '<div class="hidden-xs">' . chr(10);
										echo '<div class="profile-image pull-right">' . chr(10);	
											echo '<a href="' . site_url('members/profile') . '">' . chr(10);
												echo img($image_properties) . chr(10);
											echo '</a>' . chr(10);
										echo '</div>' . chr(10);
									//echo '</div>' . chr(10);
	
								} // end of - file_exists
								
	
							} else {
								
								echo '<div class="right-side-links-1-line">' . chr(10);
									echo '<a  href="' . site_url('members/sign_up') . '">Sign Up</a>';
									echo '<span class="link_separator_big">|</span>';
									echo '<a  href="' . site_url('members/sign_in') . '">Sign In</a>';
								echo '</div>' . chr(10);
								
							}
	
						echo '</div>' . chr(10); // end of - header-links
						
					}		
					?>
					
				</header><!-- end of - clearfix -->
			</div><!-- end of - col col-log-12 -->
		</div><!-- end of - row -->	

	</div><!-- end of - container -->			
</div><!-- end of - header-container -->



<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-default navbar-fixed-top yamm" role="navigation">
	<div class="container">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				MENU
			</button>
			<a class="navbar-brand visible-xs" href="<?php echo site_url('home'); ?>">The Sound Decisions Network</a>
			<!-- <a class="navbar-brand" href="<?php echo site_url('home'); ?>">Up and Running</a> -->
			<!-- <a class="navbar-brand" href="<?php echo site_url('home'); ?>"><img src="<?php echo base_url("images/sdn/the_sound_decisions_header_logo_yellow_350x60_ul.png"); ?>" class="img-responsive" id="header-logo" /></a> -->
		</div><!-- end of - navbar-header -->

		<div class="navbar-collapse collapse">
			
			<?php		
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
			

			echo '<ul class="nav navbar-nav navbar-right">' . chr(10);			
			
				// Only display the admin menu dropdown for admins.
				if ($this->session->userdata('member_access') == 'admin') {
							
					// Include menu dropdown section(s).
					include_once('_admin_dropdown_menu.php');

				} // end of - admin menu			

			echo '</ul>' . chr(10); // end of - right side menu
			?>
			
		</div><!-- end of - nav-collapse -->

	</div><!-- end of - container -->
</div><!-- end of - navbar navbar-default navbar-fixed-top -->


<div class="body-container">
