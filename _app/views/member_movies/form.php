<div class="container">
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
			

			echo form_open($form_action) . chr(10);

			// Hidden form fields.
			echo form_hidden('id', (set_value('id') == '' ? @$member_movie->id : set_value('id')));


			echo '<div class="form-group">' . chr(10);
				echo form_label('Index Number', 'title', $label_attributes) . chr(10);
				$input_attributes = array('name' => 'index_number', 'id' => 'index_number', 'value'  => (set_value('index_number') == '' ? @$member_movie->index_number : set_value('index_number')), 'maxlength' => '12', 'class' => 'form-control');
				echo form_input($input_attributes) . chr(10);
			echo '</div>' . chr(10);
			
			echo '<div class="form-group">' . chr(10);
				echo form_label('Review', 'title', $label_attributes) . chr(10);
				$textarea_attributes = array('name' => 'review_text', 'id' => 'review_text', 'value'  => (set_value('review_text') == '' ? @$member_movie->review_text : set_value('review_text')), 'rows' => '8', 'class' => 'form-control');
				echo form_textarea($textarea_attributes) . chr(10);
			echo '</div>' . chr(10);

			echo '<div class="form-group">' . chr(10);
				echo form_label('Genre', 'genre', $label_attributes) . chr(10);
				// Get the genre values if there are any.
				//$genre_values = 'Action, Adventure, Crime, Drama';
				$genre_values = (set_value('genre') == '' ? @$member_movie->genre : set_value('genre'));
				
				echo '<div class="clearfix">' . chr(10);
				foreach($genre_options as $key => $value) {
					echo '<div class="col col-xs-6 col-sm-4 col-md-3 col-lg-2">' . chr(10);
						// Determine if the checkbox should be checked or not.
						if (strpos($genre_values, $value) !== false) {
						    $checked_or_not = TRUE;
						} else {
							$checked_or_not = FALSE;
						}														
						echo form_checkbox('genre[]', $value, $checked_or_not);
						echo '<span class="padding-left-10"><strong>' . $key . '</strong></span>';
					echo '</div>' . chr(10);
				}
				echo '</div>' . chr(10);				
			echo '</div>' . chr(10);

			echo '<div class="form-group">' . chr(10);
				echo form_label('Year Released', 'year_released', $label_attributes) . chr(10);
				$input_attributes = array('name' => 'year_released', 'id' => 'year_released', 'value'  => (set_value('year_released') == '' ? @$member_movie->year_released : set_value('year_released')), 'maxlength' => '4', 'class' => 'form-control');
				echo form_input($input_attributes) . chr(10);
			echo '</div>' . chr(10);
			
			echo '<div class="form-group">' . chr(10);
				echo form_label('Runtime', 'runtime', $label_attributes) . chr(10);
				$input_attributes = array('name' => 'runtime', 'id' => 'runtime', 'value'  => (set_value('runtime') == '' ? @$member_movie->runtime : set_value('runtime')), 'maxlength' => '10', 'class' => 'form-control');
				echo form_input($input_attributes) . chr(10);
			echo '</div>' . chr(10);
			
			echo '<div class="form-group">' . chr(10);
				echo form_label('MPAA Rating', 'mpaa_rating', $label_attributes) . chr(10);
                $data = 'id="mpaa_rating" class="form-control"';
				echo form_dropdown('mpaa_rating', $mpaa_rating_options, (set_value('mpaa_rating') == '' ? @$member_movie->mpaa_rating : set_value('mpaa_rating')), $data) . chr(10);
			echo '</div>' . chr(10);

			echo '<div class="form-group">' . chr(10);
				echo form_label('Starring', 'starring', $label_attributes) . chr(10);
				$textarea_attributes = array('name' => 'starring', 'id' => 'starring', 'value'  => (set_value('starring') == '' ? @$member_movie->starring : set_value('starring')), 'rows' => '2', 'class' => 'form-control');
				echo form_textarea($textarea_attributes) . chr(10);
			echo '</div>' . chr(10);
			
			echo '<div class="form-group">' . chr(10);
				echo form_label('Directed By', 'directed_by', $label_attributes) . chr(10);
				$textarea_attributes = array('name' => 'directed_by', 'id' => 'directed_by', 'value'  => (set_value('directed_by') == '' ? @$member_movie->directed_by : set_value('directed_by')), 'rows' => '1', 'class' => 'form-control');
				echo form_textarea($textarea_attributes) . chr(10);
			echo '</div>' . chr(10);
			
			echo '<div class="form-group">' . chr(10);
				echo form_label('Written By', 'written_by', $label_attributes) . chr(10);
				$textarea_attributes = array('name' => 'written_by', 'id' => 'written_by', 'value'  => (set_value('written_by') == '' ? @$member_movie->written_by : set_value('written_by')), 'rows' => '1', 'class' => 'form-control');
				echo form_textarea($textarea_attributes) . chr(10);
			echo '</div>' . chr(10);
			
			echo '<div class="form-group">' . chr(10);
				echo form_label('Produced By', 'produced_by', $label_attributes) . chr(10);
				$textarea_attributes = array('name' => 'produced_by', 'id' => 'produced_by', 'value'  => (set_value('produced_by') == '' ? @$member_movie->produced_by : set_value('produced_by')), 'rows' => '1', 'class' => 'form-control');
				echo form_textarea($textarea_attributes) . chr(10);
			echo '</div>' . chr(10);	

			echo '<div class="form-group">' . chr(10);
				echo form_label('IMDB Image URL', 'imdb_image_url', $label_attributes) . chr(10);
				$input_attributes = array('name' => 'imdb_image_url', 'id' => 'imdb_image_url', 'value'  => (set_value('imdb_image_url') == '' ? @$member_movie->imdb_image_url : set_value('imdb_image_url')), 'maxlength' => '200', 'class' => 'form-control');
				echo form_input($input_attributes) . chr(10);
			echo '</div>' . chr(10);
			
			echo '<div class="form-group">' . chr(10);
				echo form_label('IMDB ID', 'imdb_id', $label_attributes) . chr(10);
				$input_attributes = array('name' => 'imdb_id', 'id' => 'imdb_id', 'value'  => (set_value('imdb_id') == '' ? @$member_movie->imdb_id : set_value('imdb_id')), 'maxlength' => '10', 'class' => 'form-control');
				echo form_input($input_attributes) . chr(10);
			echo '</div>' . chr(10);


			echo '<div class="form-group">' . chr(10);
				echo form_label('Image', 'image', $label_attributes) . chr(10);
				$upload_attributes = array('name' => 'image', 'id' => 'image', 'value'  => '', 'class' => 'form-control');
				echo form_upload($upload_attributes) . chr(10);
			echo '</div>' . chr(10);
			echo '<div class="form-group">' . chr(10);
				echo form_label('Current Image', 'current_image', $label_attributes) . chr(10);
				$input_attributes = array('name' => 'current_image', 'id' => 'current_image', 'value'  => (set_value('current_image') == '' ? @$member_movie->image : set_value('current_image')), 'readonly' => 'readonly', 'class' => 'form-control');
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