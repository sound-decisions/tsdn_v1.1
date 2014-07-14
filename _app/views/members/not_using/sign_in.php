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
		<div class="col col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">

			<?php
			echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);

			// Display validation errors if there are any.
			echo validation_errors() . chr(10); 			
			?>

		</div><!-- end of - col -->
	</div><!-- end of - row -->
	<div class="row">
		<div class="col col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">

			<?php 
			// Check/Get Values.
			if ($this->input->cookie('member_email') != '') {
				$email_value = $this->input->cookie('member_email');
			} else {
				$email_value = set_value('email');
			}
			if ($this->input->cookie('member_password') != '') {
				$password_value = $this->input->cookie('member_password');
			} else {
				$password_value = set_value('password');
			}			


			// Set form label attributes.
			$label_attributes = array('class' => 'control-label');
			

			echo form_open() . chr(10);

			// Add the loadtime hidden field used to detect spam.
			echo form_hidden('loadtime', time()) . chr(10);


			echo '<div class="form-group">' . chr(10);
				echo form_label('Email Address', 'email', $label_attributes) . chr(10);
				$input_attributes = array('name' => 'email', 'id' => 'email', 'value'  => $email_value, 'maxlength' => '50', 'autofocus' => 'autofocus', 'class' => 'form-control');
				echo form_input($input_attributes) . chr(10);
			echo '</div>' . chr(10);
			echo '<div class="form-group">' . chr(10);
				echo form_label('Password', 'password', $label_attributes) . chr(10);
				$password_attributes = array('name' => 'password', 'id' => 'password', 'value'  => $password_value, 'maxlength' => '20', 'class' => 'form-control');
				echo form_password($password_attributes) . chr(10);
			echo '</div>' . chr(10);

			echo '<div class="form-group margin-top-10"">' . chr(10);
				$submit_attributes = array('names' => 'save', 'value' => 'Sign In', 'class' => 'btn btn-primary btn-sm');
				echo form_submit($submit_attributes) . chr(10);
                $cancel_attributes = array('name' => 'cancel', 'id' => 'cancel', 'content' => 'Cancel', 'class' => 'btn btn-danger btn-sm');
                $cancel_js = 'onClick="window.history.back();"';
                echo form_button($cancel_attributes, '', $cancel_js) . chr(10);
				echo '<span class="padding-left-20">';
					echo '<a href="' . site_url('members/forgot_password') . '">Forgot Password</a>';
				echo '</span>' . chr(10);
			echo '</div>' . chr(10);

			echo form_close() . chr(10);							
			?>

		</div><!-- end of - col -->
	</div><!-- end of - row -->
</div><!-- end of - container -->			