<?php


$i = 0;

echo '<div class="list-group">' . chr(10);

	foreach ($link_categories as $link_category) {
	
		$i++;
	
		if ($i % 2 == 0) {
			$panel_class = 'panel-default';
			$background_color = 'row2';
		} else {
			$panel_class = 'panel-custom';
			$background_color = 'row1';
		}        	
	
		echo '<a href="' . site_url('mdl-links/by-category/' . $link_category['id']) . '" class="list-group-item thin ' . $background_color . '">';
			echo $link_category['name'];
			echo '<span title="Number of Links" class="padding-left-10">(' . $link_category['num_links'] . ')</span>' . chr(10);
			//echo '<span title="Number of Links" class="badge">' . $link_category['num_links'] . '</span>' . chr(10);
		echo '</a>' . chr(10);
		         
	} // end of - foreach

echo '</div>' . chr(10);


// No records found so display an alert message.
if ($i == 0) {
	echo '<div class="alert alert-danger">No Link Category Found</div>' . chr(10);
}   
			
/* End of file _list_group_menu.php */
/* Location: ./application/views/mdl_link_categories/_list_group_menu.php */	
			