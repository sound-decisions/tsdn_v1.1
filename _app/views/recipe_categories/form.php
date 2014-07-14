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
			

			// Required field header.
			echo '<div class="clearfix">' . chr(10);
				echo '<p class="pull-right required"><span class="required">*</span>Required Field</p>' . chr(10);
			echo '</div>' . chr(10);


			// Set form label attributes.
			$label_attributes = array('class' => 'control-label');
			

			echo form_open_multipart() . chr(10);


			// Hidden form fields.
			echo form_hidden('id', (set_value('id') == '' ? @$recipe_category->id : set_value('id')));
			echo form_hidden('current_photo_tn', (set_value('current_photo_tn') == '' ? @$recipe_category->photo_tn : set_value('current_photo_tn')));
						

			echo '<div class="form-group">' . chr(10);
				echo form_label('Name (25 max)<span class="required">*</span>', 'name', $label_attributes) . chr(10);
				$input_attributes = array('name' => 'name', 'id' => 'name', 'value'  => (set_value('name') == '' ? @$recipe_category->name : set_value('name')), 'maxlength' => '25', 'class' => 'form-control');
				echo form_input($input_attributes) . chr(10);
			echo '</div>' . chr(10);
			echo '<div class="form-group">' . chr(10);
				echo form_label('Description', 'description', $label_attributes) . chr(10);
				$textarea_attributes = array('name' => 'description', 'id' => 'description', 'value'  => (set_value('description') == '' ? @$recipe_category->description : set_value('description')), 'rows' => '4', 'class' => 'form-control');
				echo form_textarea($textarea_attributes) . chr(10);
			echo '</div>' . chr(10);	
			echo '<div class="form-group">' . chr(10);
				echo form_label('Photo', 'photo', $label_attributes) . chr(10);
				$upload_attributes = array('name' => 'photo', 'id' => 'photo', 'value'  => '', 'class' => 'form-control');
				echo form_upload($upload_attributes) . chr(10);
			echo '</div>' . chr(10);
			echo '<div class="form-group">' . chr(10);
				echo form_label('Current Photo', 'current_photo', $label_attributes) . chr(10);
				$input_attributes = array('name' => 'current_photo', 'id' => 'current_photo', 'value'  => (set_value('current_photo') == '' ? @$recipe_category->photo : set_value('current_photo')), 'readonly' => 'readonly', 'class' => 'form-control');
				echo form_input($input_attributes) . chr(10);
			echo '</div>' . chr(10);			
			echo '<div class="form-group">' . chr(10);
				echo form_label('Sort Order', 'sort_order', $label_attributes) . chr(10);
				$input_attributes = array('name' => 'sort_order', 'id' => 'sort_order', 'value'  => (set_value('sort_order') == '' ? @$recipe_category->sort_order : set_value('sort_order')), 'maxlength' => '100', 'class' => 'form-control');
				echo form_input($input_attributes) . chr(10);
			echo '</div>' . chr(10);											

			echo '<div class="form-group">' . chr(10);
				$submit_attributes = array('names' => 'save', 'value' => 'Save', 'class' => 'btn btn-primary');
				echo form_submit($submit_attributes) . chr(10);
                $cancel_attributes = array('name' => 'cancel', 'id' => 'cancel', 'content' => 'Cancel', 'class' => 'btn btn-danger');
                $cancel_js = 'onClick="window.history.back();"';
                echo form_button($cancel_attributes, '', $cancel_js) . chr(10); 					
			echo '</div>' . chr(10);	

			echo form_close() . chr(10);							
			?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->			