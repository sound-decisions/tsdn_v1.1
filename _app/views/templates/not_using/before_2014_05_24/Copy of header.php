
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom.css'); ?>" />		

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->	
</head>
<body>


<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-default navbar-fixed-top" role="navigation">
	<div class="container">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<!-- <a class="navbar-brand" href="<?php echo site_url('home'); ?>">Up and Running</a> -->
		</div><!-- end of - navbar-header -->

		<div class="navbar-collapse collapse">

			
			<?php
			echo '<ul class="nav navbar-nav">' . chr(10);
				echo '<li ' . ($title == 'Home' ? 'class="active"' : '') . '><a href="' . site_url('home') . '">Home</a></li>' . chr(10);
				echo '<li ' . ($title == 'About' ? 'class="active"' : '') . '><a href="' . site_url('about') . '">About</a></li>' . chr(10);
				// Display the receipes dropdown if a member is signed in.
				if ($this->session->userdata('member_id') != '') {
					echo '<li class="dropdown">' . chr(10);
						echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Recipes <b class="caret"></b></a>' . chr(10);
						echo '<ul class="dropdown-menu">' . chr(10);
							echo '<li ' . ($title == 'By Category' ? 'class="active"' : '') . '><a href="' . site_url('recipe_categories/select') . '">By Category</a></li>' . chr(10);
							// Display the following menu items if a member is signed in.
							if ($this->session->userdata('member_id') != '') {
								echo '<li ' . ($title == 'My Recipes' ? 'class="active"' : '') . '><a href="' . site_url('recipes/my_recipes') . '">My Recipes</a></li>' . chr(10);
							}
							echo '<li ' . ($title == 'Recipes' ? 'class="active"' : '') . '><a href="' . site_url('recipes') . '">All Recipes</a></li>' . chr(10);
							// Display the following menu items if a member is signed in.
							if ($this->session->userdata('member_id') != '') {						
								echo '<li ' . ($title == 'Add A Recipe' ? 'class="active"' : '') . '><a href="' . site_url('recipes/add') . '">Add A Recipe</a></li>' . chr(10);					
							}
						echo '</ul>' . chr(10);
					echo '</li>' . chr(10);
				} else {
					echo '<li ' . ($title == 'Recipes' ? 'class="active"' : '') . '><a href="' . site_url('recipe_categories/select') . '">Recipes</a></li>' . chr(10);
				}
				echo '<li ' . ($title == 'The News' ? 'class="active"' : '') . '><a href="' . site_url('news') . '">News</a></li>' . chr(10);
				echo '<li ' . ($title == 'Contact' ? 'class="active"' : '') . '><a href="' . site_url('contact_messages/add') . '">Contact</a></li>' . chr(10);
			echo '</ul>' . chr(10);

			echo '<ul class="nav navbar-nav navbar-right">' . chr(10);			
			
				// Only display the admin menu dropdown for admins.
				if ($this->session->userdata('member_access') == 'admin') {
					echo '<li class="dropdown">' . chr(10);
						echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin Menu <b class="caret"></b></a>' . chr(10);
						echo '<ul class="dropdown-menu">' . chr(10);
							
							echo '<li ' . ($title == 'Contact Messages' ? 'class="active"' : '') . '><a href="' . site_url('contact_messages') . '">Contact Messages</a></li>' . chr(10);
							echo '<li class="divider"></li>' . chr(10);
							echo '<li class="dropdown-header">Recipes</li>' . chr(10);
							echo '<li ' . ($title == 'Recipes' ? 'class="active"' : '') . '><a href="' . site_url('recipes') . '">Recipes</a></li>' . chr(10);
							echo '<li ' . ($title == 'Recipe Categories' ? 'class="active"' : '') . '><a href="' . site_url('recipe_categories') . '">Recipe Categories</a></li>' . chr(10);
							echo '<li ' . ($title == 'Add A Recipe Category' ? 'class="active"' : '') . '><a href="' . site_url('recipe_categories/add') . '">Add A Recipe Category</a></li>' . chr(10);
							echo '<li class="divider"></li>' . chr(10);
							echo '<li class="dropdown-header">News</li>' . chr(10);						
							echo '<li ' . ($title == 'Add A News Item' ? 'class="active"' : '') . '><a href="' . site_url('news/add') . '">Add A News Item</a></li>' . chr(10);																																									
							echo '<li class="divider"></li>' . chr(10);
							echo '<li class="dropdown-header">Tutorial Site</li>' . chr(10);									
							echo '<li ' . ($title == 'Examples' ? 'class="active"' : '') . '><a href="' . site_url('home_tutorial') . '">Tutorial Home</a></li>' . chr(10);

						echo '</ul>' . chr(10);
					echo '</li>' . chr(10);
				}				

			echo '</ul>' . chr(10);
			?>
			

		</div><!-- end of - nav-collapse -->

	</div><!-- end of - container -->
