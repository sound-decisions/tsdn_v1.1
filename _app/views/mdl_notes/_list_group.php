<?php

$i = 0;

foreach ($notes as $note) {

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
	$details_link = '<a href="' . site_url("mdl-notes/view/") . '/' . $note['id'] . '" class="btn btn-success btn-thin">Details</a>';
	$edit_link = '<a href="' . site_url("mdl-notes/edit/") . '/' . $note['id'] . '" class="btn btn-primary btn-thin">Edit</a>';
	$delete_link = '<a href="' . site_url("mdl-notes/delete/") . '/' . $note['id'] . '" onclick="return confirm(\'Are you sure you want to delete this note?\');" class="btn btn-danger btn-thin">Delete</a>';	
	
	echo '<li class="list-group-item thin ' . $background_color . ' clearfix">';
	
		if ("A" == "B") {
	
			echo '<div class="pull-left margin-right-100">';
				echo '<h5>';
					echo '<a href="' . site_url('mdl-notes/view/' . $note['id'] . '') . '">';
						echo $note['note_title'];
					echo '</a>';
				echo '</h5>';
			echo '</div>' . chr(10);
			
			echo '<div class="action-link-holder">' . chr(10);											
				// Only display the edit and delete icons for the owner of the link.
				if ($this->session->userdata('member_id') == $note['member_id']) {
					echo '<a href="' . site_url("mdl-notes/view/") . '/' . $note['id'] . '"><span class="glyphicon glyphicon-eye-open action-link">&nbsp;</span></a>' . chr(10);
					echo '<a href="' . site_url("mdl-notes/edit/") . '/' . $note['id'] . '"><span class="glyphicon glyphicon-pencil action-link">&nbsp;</span></a>' . chr(10);
					echo '<a href="' . site_url("mdl-notes/delete/") . '/' . $note['id'] . '" onclick="return confirm(\'Are you sure you want to delete this note?\');"><span class="glyphicon glyphicon-remove action-link">&nbsp;</span></a>' . chr(10);
				}
			echo '</div>' . chr(10);

		} // end of - display or not



		if ("A" == "A") {
			
			// Display Buttons for normal view.
			echo '<div class="pull-left padding-right-20 margin-top-2 btn-group hidden-sm hidden-xs">' . chr(10);
				echo $delete_link . chr(10);
				echo $edit_link . chr(10);
				echo $details_link . chr(10);
			echo '</div>' . chr(10);
	
	
			echo '<a href="' . site_url('mdl-notes/view/' . $note['id'] . '') . '">';
				echo $note['note_title'];
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
	echo '<div class="alert alert-danger">No Notes Found For The Selected Category</div>' . chr(10);
} else {
	echo '</ul>' . chr(10);	
}

			
/* End of file _list_group.php */
/* Location: ./application/views/mdl_notes/_list_group.php */		
	