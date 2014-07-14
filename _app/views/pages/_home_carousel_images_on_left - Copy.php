<?php
// Set class variables for the image and text holder divs so they can be easily changed.
$div_image_holder = 'col col-xs-12 col-sm-5 col-md-5 col-lg-6';
$div_text_holder = 'col col-xs-12 col-sm-7 col-md-7 col-lg-6';
?>

<!-- Carousel
================================================== -->
<div id="carousel-image-and-text-full" class="carousel slide" data-ride="carousel">

	<!-- Indicators -->
	<!-- <ol class="carousel-indicators">
		<li data-target="#carousel-image-and-text-full" data-slide-to="0" class="active"></li>
		<li data-target="#carousel-image-and-text-full" data-slide-to="1"></li>
		<li data-target="#carousel-image-and-text-full" data-slide-to="2"></li>
	</ol> -->
	<div class="carousel-inner">


		<div class="item active">

			<div class="container">
				<div class="row">
					<div class="col col-md-12">
						
						<div class="slide_content">
							<div class="<?php echo $div_image_holder; ?>">
								<img src="<?php echo base_url("images/carousel/home/movies_500x200.jpg"); ?>" alt="" class="img-responsive img-rounded">							
							</div>
							<div class="<?php echo $div_text_holder; ?>">
								<h4 class="slide-header">Movies</h4>
								<p>Browse, Search and Display Movie Information.</p>	
								<p>Manage your own Movie Collection.</p>
								<div class="hidden-xs">
									<a href="<?php echo site_url("about-movies"); ?>" class="btn btn-danger btn-thin">Display Section</a>																	
								</div>			
								<a href="<?php echo site_url("about-movies"); ?>" class="btn btn-danger btn-thin center-block visible-xs">Display Section</a>												
							</div>							
						</div><!-- end of - slide_content -->						

					</div><!-- end of - col col-md-12 -->
				</div><!-- end of - row -->		
			</div><!-- end of - container -->

		</div><!-- end of - item -->

		<div class="item">

			<div class="container">
				<div class="row">
					<div class="col col-md-12">

						<div class="slide_content">
							<div class="<?php echo $div_image_holder; ?>">
								<img src="<?php echo base_url("images/carousel/home/recipes_500x200.jpg"); ?>" alt="" class="img-responsive img-rounded center-block">
							</div>							
							<div class="<?php echo $div_text_holder; ?>">
								<h4 class="slide-header">Recipes</h4>
								<p>Keep track of the Recipes you use the most.</p>								
								<p>Add Notes to your Recipes indicating different things you have tried and what worked and what didn't.</p>								
								<div class="hidden-xs">
									<a href="<?php echo site_url("about-recipes"); ?>" class="btn btn-danger btn-thin">Display Section</a>																	
								</div>			
								<a href="<?php echo site_url("about-recipes"); ?>" class="btn btn-danger btn-thin center-block visible-xs">Display Section</a>								
							</div>
						</div><!-- end of - slide_content -->

					</div><!-- end of - col col-md-12 -->
				</div><!-- end of - row -->		
			</div><!-- end of - container -->

		</div><!-- end of - item -->

		<div class="item">

			<div class="container">
				<div class="row">
					<div class="col col-md-12">
						
						<div class="slide_content">
							<div class="<?php echo $div_image_holder; ?>">
								<img src="<?php echo base_url("images/carousel/home/links_500x200.jpg"); ?>" alt="" class="img-responsive img-rounded center-block">							
							</div>
							<div class="<?php echo $div_text_holder; ?>">
								<h4 class="slide-header">Links</h4>
								<p>Store all of your favorite Website Links Online so they are available where ever you are.</p>									
								<p>Keep track of Login Information for all of the Websites you have signed up to.  All Information is Encrypted so it is for your eyes only of course.</p>
								<div class="hidden-xs">
									<a href="<?php echo site_url("about-links"); ?>" class="btn btn-danger btn-thin">Display Section</a>																	
								</div>			
								<a href="<?php echo site_url("about-links"); ?>" class="btn btn-danger btn-thin center-block visible-xs">Display Section</a>								
							</div>
						</div><!-- end of - slide_content -->				

					</div><!-- end of - col col-md-12 -->
				</div><!-- end of - row -->		
			</div><!-- end of - container -->

		</div><!-- end of - item -->
		
		
		<div class="item">

			<div class="container">
				<div class="row">
					<div class="col col-md-12">

						<div class="slide_content">
							<div class="<?php echo $div_image_holder; ?>">
								<img src="<?php echo base_url("images/carousel/home/notes_500x200.jpg"); ?>" alt="" class="img-responsive img-rounded center-block">
							</div>							
							<div class="<?php echo $div_text_holder; ?>">
								<h4 class="slide-header">Notes</h4>
								<p>Instead of writing Notes on pieces of paper and have them lying around all over the place.  Create notes here and save them by Category so finding them again is really easy.</p>
								<div class="hidden-xs">
									<a href="<?php echo site_url("about-notes"); ?>" class="btn btn-danger btn-thin">Display Section</a>																	
								</div>			
								<a href="<?php echo site_url("about-notes"); ?>" class="btn btn-danger btn-thin center-block visible-xs">Display Section</a>																
							</div>							
						</div><!-- end of - slide_content -->

					</div><!-- end of - col col-md-12 -->
				</div><!-- end of - row -->		
			</div><!-- end of - container -->

		</div><!-- end of - item -->		
		
		
		<div class="item">

			<div class="container">
				<div class="row">
					<div class="col col-md-12">

						<div class="slide_content">
							<div class="<?php echo $div_image_holder; ?>">
								<img src="<?php echo base_url("images/carousel/home/websites_500x200.jpg"); ?>" alt="" class="img-responsive img-rounded center-block">
							</div>							
							<div class="<?php echo $div_text_holder; ?>">
								<h4 class="slide-header">Our Websites</h4>
								<p>We create some Websites you may find interesting or useful in some way.</p>
								<p>Are you trying to Lose Some Weight?  Check out 'I Want To Be A Loser'.  The Weight Loss Competition/Pool Website.</p>
								<p>Are you a fan of the NFL?  Create and/or Join a NFL Pool and Pick the Winners each week.</p>	
								<div class="hidden-xs">
									<a href="<?php echo site_url("about-websites"); ?>" class="btn btn-danger btn-thin">Display Section</a>																	
								</div>			
								<a href="<?php echo site_url("about-websites"); ?>" class="btn btn-danger btn-thin center-block visible-xs">Display Section</a>															
							</div>
						</div><!-- end of - slide_content -->

					</div><!-- end of - col col-md-12 -->
				</div><!-- end of - row -->		
			</div><!-- end of - container -->

		</div><!-- end of - item -->		

	
	</div><!-- end of - carousel-inner -->

	
	<a class="left carousel-control hidden-xs" href="#carousel-image-and-text-full" data-slide="prev" title="Previous Slide"><span class="glyphicon glyphicon-chevron-left"></span></a>
	<a class="right carousel-control hidden-xs" href="#carousel-image-and-text-full" data-slide="next" title="Next Slide"><span class="glyphicon glyphicon-chevron-right"></span></a>
	
	
	<a class="left carousel-control carousel-control-top visible-xs" href="#carousel-image-and-text-full" data-slide="prev" title="Previous Slide"><span class="glyphicon glyphicon-chevron-left"></span></a>
	<a class="right carousel-control carousel-control-top visible-xs" href="#carousel-image-and-text-full" data-slide="next" title="Next Slide"><span class="glyphicon glyphicon-chevron-right"></span></a>	
	
</div><!-- end of - carousel -->