<?php

echo '<div class="row">' . chr(10);
	echo '<div class="col col-md-12">' . chr(10);	
	
		echo '<table class="table table-striped">' . chr(10);
			echo '<tr>' . chr(10);
				echo '<th>Name</th>' . chr(10);
				echo '<th class="hidden-xs">Email</th>' . chr(10);
				echo '<th class="hidden-xs">Message</th>' . chr(10);
				echo '<th class="hidden-xs">Status</th>' . chr(10);
				echo '<th class="actions text-center">Actions</th>' . chr(10);
			echo '</tr>' . chr(10);

			$i = 0;

			foreach ($messages as $message) {

				$i++;
			
				if ($i % 2 == 0) {
					$panel_class = 'panel-default';
				} else {
					$panel_class = 'panel-custom';
				} 	        	
				
				// Format content for display.
				$message_content = ($message['message'] != '' ? str_replace(chr(10), '<br />', $message['message']) : '');
				
				
				echo '<tr>' . chr(10);
					echo '<td class="hidden-xs nowrap">';
                        echo $message['name'];
                    echo '</td>' . chr(10);
					echo '<td class="visible-xs">';
						echo $message['name'];
						echo '<div class="visible-xs">' . $message['email'] . '</div>';
						echo '<div class="visible-xs">';

							echo '<div class="clearfix border-top">' . chr(10);
								echo '<p>' . $message_content . '</p>' . chr(10);
								echo '<p class="pull-right"><span class="padding-right-10">Sent:</span>' . dateAndTimeFormattedForDisplayShortVersion($message['created_at']) . '</p>' . chr(10);
							echo '</div>' . chr(10);

							echo '<div class="nowrap border-top">' . chr(10);
								echo '<div class="td-label text-right">' . chr(10);
									echo 'Status:';
								echo '</div>' . chr(10);
								echo '<div class="td-content">' . chr(10);
									echo $message['status'];
								echo '</div>' . chr(10);
							echo '</div>' . chr(10);

						echo '</div>';
					echo '</td>' . chr(10);
					echo '<td class="hidden-xs nowrap">' . $message['email'] . '</td>' . chr(10);
					echo '<td class="hidden-xs">' . chr(10);
						echo '<div>' . $message['message'] . '</div>' . chr(10);
						echo '<div class="pull-right"><span class="padding-right-10">Sent:</span>' . dateAndTimeFormattedForDisplayShortVersion($message['created_at']) . '</div>' . chr(10);
					echo '</td>' . chr(10);
					echo '<td class="hidden-xs nowrap">' . $message['status'] . '</td>' . chr(10);
					echo '<td class="nowrap">';
						// The javascript confirmation for deleting a record.
						$js = array('onclick' => "return confirm('Are you sure you want to delete this Contact Message?');", 'class' => 'btn btn-danger btn-thin');
						
						echo '<div class="btn-group-vertical">' . chr(10);
							echo anchor('contact-messages/view/' . $message['id'], 'Details', 'class="btn btn-success btn-thin"');
							echo anchor('contact-messages/edit/' . $message['id'], 'Edit', 'class="btn btn-primary btn-thin"');
							echo anchor('contact-messages/delete/' . $message['id'], 'Delete', $js);
						echo '</div>' . chr(10);
						
						// echo anchor('contact-messages/view/' . $message['id'], '<span class="glyphicon glyphicon-eye-open action-link"></span>');
						// echo '<span class="padding-left-10"></span>';
						// echo anchor('contact-messages/edit/' . $message['id'], '<span class="glyphicon glyphicon-pencil action-link"></span>');
						// echo '<span class="padding-left-10"></span>';
						// echo anchor('contact-messages/delete/' . $message['id'], '<span class="glyphicon glyphicon-remove action-link"></span>', $js);						
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
				
			echo '<div class="alert alert-danger">No Contact Messages Found.  Enter/Select Search Criteria.</div>' . chr(10);
	
		echo '</div>' . chr(10);
	echo '</div>' . chr(10); // end of - row		
}


/* End of file _simple_list.php */
/* Location: ./application/views/contact_messages/_simple_list.php */
