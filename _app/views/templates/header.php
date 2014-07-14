
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



<?php
include_once('_top_nav_with_yamm.php');
?>


<div class="body-container">
