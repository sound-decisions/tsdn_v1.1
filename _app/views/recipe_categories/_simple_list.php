<?php


echo '<table class="table table-striped">' . chr(10);
	echo '<tr>' . chr(10);
		echo '<th>Name</th>' . chr(10);
		echo '<th class="hidden-xs">Description</th>' . chr(10);
		echo '<th class="hidden-xs">Sort Order</th>' . chr(10);
		echo '<th class="actions text-center">Actions</th>' . chr(10);
	echo '</tr>' . chr(10);		

	$i = 0;
	
	foreach ($recipe_categories as $recipe_category) {
	
		$i++;
	
		if ($i % 2 == 0) {
			$panel_class = 'panel-default';
		} else {
			$panel_class = 'panel-custom';
		} 	        	
		
		// Format content for display.
		$recipe_category_description_content = ($recipe_category['description'] != '' ? str_replace(chr(10), '<br />', $recipe_category['description']) : '');
		
		
		echo '<tr>' . chr(10);
			echo '<td class="hidden-xs">' . $recipe_category['name'] . '</td>' . chr(10);				
			echo '<td class="visible-xs">';
				echo '<strong>';
					echo $recipe_category['name'];
				echo '</strong>';
				echo '<div class="visible-xs border-top">' . $recipe_category_description_content . '</div>';
				echo '<div class="visible-xs border-top">';
										
					echo '<div class="nowrap">' . chr(10);
						echo '<div class="td-label text-right">' . chr(10);
							echo 'Sort Order:';
						echo '</div>' . chr(10);
						echo '<div class="td-content">' . chr(10);
							echo $recipe_category['sort_order'];
						echo '</div>' . chr(10);
					echo '</div>' . chr(10);
																									
				echo '</div>';
			echo '</td>' . chr(10);
			echo '<td class="hidden-xs">' . $recipe_category_description_content . '</td>' . chr(10);
			echo '<td class="hidden-xs">' . $recipe_category['sort_order'] . '</td>' . chr(10);
			echo '<td class="nowrap">';
				// The javascript confirmation for deleting a record.
				$js = array('onclick' => "return confirm('Are you sure you want to delete this Recipe Category Message?')");		
				
				echo anchor('recipe_categories/view/' . $recipe_category['id'], '<span class="glyphicon glyphicon-eye-open action-link"></span>');
				echo '<span class="padding-left-10"></span>';
				echo anchor('recipe_categories/edit/' . $recipe_category['id'], '<span class="glyphicon glyphicon-pencil action-link"></span>');
				echo '<span class="padding-left-10"></span>';
				echo anchor('recipe_categories/delete/' . $recipe_category['id'], '<span class="glyphicon glyphicon-remove action-link"></span>', $js);
			echo '</td>' . chr(10);
		echo '</tr>' . chr(10);		

	} // end of - foreach	

echo '</table>' . chr(10);




// No records found so display an alert message.
if ($i == 0) {
	echo '<div class="row">' . chr(10);
		echo '<div class="col col-md-12">' . chr(10);
				
			//echo '<div class="alert alert-danger">No Recipe Categories Found.  Enter/Select Search Criteria.</div>' . chr(10);
			echo '<div class="alert alert-danger">No Recipe Categories Found.</div>' . chr(10);
	
		echo '</div>' . chr(10);
	echo '</div>' . chr(10); // end of - row		
}


/* End of file _simple_list.php */
/* Location: ./application/views/recipe_categories/_simple_list.php */