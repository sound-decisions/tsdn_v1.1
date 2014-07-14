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
		<div class="col col-sm-6 col-md-7 col-lg-8">

			<?php 
			echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);

			// Display validation errors if there are any.
			echo validation_errors() . chr(10); 		
			

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
		
					// Hidden form fields.
					echo form_hidden('id', (set_value('id') == '' ? @$link_category->id : set_value('id')));
		
					echo '<div class="form-group">' . chr(10);
						echo form_label('Name (50 max)<span class="required">*</span>', 'name', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'name', 'id' => 'name', 'value'  => (set_value('name') == '' ? @$link_category->name : set_value('name')), 'autofocus' => 'autofocus', 'maxlength' => '50', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Parent Category', 'parent_id', $label_attributes) . chr(10);
						// Add class and id to dropdown.
						echo form_dropdown('parent_id', $link_category_form_options, (set_value('parent_id') == '' ? @$link_category->parent_id : set_value('parent_id')), 'class="form-control" id="parent_id"') . chr(10);
					echo '</div>' . chr(10);
		
					echo '<div class="form-group margin-top-10">' . chr(10);
						$submit_attributes = array('names' => 'save', 'value' => 'Save', 'class' => 'btn btn-primary btn-sm');
						echo form_submit($submit_attributes) . chr(10);
					echo '</div>' . chr(10);
		
					echo form_close() . chr(10);
			
				echo '</div>' . chr(10); // end of - panel-body
			echo '</div>' . chr(10); // end of panel						
			?>

		</div><!-- end of - col col-md-12 -->		
		<div class="col col-sm-6 col-md-5 col-lg-4">
			
			<?php						
			echo $link_categories_view . chr(10); 			
			?>
			
		</div>
	</div><!-- end of - row -->	
</div><!-- end of - container -->			