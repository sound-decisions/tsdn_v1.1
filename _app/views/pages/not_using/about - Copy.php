<div class="container">
	<div class="row">
		<div class="col col-sm-6">

			<h4 class="page_title"><?php echo $title; ?></h4>

			<p>As a Company, <strong>Sound Decisions</strong> and all of our Developers, create many Websites that are built to make our lives easier in some way, either at work, at home or in some cases both.</p>
			<p>We are on our computers all the time as I'm sure you can imagine, because of this, we come up with some ideas for Websites or parts of Websties that can really simplify things for us.</p>
			<p>When others see these websites or we tell them about them, we are often asked to make them available to them as well because they see how it would be cool thing to be able to use.</p>
			<p><strong>The Sound Decisions Network</strong> was created because of this.  
				We needed a place to make this Funcitonality and some of our other Websites we create and work on available to family and friends and now the general public.</p>
			<p>As we come up with new ideas we will also be adding them here.  
				Not only to make them available to others but this is also where we go to use this functionality ourselves.</p>
			<p>If you have any ideas for new Websites or new Functionality in any of our Websites please fill out our <a href="<?php echo site_url('contact_messages/add'); ?>">Contact Form</a> and let us know.</p>		

			<?php
			if ($this->session->userdata('member_id') == '') {	
			?>

			<div class="margin-top margin-bottom">
				<div class="text-center">
					<a href="<?php echo site_url('members/sign_up'); ?>" class="btn btn-danger padding-left-20 padding-right-20">Sign Up</a>
					<span class="padding-left-10 padding-right-10">or</span>
					<a href="<?php echo site_url('members/sign_in'); ?>" class="btn btn-danger padding-left-20 padding-right-20">Sign in</a>
				</div>
			</div>
			
			<?php
			}
			?>

		</div><!-- end of - col col-sm-6 -->
		<div class="col col-sm-6">
		
			<h4 class="page_title">Sections</h4>
			
			<div class="clearfix margin-bottom-20">
				<a href="<?php echo site_url('about-movies'); ?>">
					<div class="col-xs-4 col-sm-4 col-md-2 padding-left-0">
						<img src="<?php echo base_url("images/graphics/movies_200.png"); ?>" alt="" class="img-responsive">
					</div>
					<div class="col-xs-8 col-sm-8 col-md-10 padding-right-0">	
						<h4 class="margin-top-0">Movies</h4>															
						<p class="margin-bottom-0">Keep track of your movie collection.  
							Indicate what movies you want to see, you have seen, you will watch again.  
							Rate and write reivews for movies you have seen and make them available to other <strong>The Sound Decisions Network</strong> members.</p>					
					</div>
				</a>
			</div>
			
			<div class="clearfix margin-bottom-20">
				<a href="<?php echo site_url('about-recipes'); ?>">
					<div class="col-xs-4 col-sm-4 col-md-3 padding-left-0">
						<img src="<?php echo base_url("images/graphics/recipes_200.png"); ?>" alt="" class="img-responsive">
					</div>
					<div class="col-xs-8 col-sm-8 col-md-9 padding-right-0">	
						<h4 class="margin-top-0">Recipes</h4>								
						<p class="margin-bottom-0">This isn't the usual Recipe Website, there are a number of them available online already.  
							Instead, our Recipe Section is more of a Log that indicates the original Recipe used and then Notes to indicate the number of variations or options you have for making it.</p>						
					</div>
				</a>
			</div>			
			
			<div class="clearfix margin-bottom-20">
				<a href="<?php echo site_url('about-links'); ?>">
					<div class="col-xs-4 col-sm-4 col-md-3 padding-left-0">
						<img src="<?php echo base_url("images/graphics/links_200.png"); ?>" alt="" class="img-responsive">
					</div>
					<div class="col-xs-8 col-sm-8 col-md-9 padding-right-0">	
						<h4 class="margin-top-0">Links</h4>								
						<p class="margin-bottom-0">Store your favorite links by category and they will be available to you where ever you happen to be.  
							Pretty soon you will be able to save Login Information as well - they will be encrypted for your protection of course.</p>						
					</div>
				</a>
			</div>				
			
			<div class="clearfix margin-bottom-20">
				<a href="<?php echo site_url('about-notes'); ?>">
					<div class="col-xs-4 col-sm-4 col-md-3 padding-left-0">
						<img src="<?php echo base_url("images/graphics/notes_200.png"); ?>" alt="" class="img-responsive">
					</div>
					<div class="col-xs-8 col-sm-8 col-md-9 padding-right-0">	
						<h4 class="margin-top-0">Notes</h4>								
						<p class="margin-bottom-0">Instead of using Post It notes or writing things on various pieces of paper, create and save Notes on <strong>The Sound Decisions Network</strong> by Category and read, edit or delete them when ever you want to.</p>						
					</div>
				</a>
			</div>		
			
			<div class="clearfix margin-bottom-20">
				<a href="<?php echo site_url('about-websites'); ?>">
					<div class="col-xs-4 col-sm-4 col-md-3 padding-left-0">
						<img src="<?php echo base_url("images/graphics/websites_200.png"); ?>" alt="" class="img-responsive">
					</div>
					<div class="col-xs-8 col-sm-8 col-md-9 padding-right-0">	
						<h4 class="margin-top-0">Websites</h4>								
						<p class="margin-bottom-0">We create many Websites based on ideas we come up with.  You might find some of these interesting, entertaining or useful in some way.</p>						
					</div>
				</a>
			</div>				
		
		</div><!-- end of - col col-sm-6-->
	</div><!-- end of - row -->
</div><!-- end of - container -->