<div class="container">

	<?php
	// If a message has been set then display it.
	if ($this->session->flashdata("message") !== FALSE) {
		echo '<div class="row">' . chr(10);
			echo '<div class="col col-md-8 col-md-offset-2">' . chr(10);
				echo '<div class="alert ' . $this->session->flashdata("message_class") . '">' . $this->session->flashdata("message") . '</div>' . chr(10);
			echo '</div>' . chr(10);
		echo '</div>' . chr(10);
	}
	?>

	<div class="row">
		<div class="col col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">

			<?php 
			echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);

			// Display validation errors if there are any.
			echo validation_errors() . chr(10); 
		
			echo '<p>Please enter your first name, last name and email address.  If they match our records, your password will be reset and emailed to you.</p>' . chr(10);
			?>

		</div><!-- end of - col -->			
	</div><!-- end of - row -->
	<div class="row">
		<div class="col col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">

			<?php 
			echo '<div class="panel panel-form">' . chr(10);
				echo '<div class="panel-heading">' . chr(10); 			
			
					// Required field header.
					echo '<div class="clearfix">' . chr(10);
						echo '<p class="pull-right required"><span class="required">*</span>Required Field</p>' . chr(10);
					echo '</div>' . chr(10);

				echo '</div>' . chr(10); // end of - panel-heading
				echo '<div class="panel-body">' . chr(10);

					// Set form label attributes.
					$label_attributes = array('class' => 'control-label');
		
					echo form_open() . chr(10);
		
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
						echo form_label('First Name <span class="required">*</span>', 'first_name', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'first_name', 'id' => 'first_name', 'value'  => set_value('first_name'), 'maxlength' => '50', 'autofocus' => 'autofocus', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Last Name <span class="required">*</span>', 'last_name', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'last_name', 'id' => 'last_name', 'value'  => set_value('last_name'), 'maxlength' => '50', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Email Address <span class="required">*</span>', 'email', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'email', 'id' => 'email', 'value'  => set_value('email'), 'maxlength' => '50', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
		
					echo '<div class="form-group margin-top-10">' . chr(10);
						$submit_attributes = array('names' => 'save', 'value' => 'Reset Password', 'class' => 'btn btn-primary btn-sm');
						echo form_submit($submit_attributes) . chr(10);
					echo '</div>' . chr(10);	
		
					echo form_close() . chr(10);	
					
				echo '</div>' . chr(10); // end of - panel-body
			echo '</div>' . chr(10); // end of panel											
			?>

		</div><!-- end of - col -->			
	</div><!-- end of - row -->
</div><!-- end of - container -->			