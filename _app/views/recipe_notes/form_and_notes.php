<div class="container">
	<div class="row">
		<div class="col col-md-12">

			<?php 
			// Display recipe notes.
			echo '<div class="col col-md-10 col-md-offset-1">' . chr(10);
			
				$i = 0;
				
				foreach ($recipe_notes as $recipe_note) {
				
					$i++;
					
					// Display the title for the section the first time through the loop.
					if ($i == 1) {
						//echo '<h4>Recipe Notes</h4>' . chr(10);
						echo '<div class="panel-group" id="accordion">' . chr(10);
							echo '<div class="panel panel-default">' . chr(10);
								echo '<div class="panel-heading">';
									echo '<h4 class="panel-title">';
										echo '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#recipeNotes">';
											echo '<span class="padding-right-10 glyphicon glyphicon-collapse-down"> </span>';
											echo 'Show Recipe Notes';
											//echo '<span class="padding-left-20 glyphicon glyphicon-collapse-down"></span>';
										echo '</a>';
									echo '</h4>'; // end of - panel-title
								echo '</div>' . chr(10); // end of - panel-heading		
								echo '<div id="recipeNotes" class="panel-collapse collapse">' . chr(10);
									echo '<div class="panel-body">' . chr(10);
					}
					
					// Determine the class for the panel.
					if ($i % 2 == 0) {
						$panel_class = 'panel-default';
					} else {
						$panel_class = 'panel-custom';
					} 					
						
					$note_content = ($recipe_note['note'] != '' ? str_replace(chr(10), '<br />', $recipe_note['note']) : '');
					
					// echo '<h5>' . $recipe_note['title'] . '</h5>' . chr(10);
					// echo '<p class="margin-bottom-20">' . $note_content . '</p>' . chr(10);
					
					
					echo '<div class="panel ' . $panel_class . '">' . chr(10);
						echo '<div class="panel-heading"><h5>' . $recipe_note['title'] . '</h5></div>' . chr(10);
						echo '<div class="panel-body">' . chr(10);
					    	echo '<p>' . $note_content . '</p>' . chr(10);
					  	echo '</div>' . chr(10); // end of - panel-body
					  	
					  	
					  	
						echo '<div class="panel-footer">' . chr(10);
	
		                	echo '<div class="clearfix">' . chr(10);
			                	echo '<div class="pull-left">' . chr(10);
			                		echo '<p>' . dateAndTimeFormattedForDisplayShortVersion($recipe_note['created_at']) . '</p>' . chr(10);
			                	echo '</div>' . chr(10);
			                	echo '<div class="pull-right">' . chr(10);			                 
														
									// Only display the edit and delete icons for the owner of the recipe.
									if  (($this->session->userdata('member_id') == $recipe_note['member_id']) || ($this->session->userdata('member_access') == 'admin')) {
										echo '<div class="btn-group">' . chr(10);
					                    	echo '<a href="' . site_url("recipe_notes/edit/") . '/' . $recipe_note['id'] . '" class="btn btn-success btn-thin">Edit</a>' . chr(10);
					                    	echo '<a href="' . site_url("recipe_notes/delete/") . '/' . $recipe_note['id'] . '" class="btn btn-danger btn-thin" onclick="return confirm(\'Are you sure you want to delete this recipe note?\');">Delete</a>' . chr(10);
										echo '</div>' . chr(10);
					            	}
				             	echo '</div>' . chr(10);
			             	echo '</div>' . chr(10);
	
						echo '</div>' . chr(10); // end of - panel-footer						  	
					  	
					  	
					  	
					echo '</div>' . chr(10); // end of - panel					
					
					
					
				} // end of - foreach
				
				
				// Close up the accordion panel.
				if ($i >= 1) {
								echo '</div>' . chr(10); // end of - panel-body
							echo '</div>' . chr(10); // end of - panel-collapse
						echo '</div>' . chr(10); // end of - panel
					echo '</div>' . chr(10); // end of - panel-group					
				}
				
				// No records found so display an alert message.
				if ($i == 0) {
					//echo '<div class="alert alert-danger">No Recipes Notes Found</div>' . chr(10);
				}  		
				
			echo '</div>' . chr(10); // end of - col-md-10 col-md-offset-1						
			?>

		</div><!-- end of - col col-md-12 -->		
	</div><!-- end of - row -->		
	<div class="row">
		<!-- <div class="col col-md-12"> -->

		<?php 
		// If notes have been displayed then we need add a margin to the top of this next row.
		if ($i > 0) {
			echo '<div class="col col-md-12 margin-top-20">' . chr(10);
		} else {
			echo '<div class="col col-md-12">' . chr(10);
		}
		
			echo '<div class="col col-md-10 col-md-offset-1">' . chr(10);
			
				
				echo '<div class="panel panel-form">' . chr(10);
				  	echo '<div class="panel-heading">';
				  		echo '<h4 class="panel-title">Add A Note</h4>';
				  	echo '</div>' . chr(10); // end of - panel-heading
				  	echo '<div class="panel-body">' . chr(10);
				    
					
						// Display validation errors if there are any.
						echo validation_errors() . chr(10); 
						
						
						if ($recipe_id == '') {
							$recipe_id = @$recipe_note->recipe_id;
						}						
						
						
						// Set form label attributes.
						$label_attributes = array('class' => 'control-label');
			
						
						echo form_open('recipe_notes/add') . chr(10);
			
						// The @ before variable will help to not  display an error if this value isn't set.
						echo form_hidden('id', (set_value('id') == '' ? @$recipe_note->id : set_value('id')));
						echo form_hidden('recipe_id', (set_value('recipe_id') == '' ? $recipe_id : set_value('recipe_id')));
						//echo form_hidden('version_id', (set_value('version_id') == '' ? @$recipe_note->version_id : set_value('version_id')));
						//echo form_hidden('member_id', (set_value('member_id') == '' ? @$recipe_note->member_id : set_value('member_id')));			
									
			
						// START OF - Check for SPAM.
						// This field is used as a spam check.
						echo '<div class="form-group email_address_sd">' . chr(10);
							echo form_label('Do Not Fill In This Field', 'email_address', $label_attributes) . chr(10);
							$input_attributes = array('name' => 'email_address', 'id' => 'email_address', 'value'  => set_value('email_address'), 'maxlength' => '50', 'class' => 'form-control');
							echo form_input($input_attributes) . chr(10);
						echo '</div>' . chr(10);
						// END OF - Check for SPAM.
			
			
						echo '<div class="form-group">' . chr(10);
							echo form_label('Title', 'title', $label_attributes) . chr(10);
							$input_attributes = array('name' => 'title', 'id' => 'title', 'value'  => (set_value('title') == '' ? @$recipe_note->title : set_value('title')), 'maxlength' => '100', 'class' => 'form-control');
							echo form_input($input_attributes) . chr(10);
						echo '</div>' . chr(10);
			
						echo '<div class="form-group">' . chr(10);
							echo form_label('Note', 'note', $label_attributes) . chr(10);
							$textarea_attributes = array('name' => 'note', 'id' => 'note', 'value'  => (set_value('note') == '' ? @$recipe_note->note : set_value('note')), 'rows' => '5', 'class' => 'form-control');
							echo form_textarea($textarea_attributes) . chr(10);
						echo '</div>' . chr(10);
			
						echo '<div class="form-group margin-top-10">' . chr(10);
							$submit_attributes = array('names' => 'save', 'value' => 'Save Note', 'class' => 'btn btn-primary btn-sm');
							echo form_submit($submit_attributes) . chr(10);
						echo '</div>' . chr(10);
			
						echo form_close() . chr(10);


				  	echo '</div>' . chr(10); // end of - panel-body
				echo '</div>' . chr(10); // end of - panel
				
			echo '</div>' . chr(10); // end of - col-md-10 col-md-offset-1							
			?>

		</div><!-- end of - col col-md-12 -->		
	</div><!-- end of - row -->
</div><!-- end of - container -->			