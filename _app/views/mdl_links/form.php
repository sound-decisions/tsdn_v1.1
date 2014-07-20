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
					echo form_hidden('id', (set_value('id') == '' ? @$link->id : set_value('id')));
		
		
					echo '<div class="form-group">' . chr(10);
						echo form_label('URL <span class="required">*</span>', 'url', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'url', 'id' => 'url', 'value'  => (set_value('url') == '' ? @$link->url : set_value('url')), 'autofocus' => 'autofocus', 'maxlength' => '200', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Name <span class="required">*</span>', 'name', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'name', 'id' => 'name', 'value'  => (set_value('name') == '' ? @$link->name : set_value('name')), 'maxlength' => '100', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Link Category <span class="required">*</span>', 'category_id', $label_attributes) . chr(10);
						// Add class and id to dropdown.
						echo form_dropdown('category_id', $link_category_form_options, (set_value('category_id') == '' ? @$link->category_id : set_value('category_id')), 'class="form-control" id="category_id"') . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Description', 'description', $label_attributes) . chr(10);
						$textarea_attributes = array('name' => 'description', 'id' => 'description', 'value'  => (set_value('description') == '' ? @$link->description : set_value('description')), 'rows' => '4', 'class' => 'form-control');
						echo form_textarea($textarea_attributes) . chr(10);
					echo '</div>' . chr(10);

					echo '<div class="checkbox">' . chr(10);
						echo '<label class="control-label">' . chr(10);
							$featured = (set_value('featured') == '' ? @$link->featured : set_value('featured'));
							//$featured = 'yes';
							echo '<input type="checkbox" id="featured" name="featured"' . (($featured == 'yes') ? " checked=\"checked\"" : '') . ' value="yes"><span class="text-bold ">Featured Link</span>' . chr(10);						
						echo '</label>' . chr(10);
					echo '</div>' . chr(10);


                    echo '<div class="form-group margin-top-20 margin-bottom-10">' . chr(10);
                        echo '<h5 class="text-color">Sign In/Login Information</h5>' . chr(10);
                    echo '</div>' . chr(10);

					echo '<div class="form-group">' . chr(10);
						echo form_label('Username', 'username', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'username', 'id' => 'username', 'value'  => (set_value('username') == '' ? @$link->username : set_value('username')), 'maxlength' => '50', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
                    echo '<div class="form-group">' . chr(10);
                        echo form_label('Email Address', 'email', $label_attributes) . chr(10);
                        $input_attributes = array('name' => 'email', 'id' => 'email', 'value'  => (set_value('email') == '' ? @$link->email : set_value('email')), 'maxlength' => '50', 'class' => 'form-control');
                        echo form_input($input_attributes) . chr(10);
                    echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Password', 'password', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'password', 'id' => 'password', 'value'  => (set_value('password') == '' ? @$password : set_value('password')), 'maxlength' => '50', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
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