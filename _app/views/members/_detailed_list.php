<?php

$label_class = 'col-xs-12 col-sm-4 col-md-3 col-lg-3 detail_label';
$content_class = 'col-xs-12 col-sm-8 col-md-9 col-lg-9';			

$i = 0;

foreach ($members as $member) {

	$i++;

	if ($i % 2 == 0) {
		$panel_class = 'panel-default';
	} else {
		$panel_class = 'panel-custom';
	} 	        	
	
	// Format content for display.

	if ($i == 1) {
		echo '<div class="row">' . chr(10);
	} else {
		echo '<div class="row margin-top-20">' . chr(10);
	}
	
		echo '<div class="col col-xs-12 col-sm-3 col-lg-3">' . chr(10);	

			$image_properties = array(
			          'src' => base_url(MEMBER_PHOTOS_PATH . $member['profile_photo']),
			          'alt' => 'My Profile Photo',
			          'class' => 'img-responsive img-rounded',
			          'width' => '200',
			          'height' => '200',
			          'title' => 'Profile Photo',
			);

			echo img($image_properties) . chr(10);

		echo '</div>' . chr(10);
		echo '<div class="col col-xs-12 col-sm-9 col-lg-9">' . chr(10);

			echo '<div class="detail_section">' . chr(10);
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . ' first">Name:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $member['first_name'] . ' ' . $member['last_name'] . '</p>' . chr(10);
				echo '</div>' . chr(10);
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Email Address:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $member['email'] . '</p>' . chr(10);
				echo '</div>' . chr(10);	
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Status:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $member['status'] . '</p>' . chr(10);
				echo '</div>' . chr(10);
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Access:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $member['access'] . '</p>' . chr(10);
				echo '</div>' . chr(10);		
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Joined:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . dateAndTimeFormattedForDisplayLongVersionWithDayName($member['created_at']) . '</p>' . chr(10);
				echo '</div>' . chr(10);
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Signed In:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $member['sign_in_count'] . ' times</p>' . chr(10);
				echo '</div>' . chr(10);
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Last Signed In:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . dateAndTimeFormattedForDisplayLongVersionWithDayName($member['last_sign_in_at']) . '</p>' . chr(10);
				echo '</div>' . chr(10);
				
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">ACTIONS:</p>' . chr(10);
					echo '<p class="' . $content_class . '">';
						// The javascript confirmation for deleting a record.
						$js = array('onclick' => "return confirm('Are you sure you want to delete this Member?')");		
						
						echo anchor('members/view/' . $member['id'], '<span class="glyphicon glyphicon-eye-open action-link-with-text"></span>DETAILS');				
						echo '<span class="padding-left-20"></span>';
						echo anchor('members/edit/' . $member['id'], '<span class="glyphicon glyphicon-pencil action-link-with-text"></span>EDIT');
						echo '<span class="padding-left-20"></span>';
						echo anchor('members/delete/' . $member['id'], '<span class="glyphicon glyphicon-remove action-link-with-text"></span>DELETE', $js);
					echo '</p>' . chr(10);
				echo '</div>' . chr(10);					
				
			echo '</div>' . chr(10);
			
		echo '</div>' . chr(10);
	echo '</div>' . chr(10); // end of - row											
	         
} // end of - foreach	


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
