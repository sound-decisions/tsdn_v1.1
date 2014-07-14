<div class="container">
	<div class="row">
		<div class="col col-md-7">

			<?php 
			echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);


			// Display validation errors if there are any.
			echo validation_errors() . chr(10); 
			
			
			// Required field header.
			echo '<div class="clearfix">' . chr(10);
				echo '<p class="pull-right required"><span class="required">*</span>Required Field</p>' . chr(10);
			echo '</div>' . chr(10);


			// Set form label attributes.
			$label_attributes = array('class' => 'control-label');
			

			echo form_open() . chr(10);

			// Add the loadtime hidden field used to detect spam.
			echo form_hidden('lt', encryptIt(time())) . chr(10);				
						


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
			
			echo '<div class="form-group">' . chr(10);
				echo form_label('Confirm Email Address <span class="required">*</span>', 'email_confirm', $label_attributes) . chr(10);
				$input_attributes = array('name' => 'email_confirm', 'id' => 'email_confirm', 'value'  => set_value('email_confirm'), 'maxlength' => '50', 'class' => 'form-control');
				echo form_input($input_attributes) . chr(10);
			echo '</div>' . chr(10);			
			
			echo '<div class="form-group">' . chr(10);
				echo form_label('Password <span class="required">*</span>', 'password', $label_attributes) . chr(10);
				$password_attributes = array('name' => 'password', 'id' => 'password', 'value'  => set_value('password'), 'maxlength' => '20', 'class' => 'form-control');
				echo form_password($password_attributes) . chr(10);
			echo '</div>' . chr(10);	
			echo '<div class="form-group">' . chr(10);
				echo form_label('Confirm Password <span class="required">*</span>', 'password_confirm', $label_attributes) . chr(10);
				$password_attributes = array('name' => 'password_confirm', 'id' => 'password_confirm', 'value'  => set_value('password_confirm'), 'maxlength' => '20', 'class' => 'form-control');
				echo form_password($password_attributes) . chr(10);
			echo '</div>' . chr(10);									

			echo '<div class="form-group">' . chr(10);
				$submit_attributes = array('names' => 'save', 'value' => 'Sign Up', 'class' => 'btn btn-primary');
				echo form_submit($submit_attributes) . chr(10);
                // $cancel_attributes = array('name' => 'cancel', 'id' => 'cancel', 'content' => 'Cancel', 'class' => 'btn btn-danger');
                // $cancel_js = 'onClick="window.history.back();"';
                // echo form_button($cancel_attributes, '', $cancel_js) . chr(10); 	
                echo '<a href="' . site_url('home') . '" class="btn btn-danger">Cancel</a>' . chr(10);				
			echo '</div>' . chr(10);	

			echo form_close() . chr(10);							
			?>

		</div><!-- end of - col col-md-7 -->
		<div class="col col-md-5">

			<h4 class="page_title">Why Sign Up</h4>

			<p>By signing up to the <?php echo DISPLAY_SITE_NAME; ?> you get access to all kinds of extra functionality and features such as:</p>

			<h5 class="margin-top-20">Movies</h5>
			<p>Keep track of your Movie Collection.  
				Indicate which Movies you have seen or want to see.  
				Review and Rate Movies to help other <strong>The Sound Decisions Network</strong> Members pick which Movies to watch.</p>

			<h5 class="margin-top-20">Recipes</h5>
			<p>You can add you own Recipes and keep track of your different versions or attempts at those Recipes.  This will help you to figure out the best version of that Recipe.</p>
			
			<h5 class="margin-top-20">Links</h5>
			<p>Create your own Categories and Sub Categories to save Website Links under so they will be easy to find and visit from wherever you happen to be.</p>
			
			<h5 class="margin-top-20">Notes</h5>
			<p>Create and save Notes and save them in your own Categories and Sub Categories so they are easy to find.  
				No more little pieces of paper lying all over the place.</p>

		</div><!-- end of - col col-md-4 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->			