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
	
	echo '<li class="list-group-item thin ' . $background_color . ' clearfix">';
	
		echo '<div class="pull-left margin-right-140">';
		// echo '<div class="pull-left">';
			echo '<h5>';
				echo '<a href="' . $link['url'] . '" target="_blank" id="' . $link['id'] . '" data-toggle="tooltip-right" title="Follow Link" class="link_item">';
					echo $link['name'];
					echo '<span class="padding-left-10 padding-right-10">(' . $link['visit_count'] . ')</span>';
				echo '</a>';
			echo '</h5>';
		echo '</div>' . chr(10);
		
		//echo '<div class="pull-right">' . chr(10);
		echo '<div class="action-button-holder">' . chr(10);											
			// Only display the edit and delete icons for the owner of the link.
			if ($this->session->userdata('member_id') == $link['member_id']) {
				echo '<a href="' . site_url("mdl-links/view/") . '/' . $link['id'] . '" class="btn btn-success btn-thin">Details</a>' . chr(10);
				echo '<a href="' . site_url("mdl-links/edit/") . '/' . $link['id'] . '" class="btn btn-warning btn-thin">Edit</a>' . chr(10);
				echo '<a href="' . site_url("mdl-links/delete/") . '/' . $link['id'] . '" onclick="return confirm(\'Are you sure you want to delete this link?\');" class="btn btn-danger btn-thin">Delete</a>' . chr(10);
			}
		echo '</div>' . chr(10);
		
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
	