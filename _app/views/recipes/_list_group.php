<?php

$i = 0;

foreach ($recipes as $recipe) {

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

	// Format content for display.
    $description_content = ($recipe['description'] != '' ? str_replace(chr(10), '<br />', $recipe['description']) : '');

    // Create an array of content strings.
    $a_ingedients = explode(chr(10), $recipe['ingredients']);
    $a_directions = explode(chr(10), $recipe['directions']);

	// Create the links.
	$details_link = '<a href="' . site_url("recipes/view/") . '/' . $recipe['id'] . '" class="btn btn-success btn-thin">Details</a>';
	$edit_link = '<a href="' . site_url("recipes/edit/") . '/' . $recipe['id'] . '" class="btn btn-primary btn-thin">Edit</a>';
	$delete_link = '<a href="' . site_url("recipes/delete/") . '/' . $recipe['id'] . '" class="btn btn-danger btn-thin" onclick="return confirm(\'Are you sure you want to delete this recipe?\');">Delete</a>';	
		
		
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
					echo '<a href="' . site_url("recipes/view/") . '/' . $recipe['id'] . '">';
						echo $recipe['name'];
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
				
		echo '<div class="pull-left margin-right-100">';
		//echo '<div class="pull-left">';
			echo '<h5>';
				echo '<a href="' . site_url("recipes/view/") . '/' . $recipe['id'] . '" data-toggle="tooltip-right" title="Display Recipe">';
					echo $recipe['name'];
				echo '</a>';
			echo '</h5>';
		echo '</div>' . chr(10);
		
		//echo '<div class="pull-right">' . chr(10);	
		echo '<div class="action-link-holder">' . chr(10);										
			// Only display the edit and delete icons for the owner of the recipe.
			if ($this->session->userdata('member_id') == $recipe['member_id']) {
				echo '<div class="btn-group">' . chr(10);
					echo '<a href="' . site_url("recipes/view/") . '/' . $recipe['id'] . '" class="btn btn-success btn-thin">Details</a>' . chr(10);							
					echo '<a href="' . site_url("recipes/edit/") . '/' . $recipe['id'] . '" class="btn btn-primary btn-thin">Edit</a>' . chr(10);
					echo '<a href="' . site_url("recipes/delete/") . '/' . $recipe['id'] . '" class="btn btn-danger btn-thin" onclick="return confirm(\'Are you sure you want to delete this recipe?\');">Delete</a>' . chr(10);
				echo '</div>' . chr(10);
			}
		echo '</div>' . chr(10);
		
		}
		
	echo '</li>' . chr(10);
			
} // end of - foreach


// No records found so display an alert message.
if ($i == 0) {
	echo '<div class="alert alert-danger">No Recipes Found</div>' . chr(10);
} else {
	echo '</ul>' . chr(10);	
}

			
/* End of file _list_group.php */
/* Location: ./application/views/recipes/_list_group.php */		
	