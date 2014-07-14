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


					echo form_open('movies/imdb-search') . chr(10);
		
					echo '<div class="form-group">' . chr(10);
						echo form_label('Title <span class="required">*</span>', 'title', $label_attributes) . chr(10);
						$input_attributes = array('name' => 'title', 'id' => 'title', 'value'  => (set_value('title') == '' ? @$news_item->title : set_value('title')), 'maxlength' => '100', 'autofocus' => 'autofocus', 'class' => 'form-control');
						echo form_input($input_attributes) . chr(10);
					echo '</div>' . chr(10);	
		
					echo '<div class="form-group margin-top-10">' . chr(10);
						$submit_attributes = array('names' => 'save', 'value' => 'Search', 'class' => 'btn btn-primary btn-sm');
						echo form_submit($submit_attributes) . chr(10);
		                $cancel_attributes = array('name' => 'cancel', 'id' => 'cancel', 'content' => 'Cancel', 'class' => 'btn btn-danger btn-sm');
		                $cancel_js = 'onClick="window.history.back();"';
		                echo form_button($cancel_attributes, '', $cancel_js) . chr(10);
					echo '</div>' . chr(10);
		
					echo form_close() . chr(10);		
					
					
				echo '</div>' . chr(10); // end of - panel-body
			echo '</div>' . chr(10); // end of panel										
			?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->			