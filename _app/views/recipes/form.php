<div class="container">
	<div class="row">
		<div class="col col-md-12">

			<?php 
			echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);

			// Display validation errors if there are any.
			echo validation_errors() . chr(10); 
			// Display Image Upload errors if there are any.
			echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>') . chr(10);
			

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
					echo form_hidden('id', (set_value('id') == '' ? @$recipe->id : set_value('id')));
		
					echo '<div class="form-group">' . chr(10);
						echo form_label('Name <span class="required">*</span>', 'name', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'name', 'id' => 'name', 'value'  => (set_value('name') == '' ? @$recipe->name : set_value('name')), 'maxlength' => '100', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Recipe Category <span class="required">*</span>', 'category_id', $label_attributes) . chr(10);
						// Add class and id to dropdown.
						echo form_dropdown('category_id', $recipe_category_form_options, (set_value('category_id') == '' ? @$recipe->category_id : set_value('category_id')), 'class="form-control" id="category_id"') . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Description <span class="required">*</span>', 'description', $label_attributes) . chr(10);
						$textarea_attributes = array('name' => 'description', 'id' => 'description', 'value'  => (set_value('description') == '' ? @$recipe->description : set_value('description')), 'rows' => '2', 'class' => 'form-control');
						echo form_textarea($textarea_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Ingredients <span class="required">*</span>', 'ingredients', $label_attributes) . chr(10);
						$textarea_attributes = array('name' => 'ingredients', 'id' => 'ingredients', 'value'  => (set_value('ingredients') == '' ? @$recipe->ingredients : set_value('ingredients')), 'rows' => '8', 'class' => 'form-control');
						echo form_textarea($textarea_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Directions <span class="required">*</span>', 'directions', $label_attributes) . chr(10);
						$textarea_attributes = array('name' => 'directions', 'id' => 'directions', 'value'  => (set_value('directions') == '' ? @$recipe->directions : set_value('directions')), 'rows' => '16', 'class' => 'form-control');
						echo form_textarea($textarea_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Access Level (who can see the recipe)', 'access', $label_attributes) . chr(10);
						// Add class and id to dropdown.
						echo form_dropdown('access', $access_form_options, (set_value('access') == '' ? @$recipe->access : set_value('access')), 'class="form-control" id="access"') . chr(10);
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