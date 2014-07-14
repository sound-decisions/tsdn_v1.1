<?php

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


	//echo '<div class="panel panel-default">' . chr(10);
	echo '<div class="panel ' . $panel_class . '">' . chr(10);
		echo '<div class="panel-heading">' . chr(10);
			echo '<div class="clearfix">' . chr(10);
				echo '<div class="pull-left">' . chr(10);
					//echo '<h4>' . $message['name'] . '<span class="additional">(' . $message['email'] . ')</span></h4>' . chr(10);
				echo '<h4>' . $message['name'] . '</h4>' . chr(10);
				echo '<h5>(' . $message['email'] . ')</h5>' . chr(10);
				echo '</div>' . chr(10);
				echo '<div class="pull-right">' . chr(10);
					echo '<h5>Status:<span id="span_status_' . $message['id'] . '" class="span_status">' . ucwords($message['status']) . '</span></h5>' . chr(10);
				echo '</div>' . chr(10);
			echo '</div>' . chr(10);
		echo '</div>' . chr(10);
		echo '<div class="panel-body">' . chr(10);
			
			echo '<div>' . chr(10);
				echo $message_content . chr(10);
			echo '</div>' . chr(10);


			if ($this->session->userdata('member_access') == 'admin') {

				echo '<div class="btn-group margin-top-20">' . chr(10);
					echo '<button type="button" class="btn btn-primary btn-xs">Update Status</button>' . chr(10);
					echo '<button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">' . chr(10);
						echo '<span class="caret"></span>' . chr(10);
						echo '<span class="sr-only">Toggle Dropdown</span>' . chr(10);
					echo '</button>' . chr(10);
					echo '<ul class="dropdown-menu no-padding" role="menu">' . chr(10);
						echo '<li><a href="#" data-id="' . $message['id'] . '" data-status="read" data-spanid="span_status_' . $message['id'] . '" class="update_status">Mark As Read</a></li>' . chr(10);
						echo '<li><a href="#" data-id="' . $message['id'] . '" data-status="complete" data-spanid="span_status_' . $message['id'] . '" class="update_status">Mark As Completed</a></li>' . chr(10);
						echo '<li><a href="#" data-id="' . $message['id'] . '" data-status="follow up" data-spanid="span_status_' . $message['id'] . '" class="update_status">Follow Up Required</a></li>' . chr(10);
						echo '<li><a href="#" data-id="' . $message['id'] . '" data-status="contact" data-spanid="span_status_' . $message['id'] . '" class="update_status">Person Needs To Be Contacted</a></li>' . chr(10);
						echo '<li><a href="#" data-id="' . $message['id'] . '" data-status="contacted" data-spanid="span_status_' . $message['id'] . '" class="update_status">Person Has Been Contacted</a></li>' . chr(10);
						echo '<li class="divider"></li>' . chr(10);
						echo '<li><a href="#" data-id="' . $message['id'] . '" data-status="new" data-spanid="span_status_' . $message['id'] . '" class="update_status">Mark As New</a></li>' . chr(10);
					echo '</ul>' . chr(10);
				echo '</div>' . chr(10);

			}

		echo '</div>' . chr(10);
		echo '<div class="panel-footer">' . chr(10);
			echo '<div class="clearfix">' . chr(10);
            	echo '<div class="pull-left">' . chr(10);
            		echo '<p>' . dateAndTimeFormattedForDisplayShortVersion($message['created_at']) . '</p>' . chr(10);
            	echo '</div>' . chr(10);
				echo '<div class="pull-right">' . chr(10);

					if ($this->session->userdata('member_access') == 'admin') {
                    	echo '<a href="' . site_url("contact-messages/delete/") . '/' . $message['id'] . '" onclick="return confirm(\'Are you sure you want to delete this contact message?\');" data-toggle="tooltip" title="Delete This Contact Message"><span class="glyphicon glyphicon-remove"></span></a>' . chr(10);
                 	}
             	echo '</div>' . chr(10);
             echo '</div>' . chr(10);
		echo '</div>' . chr(10);
	echo '</div>' . chr(10);

} // end of - foreach
	        
	        
	        // No records found so display an alert message.
if ($i == 0) {
	echo '<div class="row">' . chr(10);
		echo '<div class="col col-md-12">' . chr(10);
				
			echo '<div class="alert alert-danger">No Contact Messages Found.  Enter/Select Search Criteria.</div>' . chr(10);
	
		echo '</div>' . chr(10);
	echo '</div>' . chr(10); // end of - row		
}
	        
	        

/* End of file _panellist.php */
/* Location: ./application/views/contact_messages/_panel_list.php */