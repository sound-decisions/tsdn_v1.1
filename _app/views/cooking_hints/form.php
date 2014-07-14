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
			

			// Required field header.
			echo '<div class="clearfix">' . chr(10);
				echo '<p class="pull-right required"><span class="required">*</span>Required Field</p>' . chr(10);
			echo '</div>' . chr(10);


			// Set form label attributes.
			$label_attributes = array('class' => 'control-label');
			

			echo form_open() . chr(10);


			// Hidden form fields.
			echo form_hidden('id', (set_value('id') == '' ? @$cooking_hint->id : set_value('id')));
						

			echo '<div class="form-group">' . chr(10);
				echo form_label('Title <span class="required">*</span>', 'name', $label_attributes) . chr(10);
				$input_attributes = array('name' => 'title', 'id' => 'title', 'value'  => (set_value('title') == '' ? @$cooking_hint->title : set_value('title')), 'maxlength' => '200', 'class' => 'form-control');
				echo form_input($input_attributes) . chr(10);
			echo '</div>' . chr(10);
			echo '<div class="form-group">' . chr(10);
				echo form_label('Content <span class="required">*</span>', 'content', $label_attributes) . chr(10);
				$textarea_attributes = array('name' => 'content', 'id' => 'content', 'value'  => (set_value('content') == '' ? @$cooking_hint->content : set_value('content')), 'rows' => '4', 'class' => 'form-control');
				echo form_textarea($textarea_attributes) . chr(10);
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