<?php


$i = 0;

foreach ($news_items as $news_item) {

	$i++;

	if ($i % 2 == 0) {
		$panel_class = 'panel-default';
	} else {
		$panel_class = 'panel-custom';
	}        	

	// Format content for display.
    $story_content = ($news_item['story'] != '' ? str_replace(chr(10), '<br />', $news_item['story']) : '');


    echo '<div class="panel-group" id="accordion_' . $i . '">' . chr(10);

		//echo '<div class="panel panel-default tight-list">' . chr(10);
		echo '<div class="panel ' . $panel_class . ' tight-list">' . chr(10);
			echo '<div class="panel-heading clearfix">' . chr(10);

				echo '<h5 class="panel-title pull-left">' . chr(10);
					echo '<a data-toggle="collapse" data-parent="#accordion_' . $i . '" href="#collapse_' . $i . '" data-tooltip="tooltip" title="Display/Hide News Item">' . chr(10);
						echo $news_item['headline']  . chr(10);
					echo '</a>' . chr(10);
				echo '</h5>' . chr(10); // end of - panel-title

				echo '<p class="pull-right">' . chr(10);
					echo '<a data-toggle="collapse" data-parent="#accordion_' . $i . '" href="#collapse_' . $i . '" data-tooltip="tooltip" title="Display/Hide News Item"><span class="glyphicon glyphicon-eye-open action-link">&nbsp;</span></a>' . chr(10);
					// Only display the edit and delete icons for admins.
					if ($this->session->userdata('member_access') == 'admin') {							
						echo '<a href="' . site_url("news/edit/") . '/' . $news_item['id'] . '" data-toggle="tooltip" title="Edit This News Item"><span class="glyphicon glyphicon-pencil action-link">&nbsp;</span></a>' . chr(10);
						echo '<a href="' . site_url("news/delete/") . '/' . $news_item['id'] . '" onclick="return confirm(\'Are you sure you want to delete this news item?\');" data-toggle="tooltip" title="Delete This News Item"><span class="glyphicon glyphicon-remove action-link">&nbsp;</span></a>' . chr(10);
					}
				echo '</p>' . chr(10);							
				
			echo '</div>' . chr(10); // end of - panel-heading
			echo '<div id="collapse_' . $i . '" class="panel-collapse collapse">' . chr(10);
				echo '<div class="panel-body">' . chr(10);
					
					echo $story_content . chr(10);

				echo '</div>' . chr(10); // end of - panel-body
				echo '<div class="panel-footer clearfix">' . chr(10);
					echo '<p class="pull-left">' . dateFormattedForDisplayLongVersion($news_item['date_posted']) . '</p>' . chr(10);
					echo '<div class="pull-right">' . chr(10);
						echo '<a data-toggle="collapse" data-parent="#accordionCommentForm" href="#collapseCommentForm_' . $news_item['id'] . '" data-tooltip="tooltip" title="Show Comment Form and Existing Comments"><span class="glyphicon glyphicon-comment action-link">&nbsp;</span></a>' . chr(10);
					echo '</div>' . chr(10); // end of - pull-right
				echo '</div>' . chr(10); // end of - panel-footer							
			echo '</div>' . chr(10); // end of - panel-collapse						
		echo '</div>' . chr(10); // end of - panel




		// Display the News Comment form and any existing comments.

		echo '<div class="panel-group" id="accordionCommentForm_' . $news_item['id'] . '">' . chr(10);
			echo '<div class="panel panel-default comments">' . chr(10);
				// echo '<div class="panel-heading">' . chr(10);
				// 	echo '<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordionCommentForm" href="#collapseCommentForm_' . $news_item['id'] . '"><span class="glyphicon glyphicon-comment"></span></a></h4>' . chr(10);
				// echo '</div>' . chr(10);
				echo '<div id="collapseCommentForm_' . $news_item['id'] . '" class="panel-collapse collapse">' . chr(10);
					echo '<div class="panel-body">' . chr(10);
						

						// Set form label attributes.
						$label_attributes = array('class' => 'control-label');
						
						echo form_open('news_comments/add') . chr(10);

						// Add the loadtime hidden field used to detect spam.
						echo form_hidden('loadtime', time()) . chr(10);

						// The @ before variable will help to not  display an error if this value isn't set.
						echo form_hidden('news_id', $news_item['id']) . chr(10);	
						echo form_hidden('member_id', $this->session->userdata('member_id')) . chr(10);	

						// Hidden field to indicate to return to this page after saving the comment.
						echo form_hidden('from_page', 'index') . chr(10);		
									

						echo '<div class="form-group">' . chr(10);
							echo form_label('Post A Comment', 'comment_text', $label_attributes) . chr(10);
							$textarea_attributes = array('name' => 'comment_text', 'id' => 'comment_text', 'value'  => set_value('comment_text'), 'rows' => '2', 'class' => 'form-control');
							echo form_textarea($textarea_attributes) . chr(10);
						echo '</div>' . chr(10);						

						echo '<div class="form-group">' . chr(10);
							$submit_attributes = array('names' => 'save', 'value' => 'Post Comment', 'class' => 'btn btn-primary');
							echo form_submit($submit_attributes) . chr(10);
			                // $cancel_attributes = array('name' => 'cancel', 'id' => 'cancel', 'content' => 'Cancel', 'class' => 'btn btn-danger');
			                // $cancel_js = 'onClick="window.history.back();"';
			                // echo form_button($cancel_attributes, '', $cancel_js) . chr(10); 					
						echo '</div>' . chr(10);	

						echo form_close() . chr(10);

						

						echo '<div class="margin-top">' . chr(10);

							// Display the comments for this news item.
					        foreach ($comments as $comment) {

					        	// Only display comments for this news item.
					        	if ($comment['news_id'] == $news_item['id']) {

						        	// Format content for display.
						            $comment_content = ($comment['comment_text'] != '' ? str_replace(chr(10), '<br />', $comment['comment_text']) : '');


						            if ($comment['first_name'] != '') {
						            	$posted_by = $comment['first_name'] . ' ' . $comment['last_name'];
						            } else {
						            	$posted_by = 'Anonymous';
						            }

									echo '<div class="panel panel-default">' . chr(10);
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

					        	}

					        } // end of - foreach

					 	echo '</div>' . chr(10); // end of - margin-top


					echo '</div>' . chr(10); // end of - panel-body
				echo '</div>' . chr(10); // end of - panel-collapse
			echo '</div>' . chr(10); // end of - panel
		echo '</div>' . chr(10); // end of - panel-group





	echo '</div>' . chr(10); // end of - panel-group								
	         
} // end of - foreach


// No records found so display an alert message.
if ($i == 0) {
	echo '<div class="alert alert-danger">No News Items Found</div>' . chr(10);
}


/* End of file news_list.php */
/* Location: ./application/views/recipes/news_list.php */