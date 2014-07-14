<?php


$i = 0;

foreach ($movies as $movie) {

	$i++;

	if ($i == 1) {
		echo '<table>' . chr(10);
	}

	if ($i % 2 == 0) {
		
	} else {
		
	}        	

	// Format content for display.
    $plot_content = ($movie['plot'] != '' ? str_replace(chr(10), '<br />', $movie['plot']) : '');

	echo '<tr>' . chr(10);
		echo '<td class="nowrap">';
			echo $movie['title'];
		echo '</td>' . chr(10);
		echo '<td>';
			echo $plot_content;
		echo '</td>' . chr(10);		
	echo '</tr>' . chr(10);


} // end of - foreach


if ($i > 0) {
	echo '</table>' . chr(10);
}


// No records found so display an alert message.
if ($i == 0) {
	echo '<div class="alert alert-danger">No Movies Found</div>' . chr(10);
}


/* End of file _list.php */
/* Location: ./application/views/movies/_list.php */