<?php


$i = 0;

echo '<div class="list-group">' . chr(10);

	foreach ($recipe_categories as $recipe_category) {
	
		$i++;
	
		if ($i % 2 == 0) {
			$panel_class = 'panel-default';
			$background_color = 'row2';
		} else {
			$panel_class = 'panel-custom';
			$background_color = 'row1';
		}        	
	
				
		echo '<a href="' . site_url('recipes/by-category/' . $recipe_category['id']) . '" class="list-group-item thin ' . $background_color . '">';
			//echo '<h5>';
				echo $recipe_category['name'];
			//echo '</h5>' . chr(10);
			echo '<span title="Number of Recipes" class="badge">' . $recipe_category['num_recipes'] . '</span>' . chr(10);
		echo '</a>' . chr(10);
		         
	} // end of - foreach

echo '</div>' . chr(10);


// No records found so display an alert message.
if ($i == 0) {
	echo '<div class="alert alert-danger">No Category Recipes Found</div>' . chr(10);
}   
			
/* End of file _list_group_menu.php */
/* Location: ./application/views/recipe_categories/_list_group_menu.php */	
			