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
	            $note_content_content = ($note->note_content != '' ? str_replace(chr(10), '<br />' , $note->note_content) :'');

				echo '<div class="panel panel-default">' . chr(10);
					echo '<div class="panel-heading">' . chr(10);
						echo '<h4>' . $note->note_title . '</h4>' . chr(10);
					echo '</div>' . chr(10); // end of - panel-heading
					echo '<div class="panel-body">' . chr(10);
												
						if ($note_content_content != '') {
			                echo '<div>' . chr(10);
			                    echo $note_content_content . chr(10);
			                echo '</div>' . chr(10);
						}

					echo '</div>' . chr(10); // end of - panel-body
					echo '<div class="panel-footer">' . chr(10);

	                	echo '<div class="clearfix">' . chr(10);
		                	echo '<div class="pull-left">' . chr(10);
		                		echo '<p>' . dateAndTimeFormattedForDisplayShortVersion($note->created_at) . '</p>' . chr(10);
		                	echo '</div>' . chr(10);
		                	echo '<div class="pull-right">' . chr(10);
								// Go back link.
								echo '<a href="#" id="go-back" data-toggle="tooltip" title="Back to List"><span class="glyphicon glyphicon-step-backward action-link">&nbsp;</span></a>' . chr(10);						
								// Only display the edit and delete icons for the owner of the recipe.
								if ($this->session->userdata('member_id') == $note->member_id) {		                    	
				                    //echo '<span class="link_separator"></span>' . chr(10);
				                    echo '<a href="' . site_url("mdl-notes/edit/") . '/' . $note->id . '"  data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-pencil action-link">&nbsp;</span></a>' . chr(10);
				                    //echo '<span class="link_separator"></span>' . chr(10);
				                    echo '<a href="' . site_url("mdl-notes/delete/") . '/' . $note->id . '" onclick="return confirm(\'Are you sure you want to delete this note?\');"  data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-remove action-link">&nbsp;</span></a>' . chr(10);
				            	}
			             	echo '</div>' . chr(10);
		             	echo '</div>' . chr(10);

					echo '</div>' . chr(10); // end of - panel-footer					
				echo '</div>' . chr(10); // end of - panel													
				?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->