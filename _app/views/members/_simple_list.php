<?php

echo '<div class="row">' . chr(10);
	echo '<div class="col col-md-12">' . chr(10);	
	
		echo '<table class="table table-striped">' . chr(10);
			echo '<tr>' . chr(10);
				echo '<th>Name</th>' . chr(10);
				echo '<th class="hidden-xs">Email</th>' . chr(10);
				echo '<th class="hidden-xs">Access</th>' . chr(10);
				echo '<th class="hidden-xs">Status</th>' . chr(10);
				echo '<th class="actions text-center">Actions</th>' . chr(10);
			echo '</tr>' . chr(10);		

			$i = 0;
			
			foreach ($members as $member) {
			
				$i++;
			
				if ($i % 2 == 0) {
					$panel_class = 'panel-default';
				} else {
					$panel_class = 'panel-custom';
				} 	        	
				
				// Format content for display.
				
				
				echo '<tr>' . chr(10);
					echo '<td>';
						echo $member['first_name'] . ' ' . $member['last_name'];
						echo '<div class="visible-xs">' . $member['email'] . '</div>';
						echo '<div class="visible-xs">';
							//echo '<span class="nowrap padding-right-20"><strong>Status:  </strong>' . $member['status'] . '</span>';
							//echo '<span class="nowrap"><strong>Access:  </strong>' . $member['access'] . '</span>';
							
							echo '<div class="nowrap">' . chr(10);
								echo '<div class="td-label text-right">' . chr(10);
									echo 'Status:';
								echo '</div>' . chr(10);
								echo '<div class="td-content">' . chr(10);
									echo $member['status'];
								echo '</div>' . chr(10);
							echo '</div>' . chr(10);
							
							
							
							echo '<div class="nowrap">' . chr(10);
								echo '<div class="td-label text-right">' . chr(10);
									echo 'Access:';
								echo '</div>' . chr(10);
								echo '<div class="td-content">' . chr(10);
									echo $member['access'];
								echo '</div>' . chr(10);							
							echo '</div>' . chr(10);
							
						echo '</div>';
					echo '</td>' . chr(10);
					echo '<td class="hidden-xs">' . $member['email'] . '</td>' . chr(10);
					echo '<td class="hidden-xs">' . $member['status'] . '</td>' . chr(10);
					echo '<td class="hidden-xs">' . $member['access'] . '</td>' . chr(10);
					echo '<td class="nowrap">';
						// The javascript confirmation for deleting a record.
						$js = array('onclick' => "return confirm('Are you sure you want to delete this Member?')");		
						
						echo anchor('members/view/' . $member['id'], '<span class="glyphicon glyphicon-eye-open action-link"></span>');
						echo '<span class="padding-left-10"></span>';
						echo anchor('members/edit/' . $member['id'], '<span class="glyphicon glyphicon-pencil action-link"></span>');
						echo '<span class="padding-left-10"></span>';
						echo anchor('members/delete/' . $member['id'], '<span class="glyphicon glyphicon-remove action-link"></span>', $js);
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
				
			echo '<div class="alert alert-danger">No Members Found.  Enter/Select Search Criteria.</div>' . chr(10);
	
		echo '</div>' . chr(10);
	echo '</div>' . chr(10); // end of - row		
}


/* End of file _detailed_list.php */
/* Location: ./application/views/members/_detailed_list.php */
