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
			$message_content = ($message->message != '' ? str_replace(chr(10), '<br />', $message->message) : '');
			$notes_content = ($message->notes != '' ? str_replace(chr(10), '<br />', $message->notes) : '');
							
			// $label_class = 'col-xs-12 col-sm-4 col-md-3 col-lg-3 detail_label';
			// $content_class = 'col-xs-12 col-sm-8 col-md-9 col-lg-9';
			
			$label_class = 'col-xs-12 detail_label_left';
			$content_class = 'col-xs-12';

			echo '<div class="detail_section">' . chr(10);
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . ' first">Name:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $message->name . '</p>' . chr(10);
				echo '</div>' . chr(10);
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Email Address:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $message->email . '</p>' . chr(10);
				echo '</div>' . chr(10);	
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Message:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $message_content . '</p>' . chr(10);
				echo '</div>' . chr(10);				
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Status:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $message->status . '</p>' . chr(10);
				echo '</div>' . chr(10);	
				if ($notes_content != '') {
					echo '<div class="clearfix">' . chr(10);
						echo '<p class="' . $label_class . '">Notes:</p>' . chr(10);
						echo '<p class="' . $content_class . '">' . $notes_content . '</p>' . chr(10);
					echo '</div>' . chr(10);					
				}								
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Sent:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . dateAndTimeFormattedForDisplayLongVersionWithDayName($message->created_at) . '</p>' . chr(10);
				echo '</div>' . chr(10);
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Last Updated:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . dateAndTimeFormattedForDisplayLongVersionWithDayName($message->updated_at) . '</p>' . chr(10);
				echo '</div>' . chr(10);
				
				echo '<div class="clearfix">' . chr(10);
					echo '<div class="pull-right margin-top-10">' . chr(10);
						echo '<div>';
							echo '<a href="' . site_url('contact-messages/edit/' . $message->id . '') . '" class="btn btn-primary btn-sm">Edit Contact Message</a>';
							echo '<span class="padding-right-10"></span>';
							echo '<a id="go-back" href="#" class="btn btn-danger btn-sm">Cancel</a>';
						echo '</div>' . chr(10);
					echo '</div>' . chr(10);
				echo '</div>' . chr(10);
				
			echo '</div>' . chr(10);																	
			?>

		</div><!-- end of - col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->