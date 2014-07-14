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

			<h4 class="page_title"><?php echo $title; ?></h4>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
	<div class="row">	
		<div class="col col-md-12">

				<?php
	        	// Format content for display.
	            $description_content = ($link->description != '' ? str_replace(chr(10), '<br />', $link->description) : '');
	            $notes_content = ($link->notes != '' ? str_replace(chr(10), '<br />', $link->notes) : '');
				$visit_count = $link->visit_count;
				$last_visited_at = dateAndTimeFormattedForDisplayLongVersionWithDayName($link->last_visited_at);
				$created_at = dateAndTimeFormattedForDisplayShortVersion($link->created_at);

				echo '<div class="panel panel-default">' . chr(10);
					echo '<div class="panel-heading">' . chr(10);
						echo '<h4>' . $link->name . '</h4>' . chr(10);
					echo '</div>' . chr(10); // end of - panel-heading
					echo '<div class="panel-body">' . chr(10);
						
						//echo '<h5>URL</h5>' . chr(10);
		                echo '<p>' . chr(10);
							echo '<a href="' . $link->url . '" target="_blank" id="' . $link->id . '" class="link_item underline">';
		                    	echo $link->url;
							echo '</a>';
		                echo '</p>' . chr(10);
						
						if ($description_content != '') {
							//echo '<h5>Description</h5>' . chr(10);
			                echo '<p>' . chr(10);
			                    echo $description_content . chr(10);
			                echo '</p>' . chr(10);
						}

						if ($notes_content != '') {
							echo '<h5>Notes</h5>' . chr(10);
			                echo '<p>' . chr(10);
			                    echo $notes_content . chr(10);
			                echo '</p>' . chr(10);
						}
										
						
						echo '<p class="margin-left-20 text-small">';
							switch ($visit_count) {
								case 0:
									echo 'You have not visited this website.';
									break;
								default:
									echo 'You have visited this website ' . $link->visit_count . ' ' . ($link->visit_count > 1 ? 'times.' : 'time.');
							} // end of - switch							
						echo '</p>' . chr(10);
						
						if ($last_visited_at != '') {
                            echo '<p class="margin-left-20 text-small">';
								echo 'The last time was on ' . $last_visited_at . '.';
							echo '</p>' . chr(10);
						}


                        // Display the Sign In/Login Information is there is any set.
						if (($link->username != '') || ($link->email != '')) {

                            echo '<div class="margin-left-20 margin-top-20">' . chr(10);

                                echo '<h5 class="text-color">Sign In/Login Informaiton</h5>' . chr(10);

                                echo '<table>' . chr(10);
                                    if ($link->username != '') {
                                        echo '<tr>' . chr(10);
                                            echo '<td class="text-right padding-right-10">Username:</th>' . chr(10);
                                            echo '<td>' . $link->username . '</td>' . chr(10);
                                        echo '</tr>' . chr(10);
                                    }
                                    if ($link->email != '') {
                                        echo '<tr>' . chr(10);
                                            echo '<td class="text-right padding-right-10">Email:</th>' . chr(10);
                                            echo '<td>' . $link->email . '</td>' . chr(10);
                                        echo '</tr>' . chr(10);
                                    }
                                    echo '<tr>' . chr(10);
                                        echo '<td class="text-right padding-right-10">Password:</th>' . chr(10);
                                        echo '<td>' . $password . '</td>' . chr(10);
                                    echo '</tr>' . chr(10);
                                echo '</table>' . chr(10);

                            echo '</div>' . chr(10);
						}	


					echo '</div>' . chr(10); // end of - panel-body
					echo '<div class="panel-footer">' . chr(10);

	                	echo '<div class="clearfix">' . chr(10);
		                	echo '<div class="pull-left">' . chr(10);
		                		echo '<p>' . $created_at . '</p>' . chr(10);
		                	echo '</div>' . chr(10);
							
		                	echo '<div class="pull-right margin-left-20 margin-top-2 btn-group">' . chr(10);
								// Go back link.
								echo '<a href="#" id="go-back" class="btn btn-success btn-thin">Back To List</a>' . chr(10);						
								// Only display the edit and delete icons for the owner of the recipe.
								if ($this->session->userdata('member_id') == $link->member_id) {		                    	
				                    echo '<a href="' . site_url("mdl-links/edit/") . '/' . $link->id . '" class="btn btn-primary btn-thin">Edit</a>' . chr(10);
				                    echo '<a href="' . site_url("mdl-links/delete/") . '/' . $link->id . '" onclick="return confirm(\'Are you sure you want to delete this link?\');" class="btn btn-danger btn-thin"">Delete</a>' . chr(10);
				            	}
			             	echo '</div>' . chr(10);
		             	echo '</div>' . chr(10);

					echo '</div>' . chr(10); // end of - panel-footer					
				echo '</div>' . chr(10); // end of - panel													
				?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->