</div><!-- end of - navbar navbar-default navbar-fixed-top -->


<div class="header_container">
	<div class="container">

		<div class="row">
			<div class="col col-lg-12">
				<header class="clearfix">					
					<?php
					//echo '<div class="clearfix">' . chr(10);
						//echo '<h3 class="pull-left"><small>The</small> Sound Decisions <small class="bottom">Network</small></h3>' . chr(10);
						echo '<div class="pull-left" id="header-logo-container">';
							echo '<a href="' . site_url('home') . '">';
								//echo '<img src="' . base_url("images/sdn/the_sound_decisions_header_logo_280x60.png") . '" class="img-responsive center-block" />';
								//echo '<img src="' . base_url("images/sdn/the_sound_decisions_header_logo_red_340x60.png") . '" class="img-responsive center-block" />';
								//echo '<img src="' . base_url("images/sdn/the_sound_decisions_header_logo_yellow_340x60.png") . '" class="img-responsive center-block" />';
								// echo '<img src="' . base_url("images/sdn/the_sound_decisions_header_logo_yellow_350x60.png") . '" class="img-responsive" id="header-logo" />';
								echo '<img src="' . base_url("images/sdn/the_sound_decisions_header_logo_yellow_350x60_ul.png") . '" class="img-responsive" id="header-logo" />';
							echo '</a>' . chr(10);
						//echo '<a href="' . site_url('home') . '" id="home-link"></a>' . chr(10);
						echo '</div>' . chr(10);
						

						echo '<div class="pull-right" id="header-links">' . chr(10);
							
							if ($this->session->userdata('member_id') != '') {						

								echo '<div class="right-side-links-2-line">' . chr(10);						
									echo '<a  href="' . site_url('members/profile') . '" data-toggle="tooltip" title="Display My Profile">' . $this->session->userdata('member_first_name') . ' ' . $this->session->userdata('member_last_name') . '</a>' . chr(10);
									echo '<br />' . chr(10);
									echo '<a  href="' . site_url('members/dashboard') . '" data-toggle="tooltip" title="Display My Dashboard">Dashboard</a>';
									echo '<span class="link_separator_big">|</span>';
									echo '<a  href="' . site_url('members/sign_out') . '" data-toggle="tooltip" title="Sign Out of the Website">Sign Out</a>';
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
											echo '<a href="' . site_url('members/profile') . '" data-toggle="tooltip" title="Display My Profile">' . chr(10);
												echo img($image_properties) . chr(10);
											echo '</a>' . chr(10);
										echo '</div>' . chr(10);
									//echo '</div>' . chr(10);

								} // end of - file_exists
								

							} else {
								
								echo '<div class="right-side-links-1-line">' . chr(10);
									echo '<a  href="' . site_url('members/sign_up') . '" data-toggle="tooltip" title="Sign Up and become a Member of The Sound Decisions Network">Sign Up</a>';
									echo '<span class="link_separator_big">|</span>';
									echo '<a  href="' . site_url('members/sign_in') . '" data-toggle="tooltip" title="Already a Member of The Sound Decisions Netowrk?  Sign In and Enjoy Yourself">Sign In</a>';
								echo '</div>' . chr(10);
								
							}

						echo '</div>' . chr(10); // end of - header-links
							
					?>
				</header><!-- end of - clearfix -->
			</div><!-- end of - col col-log-12 -->
		</div><!-- end of - row -->	

	</div><!-- end of - container -->	
</div><!-- end of - header_container -->	