<div class="container">
	<div class="row">
		<div class="col col-md-12">

			<?php 
			echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);

			// Display validation errors if there are any.
			echo validation_errors() . chr(10); 
			

			// Set form label attributes.
			$label_attributes = array('class' => 'control-label');
			
			
			echo '<div class="panel panel-form">' . chr(10);
				echo '<div class="panel-heading">' . chr(10); 			
			
					// Required field header.
					echo '<div class="clearfix">' . chr(10);
						echo '<p class="pull-right required"><span class="required">*</span>Required Field</p>' . chr(10);
					echo '</div>' . chr(10);

				echo '</div>' . chr(10); // end of - panel-heading
				echo '<div class="panel-body">' . chr(10);


					echo form_open() . chr(10);
		
					// Add the loadtime hidden field used to detect spam.
					echo form_hidden('loadtime', time()) . chr(10);
		
					// Hidden form fields.
					echo form_hidden('id', (set_value('id') == '' ? @$note->id : set_value('id')));
		
		
					echo '<div class="form-group">' . chr(10);
						echo form_label('Title <span class="required">*</span>', 'note_title', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'note_title', 'id' => 'note_title', 'value'  => (set_value('note_title') == '' ? @$note->note_title : set_value('note_title')), 'autofocus' => 'autofocus', 'maxlength' => '100', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Note Category <span class="required">*</span>', 'category_id', $label_attributes) . chr(10);
						// Add class and id to dropdown.
						echo form_dropdown('category_id', $note_category_form_options, (set_value('category_id') == '' ? @$note->category_id : set_value('category_id')), 'class="form-control" id="category_id"') . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Content', 'note_content', $label_attributes) . chr(10);
						$textarea_attributes = array('name' => 'note_content', 'id' => 'note_content', 'value'  => (set_value('note_content') == '' ? @$note->note_content : set_value('note_content')), 'rows' => '10', 'class' => 'form-control');
						echo form_textarea($textarea_attributes) . chr(10);
					echo '</div>' . chr(10);
		
					echo '<div class="form-group margin-top-10">' . chr(10);
						$submit_attributes = array('names' => 'save', 'value' => 'Save', 'class' => 'btn btn-primary btn-sm');
						echo form_submit($submit_attributes) . chr(10);
		                //$cancel_attributes = array('name' => 'cancel', 'id' => 'go-back', 'content' => 'Cancel', 'class' => 'btn btn-danger btn-sm');
		                //echo form_button($cancel_attributes) . chr(10);
					echo '</div>' . chr(10);
		
					echo form_close() . chr(10);
			
			
				echo '</div>' . chr(10); // end of - panel-body
			echo '</div>' . chr(10); // end of panel									
			?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->			