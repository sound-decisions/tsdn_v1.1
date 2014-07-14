<?php


$i = 0;

echo '<div class="list-group">' . chr(10);

	foreach ($note_categories as $note_category) {
	
		$i++;
	
		if ($i % 2 == 0) {
			$panel_class = 'panel-default';
			$background_color = 'row2';
		} else {
			$panel_class = 'panel-custom';
			$background_color = 'row1';
		}        	
	
		echo '<a href="' . site_url('mdl-notes/by-category/' . $note_category['id']) . '" class="list-group-item thin ' . $background_color . '">';
			echo $note_category['name'];
			echo '<span title="Number of Notes" class="padding-left-10">(' . $note_category['num_records'] . ')</span>' . chr(10);
			//echo '<span title="Number of Links" class="badge">' . $note_category['num_links'] . '</span>' . chr(10);
		echo '</a>' . chr(10);
		         
	} // end of - foreach

echo '</div>' . chr(10);


// No records found so display an alert message.
if ($i == 0) {
	echo '<div class="alert alert-danger">No Note Categories Found</div>' . chr(10);
}   
			
/* End of file _list_group_menu.php */
/* Location: ./application/views/mdl_note_categories/_list_group_menu.php */	
			