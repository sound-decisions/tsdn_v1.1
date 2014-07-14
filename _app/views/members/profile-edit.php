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

			// Display validation errors if there are any.
			echo validation_errors() . chr(10); 
			// Display Image Upload errors if there are any.
			echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>') . chr(10);
			

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
		
					echo form_open_multipart() . chr(10);
		
					// Add the loadtime hidden field used to detect spam.
					echo form_hidden('loadtime', time());
		
					// Hidden form fields.
					echo form_hidden('id', (set_value('id') == '' ? $member->id : set_value('id')));
					echo form_hidden('current_profile_photo_tn', (set_value('current_profile_photo_tn') == '' ? $member->profile_photo_tn : set_value('current_profile_photo_tn')));
		
		
					echo '<div class="form-group">' . chr(10);
						echo form_label('First Name <span class="required">*</span>', 'first_name', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'first_name', 'id' => 'first_name', 'value'  => (set_value('first_name') == '' ? $member->first_name : set_value('first_name')), 'maxlength' => '50', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Last Name <span class="required">*</span>', 'last_name', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'last_name', 'id' => 'last_name', 'value'  => (set_value('last_name') == '' ? $member->last_name : set_value('last_name')), 'maxlength' => '50', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);		
					echo '<div class="form-group">' . chr(10);
						echo form_label('Email Address <span class="required">*</span>', 'email', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'email', 'id' => 'email', 'value'  => (set_value('email') == '' ? $member->email : set_value('email')), 'maxlength' => '50', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Password <span class="required">*</span>', 'password', $label_attributes) . chr(10);
						$password_attributes = array('name' => 'password', 'id' => 'password', 'value'  => (set_value('password') == '' ? $member->password : set_value('password')), 'maxlength' => '20', 'class' => 'form-control');
						echo form_password($password_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Confirm Password <span class="required">*</span>', 'password_confirm', $label_attributes) . chr(10);
						$password_attributes = array('name' => 'password_confirm', 'id' => 'password_confirm', 'value'  => (set_value('password') == '' ? $member->password : set_value('password')), 'maxlength' => '20', 'class' => 'form-control');
						echo form_password($password_attributes) . chr(10);
					echo '</div>' . chr(10);	
						
					echo '<div class="form-group">' . chr(10);
						echo form_label('Profile Photo', 'profile_photo', $label_attributes) . chr(10);
						$upload_attributes = array('name' => 'profile_photo', 'id' => 'profile_photo', 'value'  => '', 'class' => 'form-control');
						echo form_upload($upload_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Current Profile Photo', 'current_profile_photo', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'current_profile_photo', 'id' => 'current_profile_photo', 'value'  => (set_value('current_profile_photo') == '' ? $member->profile_photo : set_value('current_profile_photo')), 'readonly' => 'readonly', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);	
		
					echo '<div class="form-group margin-top-10">' . chr(10);
						$submit_attributes = array('name' => 'save', 'value' => 'Save', 'class' => 'btn btn-primary btn-sm');
						echo form_submit($submit_attributes) . chr(10);
		                $cancel_attributes = array('name' => 'cancel', 'id' => 'go-back', 'content' => 'Cancel', 'class' => 'btn btn-danger btn-sm');
						echo form_button($cancel_attributes) . chr(10);
					echo '</div>' . chr(10);
		
					echo form_close() . chr(10);
			
				echo '</div>' . chr(10); // end of - panel-body
			echo '</div>' . chr(10); // end of panel									
			?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->			