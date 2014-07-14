<?php

echo '<div class="row">' . chr(10);
	echo '<div class="col col-md-12">' . chr(10);	
	
		echo '<table class="table table-striped">' . chr(10);
			echo '<tr>' . chr(10);
				echo '<th>Link Details</th>' . chr(10);
				//echo '<th class="hidden-xs">Category</th>' . chr(10);
				//echo '<th class="hidden-xs">URL</th>' . chr(10);
				echo '<th class="actions text-center">Actions</th>' . chr(10);
			echo '</tr>' . chr(10);		

			$i = 0;
			
			foreach ($mdl_links as $mdl_link) {
			
				$i++;        	
				
				// Format content for display.
				//$description_content = ($mdl_link['description'] != '' ? str_replace(chr(10), '<br />', $mdl_link['description']) : '');


				echo '<tr>' . chr(10);
					echo '<td>';
						//echo '<span class="padding-right-10">Name:</span>';
						echo '<h4 class="margin-top-0 margin-bottom-10">';
							echo $mdl_link['name'];
						echo '</h4>';
						//echo '<br />';
						//echo '<span class="padding-right-10">Category:</span>';
						// if ($mdl_link['parent_category_name'] != '') {
							// echo '<span class="padding-right-10">';
								// $mdl_link['parent_category_name'];
							// echo ':</span>';
						// }
						echo '<h5 class="margin-bottom-10">';
							echo $mdl_link['category_name'];
						echo '</h5>';
						//echo '<br />';
						//echo '<span class="padding-right-10">URL:</span>';
						echo '<div class="hidden-xs">';
							echo '<a href="' . $mdl_link['url'] . '" class="underline">';
								echo $mdl_link['url'];
							echo '</a>';
						echo '</div>';
						echo '<div class="visible-xs">';
							echo '<a href="' . $mdl_link['url'] . '" class="underline">';
								echo 'Follow Link';
							echo '</a>';
						echo '</div>';						
					echo '</td>' . chr(10);
					echo '<td class="nowrap">';
						// The javascript confirmation for deleting a record.
						$js = array('onclick' => "return confirm('Are you sure you want to delete this Link?')");		
						
						echo anchor('mdl-links/view/' . $mdl_link['id'], '<span class="glyphicon glyphicon-eye-open action-link"></span>');
						echo '<span class="padding-left-10"></span>';
						echo anchor('mdl-links/edit/' . $mdl_link['id'], '<span class="glyphicon glyphicon-pencil action-link"></span>');
						echo '<span class="padding-left-10"></span>';
						echo anchor('mdl-links/delete/' . $mdl_link['id'], '<span class="glyphicon glyphicon-remove action-link"></span>', $js);
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
				
			echo '<div class="alert alert-danger">No Links Found.  Enter/Select Search Criteria.</div>' . chr(10);
	
		echo '</div>' . chr(10);
	echo '</div>' . chr(10); // end of - row		
}


/* End of file _simple_list.php */
/* Location: ./application/views/mdl_links/_simple_list.php */
