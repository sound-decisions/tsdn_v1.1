
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
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand visible-xs" href="<?php echo site_url('home'); ?>">The Sound Decisions Network</a>
			<!-- <a class="navbar-brand" href="<?php echo site_url('home'); ?>">Up and Running</a> -->
			<!-- <a class="navbar-brand" href="<?php echo site_url('home'); ?>"><img src="<?php echo base_url("images/sdn/the_sound_decisions_header_logo_yellow_350x60_ul.png"); ?>" class="img-responsive" id="header-logo" /></a> -->
		</div><!-- end of - navbar-header -->

		<div class="navbar-collapse collapse">

			
			<?php		
			echo '<ul class="nav navbar-nav">' . chr(10);
				echo '<li ' . (@$top_menu == 'Home' ? 'class="active"' : '') . '><a href="' . site_url('home') . '">Home</a></li>' . chr(10);
				echo '<li ' . (@$top_menu == 'About' ? 'class="active"' : '') . '><a href="' . site_url('about') . '">About</a></li>' . chr(10);
				echo '<li ' . (@$top_menu == 'Movies' ? 'class="active"' : '') . '><a href="' . site_url('movies') . '">Movies</a></li>' . chr(10);					
				
				// Display the receipes dropdown if a member is signed in.
				if ($this->session->userdata('member_id') != '') {
					
					echo '<li class="dropdown' . (@$top_menu == 'Recipes' ? ' active' : '') . '">' . chr(10);
						echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Recipes <b class="caret"></b></a>' . chr(10);
						echo '<ul class="dropdown-menu">' . chr(10);
							//echo '<li ' . (@$dropdown_menu == 'By Category' ? 'class="active"' : '') . '><a href="' . site_url('recipe-categories/select') . '">By Category</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'By Category' ? 'class="active"' : '') . '><a href="' . site_url('recipes/by-category/0') . '">By Category</a></li>' . chr(10);
							// Display the following menu items if a member is signed in.
							if ($this->session->userdata('member_id') != '') {
								echo '<li ' . (@$dropdown_menu == 'My Recipes' ? 'class="active"' : '') . '><a href="' . site_url('recipes/my-recipes') . '">My Recipes</a></li>' . chr(10);
							}
							//echo '<li ' . (@$dropdown_menu == 'Recipes' ? 'class="active"' : '') . '><a href="' . site_url('recipes') . '">All Recipes</a></li>' . chr(10);
							// Display the following menu items if a member is signed in.
							if ($this->session->userdata('member_id') != '') {						
								echo '<li ' . (@$dropdown_menu == 'Add A Recipe' ? 'class="active"' : '') . '><a href="' . site_url('recipes/add') . '">Add A Recipe</a></li>' . chr(10);
							}
							echo '<li ' . (@$dropdown_menu == 'Cooking Hints' ? 'class="active"' : '') . '><a href="' . site_url('cooking_hints') . '">Cooking Hints</a></li>' . chr(10);
						echo '</ul>' . chr(10);
					echo '</li>' . chr(10); // end of - recipes
					
					echo '<li class="dropdown' . (@$top_menu == 'Links' ? ' active' : '') . '">' . chr(10);
						echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Links <b class="caret"></b></a>' . chr(10);
						echo '<ul class="dropdown-menu">' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Links By Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links/by-category/0') . '">Links By Category</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Link Categories' ? 'class="active"' : '') . '><a href="' . site_url('mdl-link-categories') . '">Link Categories</a></li>' . chr(10);
							//echo '<li ' . (@$dropdown_menu == 'Grouped By Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links/list-gbc') . '">Link List Grouped By Category</a></li>' . chr(10);
							echo '<li class="divider"></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Add A Link' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links/add') . '">Add A Link</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Add A Link Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-link-categories/add') . '">Add A Link Category</a></li>' . chr(10);
						echo '</ul>' . chr(10);
					echo '</li>' . chr(10); // end of - links
					
					echo '<li class="dropdown' . (@$top_menu == 'Notes' ? ' active' : '') . '">' . chr(10);
						echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Notes <b class="caret"></b></a>' . chr(10);
						echo '<ul class="dropdown-menu">' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Notes By Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-notes/by-category/0') . '">Notes By Category</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Note Categories' ? 'class="active"' : '') . '><a href="' . site_url('mdl-note-categories') . '">Note Categories</a></li>' . chr(10);
							//echo '<li ' . (@$dropdown_menu == 'Grouped By Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-notes/list-gbc') . '">Note List Grouped By Category</a></li>' . chr(10);
							echo '<li class="divider"></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Add A Note' ? 'class="active"' : '') . '><a href="' . site_url('mdl-notes/add') . '">Add A Note</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Add A Note Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-note-categories/add') . '">Add A Note Category</a></li>' . chr(10);
						echo '</ul>' . chr(10);
					echo '</li>' . chr(10); // end of - notes					
					
				} else {
					//echo '<li ' . (@$top_menu == 'Recipes' ? 'class="active"' : '') . '><a href="' . site_url('recipe_categories/select') . '">Recipes</a></li>' . chr(10);
					//echo '<li ' . (@$top_menu == 'Recipes' ? 'class="active"' : '') . '><a href="' . site_url('recipes/by-category/0') . '">Recipes</a></li>' . chr(10);
				} // end of - members only
							
				echo '<li class="dropdown' . (@$top_menu == 'Websites' ? ' active' : '') . '">' . chr(10);
					echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Websites <b class="caret"></b></a>' . chr(10);
					echo '<ul class="dropdown-menu">' . chr(10);
						echo '<li ' . (@$dropdown_menu == 'I Want To Be A Loser' ? 'class="active"' : '') . '><a href="' . site_url('websites/i-want-to-be-a-loser') . '">I Want To Be A Loser</a></li>' . chr(10);
						echo '<li ' . (@$dropdown_menu == 'My Movie Collection' ? 'class="active"' : '') . '><a href="' . site_url('websites/my-movie-collection') . '">My Movie Collection</a></li>' . chr(10);
						echo '<li ' . (@$dropdown_menu == 'NFL Football Pool' ? 'class="active"' : '') . '><a href="' . site_url('websites/nfl-football-pool') . '">NFL Football Pool</a></li>' . chr(10);
						echo '<li ' . (@$dropdown_menu == 'The Link Vault' ? 'class="active"' : '') . '><a href="' . site_url('websites/the-link-vault') . '">The Link Vault</a></li>' . chr(10);
					echo '</ul>' . chr(10);
				echo '</li>' . chr(10); // end of - websites							
							
				echo '<li ' . (@$top_menu == 'News' ? 'class="active"' : '') . '><a href="' . site_url('news') . '">News</a></li>' . chr(10);
				echo '<li ' . (@$top_menu == 'Contact' ? 'class="active"' : '') . '><a href="' . site_url('contact_messages/add') . '">Contact</a></li>' . chr(10);
			echo '</ul>' . chr(10);

			echo '<ul class="nav navbar-nav navbar-right">' . chr(10);			
			
				// Only display the admin menu dropdown for admins.
				if ($this->session->userdata('member_access') == 'admin') {
							
					echo '<li class="dropdown yamm-fw' . (@$top_menu == 'Admin Menu' ? ' active' : '') . '">' . chr(10);
						echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin Menu <b class="caret"></b></a>' . chr(10);
						echo '<ul class="dropdown-menu">' . chr(10);
	
							echo '<li>' . chr(10);
								echo '<div class="row">' . chr(10);
	
									echo '<div class="yamm-content">' . chr(10);
	
										echo '<div class="col-sm-4">' . chr(10);
											echo '<ul class="dropdown-menu-fw">' . chr(10);
												echo '<li class="dropdown-section-header"><h4>Standard Admin Section</h4></li>' . chr(10);
												echo '<li class="dropdown-header">Members</li>' . chr(10);
												echo '<li ' . (@$dropdown_menu == 'Member List' ? 'class="active"' : '') . '><a href="' . site_url('members') . '">Member List</a></li>' . chr(10);
												echo '<li class="dropdown-header">Contact Messages</li>' . chr(10);
												echo '<li ' . (@$dropdown_menu == 'Contact Messages' ? 'class="active"' : '') . '><a href="' . site_url('contact_messages') . '">Contact Messages</a></li>' . chr(10);
												echo '<li class="dropdown-header">News</li>' . chr(10);
												echo '<li ' . (@$dropdown_menu == 'Add A News Item' ? 'class="active"' : '') . '><a href="' . site_url('news/add') . '">Add A News Item</a></li>' . chr(10);
											echo '</ul>' . chr(10);
										echo '</div>' . chr(10);
	
										echo '<div class="col-sm-4">' . chr(10);
											echo '<ul class="dropdown-menu-fw">' . chr(10);
												echo '<li class="dropdown-section-header"><h4>Website Sections</h4></li>' . chr(10);
												//echo '<li class="divider"></li>' . chr(10);
												echo '<li class="dropdown-header">Movies</li>' . chr(10);
												echo '<li ' . (@$dropdown_menu == 'Movies' ? 'class="active"' : '') . '><a href="' . site_url('movies/admin-list') . '">Movie List</a></li>' . chr(10);
												//echo '<li ' . (@$top_menu == 'Movie Search Results' ? 'class="active"' : '') . '><a href="' . site_url('movies/admin-search') . '">Movie List/Search</a></li>' . chr(10);
												echo '<li ' . (@$dropdown_menu == 'Add A Movie' ? 'class="active"' : '') . '><a href="' . site_url('movies/add') . '">Add A Movie</a></li>' . chr(10);
												echo '<li ' . (@$dropdown_menu == 'Search IMDB' ? 'class="active"' : '') . '><a href="' . site_url('movies/imdb-search') . '">Search IMDB</a></li>' . chr(10);											
												echo '<li class="dropdown-header">Recipes</li>' . chr(10);
												echo '<li ' . (@$dropdown_menu == 'Recipes' ? 'class="active"' : '') . '><a href="' . site_url('recipes/admin-list') . '">Recipe List</a></li>' . chr(10);
												echo '<li ' . (@$dropdown_menu == 'Recipe Categories' ? 'class="active"' : '') . '><a href="' . site_url('recipe_categories') . '">Recipe Categories</a></li>' . chr(10);
												echo '<li ' . (@$dropdown_menu == 'Add A Recipe Category' ? 'class="active"' : '') . '><a href="' . site_url('recipe_categories/add') . '">Add A Recipe Category</a></li>' . chr(10);
												echo '<li class="dropdown-header">Cooking Hints</li>' . chr(10);
												echo '<li ' . (@$dropdown_menu == 'Add A Cooking Hint' ? 'class="active"' : '') . '><a href="' . site_url('cooking_hints/add') . '">Add A Cooking Hint</a></li>' . chr(10);
											echo '</ul>' . chr(10);
										echo '</div>' . chr(10);
	
										echo '<div class="col-sm-4">' . chr(10);
											echo '<ul class="dropdown-menu-fw">' . chr(10);
												echo '<li class="dropdown-section-header"><h4>My Daily Life</h4></li>' . chr(10);
												echo '<li class="dropdown-header">Links</li>' . chr(10);
												echo '<li ' . (@$dropdown_menu == 'Link List' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links') . '">Link List</a></li>' . chr(10);
												echo '<li ' . (@$dropdown_menu == 'Link List Grouped By Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links/list-gbc') . '">Link List Grouped By Category</a></li>' . chr(10);
												//echo '<li ' . (@$dropdown_menu == 'Add A Link' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links/add') . '">Add A Link</a></li>' . chr(10);
												echo '<li ' . (@$dropdown_menu == 'Admin Link Categories' ? 'class="active"' : '') . '><a href="' . site_url('mdl-link-categories/admin-list') . '">Link Category List</a></li>' . chr(10);
												//echo '<li ' . (@$dropdown_menu == 'Add A Link Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-link-categories/add') . '">Add A Link Category</a></li>' . chr(10);
												echo '<li class="dropdown-header">Notes</li>' . chr(10);
												echo '<li ' . (@$dropdown_menu == 'Note List' ? 'class="active"' : '') . '><a href="' . site_url('mdl-notes') . '">Note List</a></li>' . chr(10);
												echo '<li ' . (@$dropdown_menu == 'Note List Grouped By Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-notes/list-gbc') . '">Notes List Grouped By Category</a></li>' . chr(10);
												//echo '<li ' . (@$dropdown_menu == 'Add A Note' ? 'class="active"' : '') . '><a href="' . site_url('mdl-notes/add') . '">Add A Note</a></li>' . chr(10);
												echo '<li ' . (@$dropdown_menu == 'Note Categories' ? 'class="active"' : '') . '><a href="' . site_url('mdl-note-categories/admin-list') . '">Note Category List</a></li>' . chr(10);
												//echo '<li ' . (@$dropdown_menu == 'Add A Note Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-note-categories/add') . '">Add A Note Category</a></li>' . chr(10);
											echo '</ul>' . chr(10);
										echo '</div>' . chr(10);
	
									echo '</div>' . chr(10); // end of - yamm-content							
	
								echo '</div>' . chr(10); // end of - row
	
							echo '</li>' . chr(10);
							
						echo '</ul>' . chr(10);
					echo '</li>' . chr(10); // end of - dropdown yamm-fw
					
				} // end of - admin menu			

			echo '</ul>' . chr(10);
			?>
			

		</div><!-- end of - nav-collapse -->

	</div><!-- end of - container -->
</div><!-- end of - navbar navbar-default navbar-fixed-top -->


<div class="body-container">
