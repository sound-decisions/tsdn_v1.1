<?php


$i = 0;

foreach ($recipes as $recipe) {

	$i++;

	if ($i % 2 == 0) {
		$panel_class = 'panel-default';
	} else {
		$panel_class = 'panel-custom';
	}        	

	// Format content for display.
    $description_content = ($recipe['description'] != '' ? str_replace(chr(10), '<br />', $recipe['description']) : '');
    //$ingredients_content = ($recipe['ingredients'] != '' ? str_replace(chr(10), '<br />', $recipe['ingredients']) : '');
    //$directions_content = ($recipe['directions'] != '' ? str_replace(chr(10), '<br />', $recipe['directions']) : '');

    // Create an array of content strings.
    $a_ingedients = explode(chr(10), $recipe['ingredients']);
    $a_directions = explode(chr(10), $recipe['directions']);


    echo '<div class="panel-group" id="accordion_' . $i . '">' . chr(10);

		//echo '<div class="panel panel-default tight-list">' . chr(10);
		echo '<div class="panel ' . $panel_class . ' tight-list">' . chr(10);
			echo '<div class="panel-heading clearfix">' . chr(10);

				echo '<h5 class="panel-title pull-left">' . chr(10);
					echo '<a data-toggle="collapse" data-parent="#accordion_' . $i . '" href="#collapse_' . $i . '" data-tooltip="tooltip" title="Display Recipe">' . chr(10);
						echo $recipe['name']  . chr(10);
					echo '</a>' . chr(10);
				echo '</h5>' . chr(10); // end of - panel-title

				echo '<p class="pull-right">' . chr(10);
					echo '<a data-toggle="collapse" data-parent="#accordion_' . $i . '" href="#collapse_' . $i . '" data-tooltip="tooltip" title="Display Recipe"><span class="glyphicon glyphicon-eye-open action-link">&nbsp;</span></a>' . chr(10);
					// Only display the edit and delete icons for the owner of the recipe.
					if ($this->session->userdata('member_id') == $recipe['member_id']) {							
						echo '<a href="' . site_url("recipes/edit/") . '/' . $recipe['id'] . '" data-toggle="tooltip" title="Edit Recipe"><span class="glyphicon glyphicon-pencil action-link">&nbsp;</span></a>' . chr(10);
						echo '<a href="' . site_url("recipes/delete/") . '/' . $recipe['id'] . '" onclick="return confirm(\'Are you sure you want to delete this recipe?\');" data-toggle="tooltip" title="Delete Recipe"><span class="glyphicon glyphicon-remove action-link">&nbsp;</span></a>' . chr(10);
					}
				echo '</p>' . chr(10);							
				
			echo '</div>' . chr(10); // end of - panel-heading
			echo '<div id="collapse_' . $i . '" class="panel-collapse collapse">' . chr(10);
				echo '<div class="panel-body">' . chr(10);
					
					echo '<h5>Description</h5>' . chr(10);
	                echo '<div>' . chr(10);
	                    echo $description_content . chr(10);
	                echo '</div>' . chr(10);	

	                echo '<h5>Ingredients</h5>' . chr(10);
	                echo '<div>' . chr(10);
	                	echo '<ul>' . chr(10);

	                		foreach ($a_ingedients as $ingredient) {
	                			if ($ingredient != '') echo '<li>' . $ingredient . '</li>' . chr(10);
	                		}

	                	echo '</ul>' . chr(10);
	                echo '</div>' . chr(10);  

	                echo '<h5>Directions</h5>' . chr(10);
	                echo '<div>' . chr(10);
	                	echo '<ul>' . chr(10);

	                		foreach ($a_directions as $direction) {
	                			if ($direction != '') echo '<li>' . $direction . '</li>' . chr(10);
	                		}

	                	echo '</ul>' . chr(10);
	                echo '</div>' . chr(10);				                             	                

				echo '</div>' . chr(10); // end of - panel-body
				echo '<div class="panel-footer clearfix">' . chr(10);
					echo '<p class="pull-right">Added On:  ' . dateAndTimeFormattedForDisplayShortVersion($recipe['created_at']) . '</p>' . chr(10);
				echo '</div>' . chr(10); // end of - panel-footer							
			echo '</div>' . chr(10); // end of - panel-collapse						
		echo '</div>' . chr(10); // end of - panel

	echo '</div>' . chr(10); // end of - panel-group								
	         
} // end of - foreach


// No records found so display an alert message.
if ($i == 0) {
	echo '<div class="alert alert-danger">No Recipes Found</div>' . chr(10);
}


/* End of file _panel_list.php */
/* Location: ./application/views/recipes/_panel_list.php */