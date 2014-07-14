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
		
					// Hidded form fields.
					echo form_hidden('id', (set_value('id') == '' ? $message->id : set_value('id')));
					echo form_hidden('member_id', (set_value('id') == '' ? $message->member_id : set_value('id')));
		
					echo '<div class="form-group">' . chr(10);
						echo form_label('Name <span class="required">*</span>', 'name', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'name', 'id' => 'name', 'value'  => (set_value('name') == '' ? $message->name : set_value('name')), 'maxlength' => '50', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Email Address <span class="required">*</span>', 'email', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'email', 'id' => 'email', 'value'  => (set_value('email') == '' ? $message->email : set_value('email')), 'maxlength' => '50', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Message  <span class="required">*</span>', 'message', $label_attributes) . chr(10);
						$textarea_attributes = array('name' => 'message', 'id' => 'message', 'value'  => (set_value('message') == '' ? $message->message : set_value('message')), 'rows' => '6', 'class' => 'form-control');
						echo form_textarea($textarea_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Notes  <span class="required">*</span>', 'notes', $label_attributes) . chr(10);
						$textarea_attributes = array('name' => 'notes', 'id' => 'notes', 'value'  => (set_value('notes') == '' ? $message->notes : set_value('notes')), 'rows' => '6', 'class' => 'form-control');
						echo form_textarea($textarea_attributes) . chr(10);
					echo '</div>' . chr(10);
					
					echo '<div class="form-group">' . chr(10); 
						echo form_label('Status  <span class="required">*</span>', 'status', $label_attributes) . chr(10);
		                $data = 'id="status" class="form-control"';
		                echo form_dropdown('status', $status_options, (set_value('status') == '' ? $message->status : set_value('status')), $data);
					echo '</div>' . chr(10); // end of - form-group			
											
					echo '<div class="form-group margin-top-10">' . chr(10);
						$submit_attributes = array('names' => 'save', 'value' => 'Save Message', 'class' => 'btn btn-primary btn-sm');
						echo form_submit($submit_attributes) . chr(10);
		                $cancel_attributes = array('name' => 'cancel', 'id' => 'cancel', 'content' => 'Cancel', 'class' => 'btn btn-danger btn-sm');
		                $cancel_js = 'onClick="window.history.back();"';
		                echo form_button($cancel_attributes, '', $cancel_js) . chr(10);
					echo '</div>' . chr(10);
		
					echo form_close() . chr(10);
					
				echo '</div>' . chr(10); // end of - panel-body
			echo '</div>' . chr(10); // end of panel											
			?>

		</div><!-- end of - col col-md-12 -->			
	</div><!-- end of - row -->
</div><!-- end of - container -->			