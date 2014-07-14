<?php

$i = 0;

foreach ($links as $link) {

	$i++;

	if ($i % 2 == 0) {
		$panel_class = 'panel-default';
		$background_color = 'row2';
	} else {
		$panel_class = 'panel-custom';
		$background_color = 'row1';
	}        	

	if ($i == 1) {
		echo '<ul class="list-group margin-bottom-20">' . chr(10);
	}
	
	// Create the links.		
	$details_link = '<a href="' . site_url("mdl-links/view/") . '/' . $link['id'] . '" class="btn btn-success btn-thin">Details</a>';
	$edit_link = '<a href="' . site_url("mdl-links/edit/") . '/' . $link['id'] . '" class="btn btn-primary btn-thin">Edit</a>';
	$delete_link = '<a href="' . site_url("mdl-links/delete/") . '/' . $link['id'] . '" onclick="return confirm(\'Are you sure you want to delete this link?\');" class="btn btn-danger btn-thin">Delete</a>';
	
	
	echo '<li class="list-group-item thin ' . $background_color . ' clearfix">';
		
		echo '<table class="full">' . chr(10);
			echo '<tr>' . chr(10);
				echo '<td class="menu-group-3-buttons hidden-sm hidden-xs">' . chr(10);
				
					// Display Buttons for normal view.
					echo '<div class="margin-bottom-2 btn-group">' . chr(10);
						echo $delete_link . chr(10);
						echo $edit_link . chr(10);
						echo $details_link . chr(10);
					echo '</div>' . chr(10);
		
				echo '</td>' . chr(10);
				echo '<td>' . chr(10);
					
					// Display the link.
					echo '<a href="' . $link['url'] . '" target="_blank" id="' . $link['id'] . '" class="link_item">';
						echo $link['name'];
						echo '<span class="padding-left-10 padding-right-10">(' . $link['visit_count'] . ')</span>';
					echo '</a>';
					
					// Display buttons for smart phones.
					echo '<div class="margin-top-5 visible-sm visible-xs">' . chr(10);
						echo '<div class="pull-right btn-group">' . chr(10);
							echo $details_link . chr(10);
							echo $edit_link . chr(10);
							echo $delete_link . chr(10);
						echo '</div>' . chr(10);
					echo '</div>' . chr(10);
		
				echo '</td>' . chr(10);
			echo '</tr>' . chr(10);
		echo '</table>' . chr(10);
		
		
		if ("A" == "B") {
			
			// Display Buttons for normal view.
			echo '<div class="pull-left padding-right-20 margin-top-2 btn-group hidden-sm hidden-xs">' . chr(10);
				echo $delete_link . chr(10);
				echo $edit_link . chr(10);
				echo $details_link . chr(10);
			echo '</div>' . chr(10);
	
	
			echo '<a href="' . $link['url'] . '" target="_blank" id="' . $link['id'] . '" class="link_item">';
				echo $link['name'];
				echo '<span class="padding-left-10 padding-right-10">(' . $link['visit_count'] . ')</span>';
			echo '</a>';
			
			
			// Display buttons for smart phones.
			echo '<div class="btn-group visible-sm visible-xs">' . chr(10);
				echo '<div class="pull-right margin-left-20">' . chr(10);
					echo $details_link . chr(10);
					echo $edit_link . chr(10);
					echo $delete_link . chr(10);
				echo '</div>' . chr(10);
			echo '</div>' . chr(10);
		
		} // end of - display or not

	echo '</li>' . chr(10);
			
} // end of - foreach


// No records found so display an alert message.
if ($i == 0) {
	//echo '<div class="alert alert-danger">No Links Found</div>' . chr(10);
	echo '<div class="alert alert-danger">No Links Found<br />Select a Link Category</div>' . chr(10);
} else {
	echo '</ul>' . chr(10);	
}

			
/* End of file _list_group.php */
/* Location: ./application/views/mdl_links/_list_group.php */		
	