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
		<div class="col col-md-8">

			<?php
			echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);


			echo '<div class="margin-bottom">' . chr(10);

				// Display the members most visited links.
				echo '<div class="margin-bottom-20">' . chr(10);
					echo '<h4 class="section_title">20 Most Visited Links</h4>' . chr(10);
					echo $mdl_links_view . chr(10);
				echo '</div>' . chr(10);					

				// Display the My Recipes block of view code.
				echo '<div class="margin-bottom-20">' . chr(10);
					echo '<h4 class="section_title">My Recipes</h4>' . chr(10);
					echo $my_recipes_view . chr(10);
				echo '</div>' . chr(10);

			echo '</div>' . chr(10);
			?>

		</div><!-- end of - col col-md-8 -->
		<div class="col col-md-4">

			<?php
			echo '<h4 class="page_title">Latest News</h4>' . chr(10);


			echo '<div class="list-group margin-bottom-20">' . chr(10);

	        	foreach ($latest_news as $news_item) {
	            						
	            	echo '<a href="' . site_url("news/view/") . '/' . $news_item['id'] . '" class="list-group-item thin">';
						echo '<div class="clearfix">';
							echo '<div class="list-item-icon">';
								echo '<img src="' . base_url("images/graphics/news_75.png") . '" class="img-responsive" />';
							echo '</div>';
							echo '<div class="list-item-text">';
								echo $news_item['headline'];
							echo '</div>';
						echo '</div>';
					echo '</a>' . chr(10);
					
	        	} // end of - foreach

			echo '</div>' . chr(10);	
			
			
			// Display the Sections Content.
			echo $sections_view . chr(10);        
			?>

		</div><!-- end of - col col-md-4 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->