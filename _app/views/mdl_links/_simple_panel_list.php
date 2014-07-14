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

	// Format content for display.
    $description_content = ($recipe['description'] != '' ? str_replace(chr(10), '<br />', $recipe['description']) : '');

    // Create an array of content strings.
    $a_ingedients = explode(chr(10), $recipe['ingredients']);
    $a_directions = explode(chr(10), $recipe['directions']);

		
	echo '<div class="panel ' . $panel_class . ' tight-list">' . chr(10);
		echo '<div class="panel-body thin ' . $background_color . ' clearfix">';
		
			echo '<div class="pull-left">';
				echo '<h5>';
					echo $recipe['name'];
				echo '</h5>';
			echo '</div>' . chr(10);
			
			echo '<div class="pull-right">' . chr(10);
				// Only allow signed in members to add recipe notes.
				if ($this->session->userdata('member_id') != '') {									
					echo '<a href="' . site_url("recipes/view/") . '/' . $recipe['id'] . '"><span class="glyphicon glyphicon-eye-open action-link">&nbsp;</span></a>' . chr(10);
					echo '<a href="' . site_url("recipe_notes/add/") . '/' . $recipe['id'] . '"><span class="glyphicon glyphicon-file action-link">&nbsp;</span></a>' . chr(10);
				}										
				// Only display the edit and delete icons for the owner of the recipe.
				if ($this->session->userdata('member_id') == $recipe['member_id']) {							
					echo '<a href="' . site_url("recipes/edit/") . '/' . $recipe['id'] . '"><span class="glyphicon glyphicon-pencil action-link">&nbsp;</span></a>' . chr(10);
					echo '<a href="' . site_url("recipes/delete/") . '/' . $recipe['id'] . '" onclick="return confirm(\'Are you sure you want to delete this recipe?\');"><span class="glyphicon glyphicon-remove action-link">&nbsp;</span></a>' . chr(10);
				}
			echo '</div>' . chr(10);
						
		echo '</div>' . chr(10);
	echo '</div>' . chr(10);
		
} // end of - foreach


// No records found so display an alert message.
if ($i == 0) {
	echo '<div class="alert alert-danger">No Recipes Found</div>' . chr(10);
}

			
/* End of file _simple_panel_list.php */
/* Location: ./application/views/recipes/_simple_panel_list.php */
			