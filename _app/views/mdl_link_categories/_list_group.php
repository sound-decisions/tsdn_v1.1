<?php

$i = 0;
$last_category = '';

foreach ($mdl_link_categories as $mdl_link_category) {

	$i++;

	if ($i % 2 == 0) {
		$panel_class = 'panel-default';
		$background_color = 'row2';
	} else {
		$panel_class = 'panel-custom';
		$background_color = 'row1';
	}        	

	if ($i == 1) {
		echo '<ul class="list-group">' . chr(10);
	}
	
	// Create the links.		
	$details_link = '<a href="' . site_url("mdl-link-categories/view/") . '/' . $mdl_link_category->id . '" class="btn btn-success btn-thin">Details</a>';
	$edit_link = '<a href="' . site_url("mdl-link-categories/edit/") . '/' . $mdl_link_category->id . '" class="btn btn-primary btn-thin">Edit</a>';
	$delete_link = '<a href="' . site_url("mdl-link-categories/delete/") . '/' . $mdl_link_category->id . '" onclick="return confirm(\'Are you sure you want to delete this link category?  All links associtated with it will be deleted as well.\');" class="btn btn-danger btn-thin">Delete</a>';	
	
	echo '<li class="list-group-item thin ' . $background_color . ' clearfix">';
	
		// Item buttons normal.
		echo '<div class="pull-left padding-right-20 margin-top-2 btn-group hidden-xs">' . chr(10);
			echo $delete_link . chr(10);
			echo $edit_link . chr(10);
			echo $details_link . chr(10);
		echo '</div>' . chr(10);


		echo '<a href="' . site_url("mdl-links/by-category/") . '/' . $mdl_link_category->id . '" class="link_item">';
			if ($mdl_link_category->category != $last_category) {
				echo $mdl_link_category->category;
			}				
			if ($mdl_link_category->sub_category != '') {
				echo '<span class="padding-left-10">';
					echo '<span class="padding-right-10">-</span>';
					echo $mdl_link_category->sub_category;
				echo '</span>';
			}	
		echo '</a>' . chr(10);


		// Item buttons for smartphones.
		echo '<div class="btn-group visible-xs">' . chr(10);
			echo '<div class="pull-right margin-left-20">' . chr(10);
				echo $details_link . chr(10);
				echo $edit_link . chr(10);
				echo $delete_link . chr(10);
			echo '</div>' . chr(10);
		echo '</div>' . chr(10);


	echo '</li>' . chr(10);

	$last_category = $mdl_link_category->category;
			
} // end of - foreach


// No records found so display an alert message.
if ($i == 0) {
	echo '<div class="alert alert-danger">No Links Categories Found</div>' . chr(10);
} else {
	echo '</ul>' . chr(10);	
}

			
/* End of file _list_group.php */
/* Location: ./application/views/mdl_link_categories/_list_group.php */		
	