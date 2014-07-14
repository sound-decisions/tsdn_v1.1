<?php
if ($displayed_from_page != 'dashboard') {
	echo '<div class="col col-sm-6">' . chr(10);
}
?>


	<h4 class="page_title">Sections</h4>
	
	<div class="clearfix margin-bottom-20">
		<a href="<?php echo site_url('about-movies'); ?>">
			<div class="col-xs-3 col-sm-3 col-md-2 padding-left-0">
				<img src="<?php echo base_url("images/graphics/movies_200.png"); ?>" alt="" class="img-responsive">
			</div>
			<div class="col-xs-9 col-sm-9 col-md-10 padding-right-0">	
				<h4 class="margin-top-0">Movies</h4>															
				<p class="margin-bottom-0">Keep track of your movie collection, Indicate what movies you want to see, you have seen, you will watch again.</p>					
			</div>
		</a>
	</div>
	
	<div class="clearfix margin-bottom-20">
		<a href="<?php echo site_url('about-recipes'); ?>">
			<div class="col-xs-3 col-sm-3 col-md-2 padding-left-0">
				<img src="<?php echo base_url("images/graphics/recipes_200.png"); ?>" alt="" class="img-responsive">
			</div>
			<div class="col-xs-9 col-sm-9 col-md-10 padding-right-0">	
				<h4 class="margin-top-0">Recipes</h4>								
				<p class="margin-bottom-0">Our Recipe Section is more of a Log that indicates the original Recipe used and then Notes to indicate the number of variations or options you have for making it.</p>						
			</div>
		</a>
	</div>			
	
	<div class="clearfix margin-bottom-20">
		<a href="<?php echo site_url('about-links'); ?>">
			<div class="col-xs-3 col-sm-3 col-md-2 padding-left-0">
				<img src="<?php echo base_url("images/graphics/links_200.png"); ?>" alt="" class="img-responsive">
			</div>
			<div class="col-xs-9 col-sm-9 col-md-10 padding-right-0">	
				<h4 class="margin-top-0">Links</h4>								
				<p class="margin-bottom-0">Store your favorite website urls by category and they will be available to you where ever you happen to be.</p>						
			</div>
		</a>
	</div>				
	
	<div class="clearfix margin-bottom-20">
		<a href="<?php echo site_url('about-notes'); ?>">
			<div class="col-xs-3 col-sm-3 col-md-2 padding-left-0">
				<img src="<?php echo base_url("images/graphics/notes_200.png"); ?>" alt="" class="img-responsive">
			</div>
			<div class="col-xs-9 col-sm-9 col-md-10 padding-right-0">	
				<h4 class="margin-top-0">Notes</h4>								
				<p class="margin-bottom-0">Instead of using Post It notes or writing things on various pieces of paper, create and save Notes here.  Categories and Sub-Categories will make them easy to find.</p>						
			</div>
		</a>
	</div>		
	
	<div class="clearfix margin-bottom-20">
		<a href="<?php echo site_url('about-websites'); ?>">
			<div class="col-xs-3 col-sm-3 col-md-2 padding-left-0">
				<img src="<?php echo base_url("images/graphics/websites_200.png"); ?>" alt="" class="img-responsive">
			</div>
			<div class="col-xs-9 col-sm-9 col-md-10 padding-right-0">	
				<h4 class="margin-top-0">Websites</h4>								
				<p class="margin-bottom-0">We create many Websites based on ideas we come up with.  You might find some of these interesting, entertaining or useful in some way.</p>						
			</div>
		</a>
	</div>				

<?php
if ($displayed_from_page != 'dashboard') {
	echo '</div><!-- end of - col col-sm-6-->' . chr(10);
}
?>