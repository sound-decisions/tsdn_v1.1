<?php

echo '<div class="row">' . chr(10);
	echo '<div class="col col-md-12">' . chr(10);	
	
		echo '<table class="table table-striped">' . chr(10);
			echo '<tr>' . chr(10);
				echo '<th>Name</th>' . chr(10);
				echo '<th class="hidden-xs">Category</th>' . chr(10);
				echo '<th class="hidden-xs">Description</th>' . chr(10);
				echo '<th class="actions text-center">Actions</th>' . chr(10);
			echo '</tr>' . chr(10);		

			$i = 0;
			
			foreach ($recipes as $recipe) {
			
				$i++;        	
				
				// Format content for display.
				$description_content = ($recipe['description'] != '' ? str_replace(chr(10), '<br />', $recipe['description']) : '');


				echo '<tr>' . chr(10);
					echo '<td class="hidden-xs nowrap">' . $recipe['name'] . '</td>' . chr(10);
					echo '<td class="visible-xs">';
						echo $recipe['name'];
						echo '<div class="visible-xs">';

							echo '<div class="clearfix border-top">' . chr(10);
								echo '<p>' . $description_content . '</p>' . chr(10);
							echo '</div>' . chr(10);
							
							echo '<div class="clearfix border-top">' . chr(10);
								echo '<p><span class="padding-right-10">Category:</span>' . $recipe['category_name'] . '</p>' . chr(10);
							echo '</div>' . chr(10);							


						echo '</div>';
					echo '</td>' . chr(10);
					echo '<td class="hidden-xs">' . $recipe['category_name'] . '</td>' . chr(10);
					echo '<td class="hidden-xs">' . $description_content . '</td>' . chr(10);
					echo '<td class="nowrap">';
						// The javascript confirmation for deleting a record.
						$js = array('onclick' => "return confirm('Are you sure you want to delete this Recipe?')");		
						
						echo anchor('recipes/view/' . $recipe['id'], '<span class="glyphicon glyphicon-eye-open action-link"></span>');
						echo '<span class="padding-left-10"></span>';
						echo anchor('recipes/edit/' . $recipe['id'], '<span class="glyphicon glyphicon-pencil action-link"></span>');
						echo '<span class="padding-left-10"></span>';
						echo anchor('recipes/delete/' . $recipe['id'], '<span class="glyphicon glyphicon-remove action-link"></span>', $js);
					echo '</td>' . chr(10);
				echo '</tr>' . chr(10);		
		
			} // end of - foreach	
	
		echo '</table>' . chr(10);

	echo '</div>' . chr(10);
echo '</div>' . chr(10); // end of - row



// No records found so display an alert message.
if ($i == 0) {
	echo '<div class="row">' . chr(10);
		echo '<div class="col col-md-12">' . chr(10);
				
			echo '<div class="alert alert-danger">No Recipes Found.  Enter/Select Search Criteria.</div>' . chr(10);
	
		echo '</div>' . chr(10);
	echo '</div>' . chr(10); // end of - row		
}


/* End of file _simple_list.php */
/* Location: ./application/views/contact_messages/_simple_list.php */
