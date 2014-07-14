<?php

echo '<div class="row">' . chr(10);
	echo '<div class="col col-md-12">' . chr(10);	
	

		$i = 0;
		$category_name = '';
		
		foreach ($mdl_notes as $mdl_note) {
		
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
			
			
			if ($category_name != $mdl_note['category_name']) {
				echo '<li class="list-group-item medium active">' . $mdl_note['category_name'] . '</li>' . chr(10);
			}
			
			
			$category_name = $mdl_note['category_name'];


			echo '<li class="list-group-item thin ' . $background_color . ' clearfix">';
			
				echo '<div class="pull-left">';
					echo '<h5>';
						//echo '<a href="' . $mdl_note['url'] . '" title="Follow Link" target="_blank">';
							echo $mdl_note['note_title'];
						//echo '</a>';
					echo '</h5>';
				echo '</div>' . chr(10);
				
				echo '<div class="pull-right action-links">' . chr(10);											
					// Only display the edit and delete icons for the owner of the recipe.
					if ($this->session->userdata('member_id') == $mdl_note['member_id']) {							

						// The javascript confirmation for deleting a record.
						$js = array('onclick' => "return confirm('Are you sure you want to delete this Link?')");
						
						echo anchor('mdl-notes/view/' . $mdl_note['id'], '<span class="glyphicon glyphicon-eye-open action-link"></span>');
						echo '<span class="padding-left-10"></span>';
						echo anchor('mdl-notes/edit/' . $mdl_note['id'], '<span class="glyphicon glyphicon-pencil action-link"></span>');
						echo '<span class="padding-left-10"></span>';
						echo anchor('mdl-notes/delete/' . $mdl_note['id'], '<span class="glyphicon glyphicon-remove action-link"></span>', $js);

					}
				echo '</div>' . chr(10);
				
			echo '</li>' . chr(10);


			$category_name = $mdl_note['category_name'];


			if ("A" == "B") {
				echo $mdl_note['name'];
				echo $mdl_note['category_name'];
				echo '<a href="' . $mdl_note['url'] . '" class="underline">';
					echo $mdl_note['url'];
				echo '</a>';
				echo '<a href="' . $mdl_note['url'] . '" class="underline">';
					echo 'Follow Link';
				echo '</a>';
				
				// The javascript confirmation for deleting a record.
				$js = array('onclick' => "return confirm('Are you sure you want to delete this Link?')");
				
				echo anchor('mdl-notes/view/' . $mdl_note['id'], '<span class="glyphicon glyphicon-eye-open action-link"></span>');
				echo '<span class="padding-left-10"></span>';
				echo anchor('mdl-notes/edit/' . $mdl_note['id'], '<span class="glyphicon glyphicon-pencil action-link"></span>');
				echo '<span class="padding-left-10"></span>';
				echo anchor('mdl-notes/delete/' . $mdl_note['id'], '<span class="glyphicon glyphicon-remove action-link"></span>', $js);
			}
		
		} // end of - foreach	
	
	
	
		// No records found so display an alert message.
		if ($i == 0) {
			echo '<div class="alert alert-danger">No Recipes Found</div>' . chr(10);
		} else {
			echo '</ul>' . chr(10);	
		}	
	

	echo '</div>' . chr(10);
echo '</div>' . chr(10); // end of - row


/* End of file _simple_list_grouped_by_category.php */
/* Location: ./application/views/mdl_notes/_simple_list_grouped_by_category.php */
