<div class="container">

	<?php
	// If a message has been set then display it.
	if ($this->session->flashdata("message") !== FALSE) {
		echo '<div class="row">' . chr(10);
			echo '<div class="col col-md-12">' . chr(10);
				echo '<div class="alert ' . $this->session->flashdata("message_class") . '">' . $this->session->flashdata("message") . '</div>' . chr(10);
			echo '</div><!-- end of - col col-md-12 -->' . chr(10);
		echo '</div><!-- end of - row -->' . chr(10);
	}
	?>

	<div class="row">
		<div class="col col-md-12">

			<?php
			echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);
			?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
	<div class="row">
		<!-- <div class="col col-md-12"> -->
			
			<?php
	        foreach ($recipe_categories as $recipe_category) {
	        	
				//echo '<div class="isotope js-isotope" data-isotope-options=\'{ "layoutMode": "fitColumns", "itemSelector": ".item" }\'>' . chr(10);
				echo '<div class="isotope">' . chr(10);
				
					//echo '<div class="col col-xs-6 col-sm-4 col-md-3">' . chr(10);
					echo '<div class="col col-xs-6 col-sm-4 col-md-3 col-lg-2 item margin-bottom-20">' . chr(10);
					//echo '<div class="item">' . chr(10);
						//echo '<div class="thumbnail">' . chr(10);
						
							$image_properties = array(
							          'src' => base_url(RECIPE_CATEGORY_PHOTOS_PATH . $recipe_category['photo']),
							          'alt' => 'Recipe Category Photo',
							          'class' => 'img-responsive img-rounded',
							          //'width' => '200',
							          // 'height' => '300',
							          'title' => $recipe_category['name'],
							);
							echo '<a href="' . site_url('recipes/by-category/' . $recipe_category['id']) . '">';
							// With tooltip
							//echo '<a href="' . site_url('recipes/by-category/' . $recipe_category['id']) . '" data-toggle="tooltip" title="' . $recipe_category['name'] . '">';
								echo img($image_properties);							
							echo '</a>' . chr(10);
							
							// echo '<div class="caption">' . chr(10);						
								echo '<a href="' . site_url('recipes/by-category/' . $recipe_category['id']) . '">';
									echo '<h6 class="text-center margin-top-10">' . $recipe_category['name'] . '</h6>' . chr(10);
								echo '</a>' . chr(10);
							// echo '</div>' . chr(10); // end of - caption
							
						//echo '</div>' . chr(10); // end of - thumbnail
					echo '</div>' . chr(10);
	
				echo '</div>' . chr(10);
				
	        } // end of - foreach
			?>
		
		<!-- </div> --><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->	
</div><!-- end of - container -->