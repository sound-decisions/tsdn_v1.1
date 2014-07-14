<div class="jumbotron full hidden-xs hidden-sm">
	<div class="container">
		<div class="row">
			<div class="col col-sm-12">
				<img src="<?php echo base_url('images/sdn/the_sound_decisions_network_logo_1000x200.png'); ?>" class="img-responsive center-block" />
			</div>
		</div><!-- end of - row -->
		<div class="row">
			<div class="col col-md-12 col-lg-10 col-lg-offset-1">								
							
				<h3 class="text-center margin-top-10 margin-bottom-10">We Develop Web Applications, Websites and Create Functionality to make your life a little easier, more productive and hopefully a little more fun.</h3>
				
				<div class="text-center">
					<a href="<?php echo site_url('about'); ?>" class="btn btn-danger">ENTER SITE</a>	
				</div>
								
			</div><!-- end of - col-md-12 -->
		</div><!-- end of - row --> 		
	</div><!-- end of - container -->
</div><!-- end of - jumbotron -->


<div class="jumbotron full visible-xs visible-sm">
	<div class="container padding-left-0 padding-right-0">
		<div class="row">
			<div class="col col-sm-12 padding-left-0 padding-right-0">
				<img src="<?php echo base_url('images/sdn/the_sound_decisions_network_logo_2__600x115.png'); ?>" class="img-responsive center-block" />
			</div>
		</div><!-- end of - row --> 
		<div class="col col-xs-12 col-sm-10 col-sm-offset-1">								
			
			<h5 class="text-center text-color margin-top-10 margin-bottom-10">We Develop Web Applications, Websites and Create Functionality to make your life a little easier, more productive and hopefully a little more fun.</h5>			
			
			<div class="text-center margin-bottom-10">
				<a href="<?php echo site_url('about'); ?>" class="btn btn-danger btn-sm">ENTER SITE</a>
			</div>
			
		</div><!-- end of - col -->			
	</div><!-- end of - container -->
</div><!-- end of - jumbotron -->




<?php
// Display the Home Page carousel.
require_once '_home_carousel_images_on_left.php';

//echo '<div class="carousel-underline-bottom visible-xs visible-sm">&nbsp;</div>' . chr(10);
echo '<div class="carousel-underline-top visible-xs visible-sm">&nbsp;</div>' . chr(10);
echo '<div class="carousel-underline-top hidden-xs hidden-sm">&nbsp;</div>' . chr(10);


//require_once '_site_sections_v_1.php';
//require_once '_site_sections_v_2.php';
//require_once '_site_sections_v_3.php';
require_once '_site_sections_v_4.php';
?>