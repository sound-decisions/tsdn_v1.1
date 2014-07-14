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
		
					// Hidden form fields.
					echo form_hidden('id', (set_value('id') == '' ? @$news_item->id : set_value('id')));
		
					echo '<div class="form-group">' . chr(10);
						echo form_label('Headline <span class="required">*</span>', 'headline', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'headline', 'id' => 'headline', 'value'  => (set_value('headline') == '' ? @$news_item->headline : set_value('headline')), 'maxlength' => '200', 'autofocus' => 'autofocus', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);
					echo '<div class="form-group">' . chr(10);
						echo form_label('Story <span class="required">*</span>', 'story', $label_attributes) . chr(10);
						$textarea_attributes = array('name' => 'story', 'id' => 'story', 'value'  => (set_value('story') == '' ? @$news_item->story : set_value('story')), 'rows' => '10', 'class' => 'form-control');
						echo form_textarea($textarea_attributes) . chr(10);
					echo '</div>' . chr(10);
		
					echo '<div class="form-group margin-top-10">' . chr(10);
						$submit_attributes = array('names' => 'save', 'value' => 'Save', 'class' => 'btn btn-primary btn-sm');
						echo form_submit($submit_attributes) . chr(10);
		                $cancel_attributes = array('name' => 'cancel', 'id' => 'cancel', 'content' => 'Cancel', 'id' => 'go-back', 'class' => 'btn btn-danger btn-sm');
						echo form_button($cancel_attributes) . chr(10);
					echo '</div>' . chr(10);
		
					echo form_close() . chr(10);
				
				echo '</div>' . chr(10); // end of - panel-body
			echo '</div>' . chr(10); // end of panel									
			?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->			