<div class="container">
	<div class="row">
		<div class="col col-md-12">

			<?php 
			echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);
			
			
			// Display validation errors if there are any.
			echo validation_errors() . chr(10); 
			
			
			if ($recipe_id == '') {
				$recipe_id = @$recipe_note->recipe_id;
			}						
			
			
			// Set form label attributes.
			$label_attributes = array('class' => 'control-label');

			
			//echo form_open('recipe_notes/add') . chr(10);
			echo form_open() . chr(10);

			// The @ before variable will help to not  display an error if this value isn't set.
			echo form_hidden('id', (set_value('id') == '' ? @$recipe_note->id : set_value('id')));
			echo form_hidden('recipe_id', (set_value('recipe_id') == '' ? $recipe_id : set_value('recipe_id')));
			//echo form_hidden('version_id', (set_value('version_id') == '' ? @$recipe_note->version_id : set_value('version_id')));
			//echo form_hidden('member_id', (set_value('member_id') == '' ? @$recipe_note->member_id : set_value('member_id')));			
						

			// START OF - Check for SPAM.
			// This field is used as a spam check.
			echo '<div class="form-group email_address_sd">' . chr(10);
				echo form_label('Do Not Fill In This Field', 'email_address', $label_attributes) . chr(10);
				$input_attributes = array('name' => 'email_address', 'id' => 'email_address', 'value'  => set_value('email_address'), 'maxlength' => '50', 'class' => 'form-control');
				echo form_input($input_attributes) . chr(10);
			echo '</div>' . chr(10);
			// END OF - Check for SPAM.


			echo '<div class="form-group">' . chr(10);
				echo form_label('Title', 'title', $label_attributes) . chr(10);
				$input_attributes = array('name' => 'title', 'id' => 'title', 'value'  => (set_value('title') == '' ? @$recipe_note->title : set_value('title')), 'maxlength' => '100', 'class' => 'form-control');
				echo form_input($input_attributes) . chr(10);
			echo '</div>' . chr(10);

			echo '<div class="form-group">' . chr(10);
				echo form_label('Note', 'note', $label_attributes) . chr(10);
				$textarea_attributes = array('name' => 'note', 'id' => 'note', 'value'  => (set_value('note') == '' ? @$recipe_note->note : set_value('note')), 'rows' => '5', 'class' => 'form-control');
				echo form_textarea($textarea_attributes) . chr(10);
			echo '</div>' . chr(10);						

			echo '<div class="form-group">' . chr(10);
				$submit_attributes = array('names' => 'save', 'value' => 'Save Note', 'class' => 'btn btn-primary');
				echo form_submit($submit_attributes) . chr(10);
                // $cancel_attributes = array('name' => 'cancel', 'id' => 'cancel', 'content' => 'Cancel', 'class' => 'btn btn-danger');
                // $cancel_js = 'onClick="window.history.back();"';
                // echo form_button($cancel_attributes, '', $cancel_js) . chr(10); 					
			echo '</div>' . chr(10);	

			echo form_close() . chr(10);							
			?>

		</div><!-- end of - col col-md-12 -->		
	</div><!-- end of - row -->
</div><!-- end of - container -->			