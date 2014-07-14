<div class="container">
	<div class="row">
		<div class="col col-md-12">

			<?php 
			// Display validation errors if there are any.
			echo validation_errors() . chr(10); 
			

			// Set form label attributes.
			$label_attributes = array('class' => 'control-label margin-top-20');

			if (set_value('news_id') == '') {
				$news_id_value = $news_item->id;
			} else {
				$news_id_value = set_value('news_id');
			}	


			echo '<div class="panel panel-form">' . chr(10);
				echo '<div class="panel-heading">' . chr(10); 			
			
					// Required field header.
					echo '<div class="clearfix">' . chr(10);
						echo '<p class="pull-right required"><span class="required">*</span>Required Field</p>' . chr(10);
					echo '</div>' . chr(10);

				echo '</div>' . chr(10); // end of - panel-heading
				echo '<div class="panel-body">' . chr(10);

					echo form_open('news_comments/add') . chr(10);
		
					// Add the loadtime hidden field used to detect spam.
					echo form_hidden('lt', encryptIt(time())) . chr(10);
		
					// The @ before variable will help to not  display an error if this value isn't set.
					echo form_hidden('news_id', @$news_id_value) . chr(10);	
					echo form_hidden('member_id', $this->session->userdata('member_id')) . chr(10);
		
					// Hidden field to indicate to return to this page after saving the comment.
					echo form_hidden('from_page', 'view') . chr(10);						
								
		
					// START OF - Check for SPAM.
					// This field is used as a spam check.
					echo '<div class="form-group email_address_sd">' . chr(10);
						echo form_label('Do Not Fill In This Field', 'email_address', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'email_address', 'id' => 'email_address', 'value'  => set_value('email_address'), 'maxlength' => '50', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
					// END OF - Check for SPAM.
		
		
					echo '<div class="form-group">' . chr(10);
						echo form_label('Post A Comment <span class="required">*</span>', 'comment_text', $label_attributes) . chr(10);
						$textarea_attributes = array('name' => 'comment_text', 'id' => 'comment_text', 'value'  => set_value('comment_text'), 'rows' => '2', 'class' => 'form-control');
						echo form_textarea($textarea_attributes) . chr(10);
					echo '</div>' . chr(10);
		
					echo '<div class="form-group margin-top-10">' . chr(10);
						$submit_attributes = array('names' => 'save', 'value' => 'Post Comment', 'class' => 'btn btn-primary btn-sm');
						echo form_submit($submit_attributes) . chr(10);
					echo '</div>' . chr(10);
		
					echo form_close() . chr(10);
			
				echo '</div>' . chr(10); // end of - panel-body
			echo '</div>' . chr(10); // end of panel									
			?>

		</div><!-- end of - col col-md-12 -->
		<div class="col col-md-12 margin-top">

			<?php
			// Display any comments for this news story.
	        foreach ($comments as $comment) {

	        	// Format content for display.
	            $comment_content = ($comment['comment_text'] != '' ? str_replace(chr(10), '<br />', $comment['comment_text']) : '');

	            if ($comment['first_name'] != '') {
	            	$posted_by = $comment['first_name'] . ' ' . $comment['last_name'];
	            } else {
	            	$posted_by = 'Anonymous';
	            }

				echo '<div class="panel panel-comment">' . chr(10);
					echo '<div class="panel-heading">' . chr(10);
						echo '<h5>By:  ' . $posted_by . '</h5>' . chr(10);						
					echo '</div>' . chr(10); // end of - panel-heading
					echo '<div class="panel-body">' . chr(10);
						echo '<p>' . $comment_content . '</p>' . chr(10);
					echo '</div>' . chr(10); // end of - panel-body
					echo '<div class="panel-footer clearfix">' . chr(10);
						echo '<p class="pull-left">' . dateAndTimeFormattedForDisplayShortVersion($comment['created_at']) . '</p>' . chr(10);
	                    // Only display link(s) for admins.
	                    if ($this->session->userdata('member_access') == 'admin') {	
	                    	echo '<a class="pull-right" href="' . site_url("news_comments/delete/") . '/' . $comment['id'] . '" onclick="return confirm(\'Are you sure you want to delete this comment?\');" data-toggle="tooltip" title="Delete This Comment"><span class="glyphicon glyphicon-remove"></span></a>' . chr(10);
	                    }						
					echo '</div>' . chr(10); // end of - panel-footer					
				echo '</div>' . chr(10); // end of - panel

	        } // end of - foreach
			?>

		</div><!-- end of - col col-md-12 -->			
	</div><!-- end of - row -->
</div><!-- end of - container -->			