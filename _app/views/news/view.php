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

			// For comments.
			// Display validation errors if there are any.
			echo validation_errors() . chr(10);
			?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->

	<div class="row">	
		<div class="col col-md-12">

				<?php
	        	// Format content for display.
	            $story_content = ($news_item->story != '' ? str_replace(chr(10), '<br />', $news_item->story) : '');


				echo '<div class="panel panel-custom">' . chr(10);
					echo '<div class="panel-heading">' . chr(10);
						echo '<h4>' . $news_item->headline . '</h4>' . chr(10);
					echo '</div>' . chr(10); // end of - panel-heading
					echo '<div class="panel-body">' . chr(10);
						echo '<p>' . $story_content . '</p>' . chr(10);
					echo '</div>' . chr(10); // end of - panel-body
					echo '<div class="panel-footer">' . chr(10);

	                	echo '<div class="clearfix">' . chr(10);
		                	echo '<div class="pull-left">' . chr(10);
		                		echo '<p>' . dateAndTimeFormattedForDisplayShortVersion($news_item->date_posted) . '</p>' . chr(10);
		                	echo '</div>' . chr(10);
		                	echo '<div class="pull-right">' . chr(10);			                 
			                    
			                    // Only display link(s) for admins.
			                    if ($this->session->userdata('member_access') == 'admin') {
			                    	echo '<div class="btn-group">' . chr(10);	                    					                    
				                    	echo '<a href="' . site_url("news/edit/") . '/' . $news_item->id . '" class="btn btn-primary btn-thin">Edit</a>' . chr(10);
				                    	echo '<a href="' . site_url("news/delete/") . '/' . $news_item->id . '" onclick="return confirm(\'Are you sure you want to delete this news item?\');" class="btn btn-danger btn-thin">Delete</a>' . chr(10);
									echo '</div>' . chr(10);
				            	}
			             	echo '</div>' . chr(10);
		             	echo '</div>' . chr(10);

					echo '</div>' . chr(10); // end of - panel-footer					
				echo '</div>' . chr(10); // end of - panel
				?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->