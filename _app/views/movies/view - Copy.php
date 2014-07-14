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
		<div class="col col-md-12">

			<?php
			// Format content for display.
		    $plot_content = ($movie->plot != '' ? str_replace(chr(10), '<br />', $movie->plot) : '');


			echo '<div class="col col-xs-4 col-sm-3">' . chr(10);
				if ($movie->image != '') {
					$image_src = base_url(MOVIE_IMAGE_PATH . $movie->image);
				} else {
					$image_src = $movie->imdb_image_url;
				}				
				echo '<img src="' . $image_src . '" class="img-responsive img-rounded" />';
			echo '</div>' . chr(10);
			echo '<div class="col col-xs-8 col-sm-9">' . chr(10);
				echo '<h4 class="margin-top-0">' . $movie->title . '<span class="extra-content">(' . $movie->year_released . ')</span></h4>' . chr(10);
				echo '<h5>';
					echo $movie->runtime;
					echo '<span class="spacer">-</span>';
					echo $movie->genre;
					echo '<span class="spacer">-</span>';
					echo $movie->mpaa_rating;
				echo '</h5>' . chr(10);
				echo '<p>' . $plot_content . '</p>' . chr(10);
				if ($movie->written_by != '') {
					echo '<h5 class="margin-bottom-0">Written By</h5>' . chr(10);
					//echo '<p>' . $movie->written_by . '</p>' . chr(10);
					echo '<p>';
						$names = explode(", ", $movie->written_by);
						for ($i = 0; $i < count($names); $i++) {
							if ($i > 0) {
								echo ', ';
							}
							$name = $names[$i];
							// Remove all text in parenthesis and the opening and closing parenthesis themselves.
							$name = trim(preg_replace("/\([^)]+\)/", "", $name));
							// Remove periods.  They cause problems.
							//$name = str_replace('.', '', $name);
							$name_value = str_replace(' ', '_', $name);
							$name_value = urlencode(urlencode($name_value));
							echo '<a href="' . site_url("movies/get-search-results/") . '/' . $name_value . '">' . $name . '</a>';
						} // end of - for
					echo '</p>' . chr(10);
				}			
				if ($movie->directed_by != '') {
					echo '<h5 class="margin-bottom-0">Directed By</h5>' . chr(10);
					//echo '<p>' . $movie->directed_by . '</p>' . chr(10);
					echo '<p>';
						$names = explode(", ", $movie->directed_by);
						for ($i = 0; $i < count($names); $i++) {
							if ($i > 0) {
								echo ', ';
							}
							$name = $names[$i];
							// Remove periods.  They cause problems.
							//$name = str_replace('.', '', $name);
							$name_value = str_replace(' ', '_', $name);
							$name_value = urlencode(urlencode($name_value));
							echo '<a href="' . site_url("movies/get-search-results/") . '/' . $name_value . '">' . $name . '</a>';
						} // end of - for
					echo '</p>' . chr(10);
				}				
				if ($movie->starring != '') {
					echo '<h5 class="margin-bottom-0">Starring</h5>' . chr(10);
					//echo '<p>' . $movie->starring . '</p>' . chr(10);
					echo '<p>';
						$names = explode(", ", $movie->starring);
						for ($i = 0; $i < count($names); $i++) {
							if ($i > 0) {
								echo ', ';
							}
							$name = $names[$i];
							// Remove periods.  They cause problems.
							//$name = str_replace('.', '', $name);
							$name_value = str_replace(' ', '_', $name);
							$name_value = urlencode(urlencode($name_value));
							echo '<a href="' . site_url("movies/get-search-results/") . '/' . $name_value . '">' . $name . '</a>';
						} // end of - for
					echo '</p>' . chr(10);
				}										
				if ($movie->produced_by != '') {
					echo '<h5 class="margin-bottom-0">Produced By</h5>' . chr(10);
					//echo '<p>' . $movie->produced_by . '</p>' . chr(10);
					echo '<p>';
						$names = explode(", ", $movie->produced_by);
						for ($i = 0; $i < count($names); $i++) {
							if ($i > 0) {
								echo ', ';
							}
							$name = $names[$i];
							// Remove periods.  They cause problems.
							//$name = str_replace('.', '', $name);
							$name_value = str_replace(' ', '_', $name);
							$name_value = urlencode(urlencode($name_value));
							echo '<a href="' . site_url("movies/get-search-results/") . '/' . $name_value . '">' . $name . '</a>';
						} // end of - for
					echo '</p>' . chr(10);
				}	
				
				
				
				// Display member and admin links if a member is signed in and the member has admin access.
				echo '<div class="clearfix border-top">' . chr(10);
					echo '<div class="pull-right">' . chr(10);				
					
						// Handle member_movies data if a member is signed in.
						if ($this->session->userdata('member_id') != '') {
							
							if ($movie->on_watch_list == 'yes') {								
								$button_class = 'btn-success';
							} else {								
								$button_class = 'btn-default';
							}							
							// Indicate if this link is being displayed using the my_watch_list function.
							// Done by adding the class 'watch-list' to the link.
							if ($function_name == 'my_watch_list') {																	
								echo '<button type="button" id="toggle-on-watch-list-' . $movie->id . '-' . $movie->member_movie_id . '" class="btn ' . $button_class . ' btn-xs toggle-on-watch-list watch-list margin-bottom-5">Watch List</button>' . chr(10);								
							} else {								
								echo '<button type="button" id="toggle-on-watch-list-' . $movie->id . '-' . $movie->member_movie_id . '" class="btn ' . $button_class . ' btn-xs toggle-on-watch-list margin-bottom-5">Watch List</button>' . chr(10);
							}
							
							
							if ($movie->seen_it == 'yes') {
								$button_class = 'btn-success';
							} else {
								$button_class = 'btn-default';
							}							
							echo '<button type="button" id="toggle-seen-it-' . $movie->id . '-' . $movie->member_movie_id . '" class="btn ' . $button_class . ' btn-xs toggle-seen-it margin-bottom-5">Seen It</button>' . chr(10);
						
						} // end of - member links.						
					
				
						// If the signed in member has admin access make sure there is separation in the buttons when displayed on a smartphone.
						if (($this->session->userdata('member_id') != '') && ($this->session->userdata('member_access') == 'admin')) {
							echo '<br class="visible-xs">';
						}				
				
						// Admin Links.
						if ($this->session->userdata('member_access') == 'admin') {
							
							if ($movie->featured == 'yes') {
								$button_class = 'btn-success';
							} else {
								$button_class = 'btn-default';
							}							
							echo '<button type="button" id="toggle-featured-' . $movie->id . '" class="btn ' . $button_class . ' btn-xs toggle-featured margin-bottom-5">Featured</button>' . chr(10);
							echo '<a href="' . site_url("movies/edit/") . '/' . $movie->id . '" class="btn btn-danger btn-xs margin-bottom-5"><span class="glyphicon glyphicon-pencil"></span> Edit</a>' . chr(10);
							echo '<a href="' . site_url("movies/delete/") . '/' . $movie->id . '"  class="btn btn-danger btn-xs margin-bottom-5" onclick="return confirm(\'Are you sure you want to delete this Movie?\');"><span class="glyphicon glyphicon-remove"></span> Delete</a>' . chr(10);
																																				
						} // end of - admin links.
	
					echo '</div>' . chr(10);
				echo '</div>' . chr(10); // end of - member and admin links.
				
			echo '</div>' . chr(10);
			?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->