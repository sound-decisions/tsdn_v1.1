<div class="container">

	<?php
	// If a message has been set then display it.
	if ($this->session->flashdata("message") !== FALSE) {
		echo '<div class="row">' . chr(10);
			echo '<div class="col col-md-12">' . chr(10);
				echo '<div class="alert ' . $this->session->flashdata("message_class") . '">' . $this->session->flashdata("message") . '</div>' . chr(10);
			echo '</div><!-- end of - col col-md-12 -->' . chr(10);
		echo '</div><!-- end of - row -->' . chr(10);
	}
	?>

	<div class="row">
		<div class="col col-md-12">

			<?php
			echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);

			$i = 0;

	        foreach ($results as $result) {

				$i++;

				if ($i % 2 == 0) {
					$panel_class = 'panel-default';
				} else {
					$panel_class = 'panel-custom';
				}  	        	


	            $message = $result['message'];

	            if ($message != '') {
	                $message = str_replace(chr(10), '<br />', $message);	
	            }	

				//echo '<div class="panel panel-default">' . chr(10);
				echo '<div class="panel ' . $panel_class . '">' . chr(10);
					echo '<div class="panel-heading">' . chr(10);
						echo '<div class="clearfix">' . chr(10);
							echo '<div class="pull-left">' . chr(10);
								//echo '<h4>' . $result['name'] . '<span class="additional">(' . $result['email'] . ')</span></h4>' . chr(10);
							echo '<h4>' . $result['name'] . '</h4>' . chr(10);
							echo '<h5>(' . $result['email'] . ')</h5>' . chr(10);
							echo '</div>' . chr(10);
							echo '<div class="pull-right">' . chr(10);
								echo '<h5>Status:<span id="span_status_' . $result['id'] . '" class="span_status">' . ucwords($result['status']) . '</span></h5>' . chr(10);
							echo '</div>' . chr(10);
						echo '</div>' . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="panel-body">' . chr(10);
						
						echo '<div>' . chr(10);
							echo $message . chr(10);
						echo '</div>' . chr(10);


						if ($this->session->userdata('member_access') == 'admin') {

							echo '<div class="btn-group margin-top-20">' . chr(10);
								echo '<button type="button" class="btn btn-primary btn-xs">Update Status</button>' . chr(10);
								echo '<button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">' . chr(10);
									echo '<span class="caret"></span>' . chr(10);
									echo '<span class="sr-only">Toggle Dropdown</span>' . chr(10);
								echo '</button>' . chr(10);
								echo '<ul class="dropdown-menu no-padding" role="menu">' . chr(10);
									echo '<li><a href="#" data-id="' . $result['id'] . '" data-status="read" data-spanid="span_status_' . $result['id'] . '" class="update_status">Mark As Read</a></li>' . chr(10);
									echo '<li><a href="#" data-id="' . $result['id'] . '" data-status="complete" data-spanid="span_status_' . $result['id'] . '" class="update_status">Mark As Completed</a></li>' . chr(10);
									echo '<li><a href="#" data-id="' . $result['id'] . '" data-status="follow up" data-spanid="span_status_' . $result['id'] . '" class="update_status">Follow Up Required</a></li>' . chr(10);
									echo '<li><a href="#" data-id="' . $result['id'] . '" data-status="contact" data-spanid="span_status_' . $result['id'] . '" class="update_status">Person Needs To Be Contacted</a></li>' . chr(10);
									echo '<li><a href="#" data-id="' . $result['id'] . '" data-status="contacted" data-spanid="span_status_' . $result['id'] . '" class="update_status">Person Has Been Contacted</a></li>' . chr(10);
									echo '<li class="divider"></li>' . chr(10);
									echo '<li><a href="#" data-id="' . $result['id'] . '" data-status="new" data-spanid="span_status_' . $result['id'] . '" class="update_status">Mark As New</a></li>' . chr(10);
								echo '</ul>' . chr(10);
							echo '</div>' . chr(10);

						}

					echo '</div>' . chr(10);
					echo '<div class="panel-footer">' . chr(10);
						echo '<div class="clearfix">' . chr(10);
		                	echo '<div class="pull-left">' . chr(10);
		                		echo '<p>' . dateAndTimeFormattedForDisplayShortVersion($result['created_at']) . '</p>' . chr(10);
		                	echo '</div>' . chr(10);					
							echo '<div class="pull-right">' . chr(10);

								if ($this->session->userdata('member_access') == 'admin') {
			                    	echo '<a href="' . site_url("contact_messages/delete/") . '/' . $result['id'] . '" onclick="return confirm(\'Are you sure you want to delete this contact message?\');" data-toggle="tooltip" title="Delete This Contact Message"><span class="glyphicon glyphicon-remove"></span></a>' . chr(10);
			                 	}
			             	echo '</div>' . chr(10);
			             echo '</div>' . chr(10);
					echo '</div>' . chr(10);
				echo '</div>' . chr(10);	 				    

	        } // end of - foreach
			?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->