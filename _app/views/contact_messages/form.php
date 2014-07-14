<div class="container">
	<div class="row">
		<div class="col col-md-12">

			<?php 
			echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);


			// If a member is signed in then get their name and populate the form with it.
			if ($this->session->userdata('member_first_name') != '') {
				$name_value = $this->session->userdata('member_first_name');
				if ($this->session->userdata('member_first_name') != '') {
					$name_value .= ' ' . $this->session->userdata('member_last_name');
				}
			} else {
				$name_value = set_value('name');
			}

			//$email_value = ($this->session->userdata('member_email') != '' ? $this->session->userdata('member_email') : set_value('email'));

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


					echo form_open('contact-messages/add') . chr(10);
		
					// Add the loadtime hidden field used to detect spam.
					echo form_hidden('lt', encryptIt(time())) . chr(10);
		
					// Hidded form fields.
					echo form_hidden('member_id', $this->session->userdata('member_id')) . chr(10);			
									
		
					// START OF - Check for SPAM.
					// This field is used as a spam check.
					echo '<div class="form-group email_address_sd">' . chr(10);
						echo form_label('Do Not Fill In This Field', 'email_address', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'email_address', 'id' => 'email_address', 'value'  => set_value('email_address'), 'maxlength' => '50', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
					// END OF - Check for SPAM.
		
		
					echo '<div class="form-group">' . chr(10);
						echo form_label('Name <span class="required">*</span>', 'name', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'name', 'id' => 'name', 'value'  => $name_value, 'maxlength' => '50', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Email Address <span class="required">*</span>', 'email', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'email', 'id' => 'email', 'value'  => ($this->session->userdata('member_email') != '' ? $this->session->userdata('member_email') : set_value('email')), 'maxlength' => '50', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Message  <span class="required">*</span>', 'message', $label_attributes) . chr(10);
						$textarea_attributes = array('name' => 'message', 'id' => 'message', 'value'  => set_value('message'), 'rows' => '8', 'class' => 'form-control');
						echo form_textarea($textarea_attributes) . chr(10);
					echo '</div>' . chr(10);
		
					echo '<div class="form-group margin-top-10">' . chr(10);
						$submit_attributes = array('names' => 'save', 'value' => 'Send Message', 'class' => 'btn btn-primary btn-sm');
						echo form_submit($submit_attributes) . chr(10);
					echo '</div>' . chr(10);
		
					echo form_close() . chr(10);	
					
				echo '</div>' . chr(10); // end of - panel-body
			echo '</div>' . chr(10); // end of panel												
			?>

		</div><!-- end of - col col-md-12 -->			
	</div><!-- end of - row -->
</div><!-- end of - container -->			