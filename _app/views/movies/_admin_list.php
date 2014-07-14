<?php

$i = 0;

foreach ($movies as $movie) {

	$i++;

	if ($i % 2 == 0) {
		
	} else {
		
	}        	

	// Format content for display.
    $plot_content = ($movie['plot'] != '' ? str_replace(chr(10), '<br />', $movie['plot']) : '');
	
	echo '<div class="row margin-bottom-20">' . chr(10);
	
		echo '<div class="col col-xs-3 col-sm-2 col-md-1">' . chr(10);
			if ($movie['image'] != '') {
				$image_src = base_url(MOVIE_IMAGE_PATH . $movie['image']);
			} else {
				$image_src = $movie['imdb_image_url'];
			}		
			echo '<a href="' . site_url("movies/view/") . '/' . $movie['id'] . '" title="Display Movie Details"">';
				echo '<img src="' . $image_src . '" class="img-responsive img-rounded" />';
			echo '</a>';
		
			//echo '<img src="' . $movie['imdb_image_url'] . '" class="img-responsive img-rounded" />';
		echo '</div>' . chr(10);
		echo '<div class="col col-xs-9 col-sm-10 col-md-11">' . chr(10);
			echo '<h4 class="margin-top-0">' . $movie['title'] . '<span class="extra-content">(' . $movie['year_released'] . ')</span></h4>' . chr(10);
			echo '<h5>';
				echo $movie['runtime'];
				echo '<span class="spacer">-</span>';
				echo $movie['genre'];
				echo '<span class="spacer">-</span>';
				echo $movie['mpaa_rating'];
			echo '</h5>' . chr(10);
			echo '<p>' . $plot_content . '</p>' . chr(10);
			// if ($movie['written_by'] != '') {
				// echo '<h5 class="margin-bottom-0">Written By</h5>' . chr(10);
				// echo '<p>' . $movie['written_by'] . '</p>' . chr(10);
			// }			
			// if ($movie['directed_by'] != '') {
				// echo '<h5 class="margin-bottom-0">Directed By</h5>' . chr(10);
				// echo '<p>' . $movie['directed_by'] . '</p>' . chr(10);
			// }				
			// if ($movie['starring'] != '') {
				// echo '<h5 class="margin-bottom-0">Starring</h5>' . chr(10);
				// echo '<p>' . $movie['starring'] . '</p>' . chr(10);
			// }										
			// if ($movie['produced_by'] != '') {
				// echo '<h5 class="margin-bottom-0">Produced By</h5>' . chr(10);
				// echo '<p>' . $movie['produced_by'] . '</p>' . chr(10);
			// }	
			
			// Admin Links.
			echo '<div class="clearfix border-top">' . chr(10);
				echo '<div class="pull-right">' . chr(10);
					echo '<a href="' . site_url("movies/edit/") . '/' . $movie['id'] . '"><span class="glyphicon glyphicon-pencil action-link">&nbsp;</span></a>' . chr(10);
					echo '<a href="' . site_url("movies/delete/") . '/' . $movie['id'] . '" onclick="return confirm(\'Are you sure you want to delete this Movie?\');"><span class="glyphicon glyphicon-remove action-link">&nbsp;</span></a>' . chr(10);				
				echo '</div>' . chr(10);
			echo '</div>' . chr(10);
					
		echo '</div>' . chr(10);
	echo '</div>' . chr(10); // end of - row		
	
} // end of - foreach


// No records found so display an alert message.
if ($i == 0) {
	echo '<div class="alert alert-danger">No Movies Found.  Enter/Select Search Criteria.</div>' . chr(10);
}


/* End of file _list.php */
/* Location: ./application/views/movies/_list.php */