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

			<h4 class="page_title"><?php echo $title; ?></h4>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
	<div class="row">	
		<div class="col col-md-12">

				<?php
	        	// Format content for display.
	            $description_content = ($recipe->description != '' ? str_replace(chr(10), '<br />', $recipe->description) : '');
	            //$ingredients_content = ($recipe->ingredients != '' ? str_replace(chr(10), '<br />', $recipe->ingredients) : '');
	            //$directions_content = ($recipe->directions != '' ? str_replace(chr(10), '<br />', $recipe->directions) : '');	            

	            $a_ingedients = explode(chr(10), $recipe->ingredients);
	            $a_directions = explode(chr(10), $recipe->directions);

				echo '<div class="panel panel-default">' . chr(10);
					echo '<div class="panel-heading">' . chr(10);
						echo '<h4>' . $recipe->name . '</h4>' . chr(10);
					echo '</div>' . chr(10); // end of - panel-heading
					echo '<div class="panel-body">' . chr(10);
						
						echo '<h5>Description</h5>' . chr(10);
		                echo '<div>' . chr(10);
		                    echo $description_content . chr(10);
		                echo '</div>' . chr(10);

		                echo '<h5>Ingredients</h5>' . chr(10);
		                echo '<div>' . chr(10);
		                	echo '<ul>' . chr(10);

		                		foreach ($a_ingedients as $ingredient) {
		                			if ($ingredient != '') echo '<li>' . $ingredient . '</li>' . chr(10);
		                		}

		                	echo '</ul>' . chr(10);
		                echo '</div>' . chr(10);

		                echo '<h5>Directions</h5>' . chr(10);
		                echo '<div>' . chr(10);
		                	echo '<ul>' . chr(10);

		                		foreach ($a_directions as $direction) {
		                			if ($direction != '') echo '<li>' . $direction . '</li>' . chr(10);
		                		}

		                	echo '</ul>' . chr(10);
		                echo '</div>' . chr(10);
						
					echo '</div>' . chr(10); // end of - panel-body
					echo '<div class="panel-footer">' . chr(10);

	                	echo '<div class="clearfix">' . chr(10);
		                	echo '<div class="pull-left">' . chr(10);
		                		echo '<p>' . dateAndTimeFormattedForDisplayShortVersion($recipe->created_at) . '</p>' . chr(10);
		                	echo '</div>' . chr(10);
		                	echo '<div class="pull-right">' . chr(10);			                 
											
								// Only allow signed in members to add recipe notes.
								// if ($this->session->userdata('member_id') != '') {																		
									// echo '<a href="' . site_url("recipe_notes/add/") . '/' . $recipe->id . '" data-toggle="tooltip" title="Add A Note"><span class="glyphicon glyphicon-file action-link">&nbsp;</span></a>' . chr(10);
								// }												
											
								// Only display the edit and delete icons for the owner of the recipe.
								if ($this->session->userdata('member_id') == $recipe->member_id) {		                    	
				                    echo '<div class="btn-group">' . chr(10);
				                    	echo '<a href="' . site_url("recipes/edit/") . '/' . $recipe->id . '" class="btn btn-success btn-thin">Edit</a>' . chr(10);
				                    	echo '<a href="' . site_url("recipes/delete/") . '/' . $recipe->id . '" class="btn btn-danger btn-thin" onclick="return confirm(\'Are you sure you want to delete this recipe?\');">Delete</a>' . chr(10);
									echo '</div>' . chr(10);
				            	}
			             	echo '</div>' . chr(10);
		             	echo '</div>' . chr(10);

					echo '</div>' . chr(10); // end of - panel-footer					
				echo '</div>' . chr(10); // end of - panel
				
				
				// // Display recipe notes.
				// echo '<div class="col col-md-10 col-md-offset-1">' . chr(10);
// 				
					// $i = 0;
// 					
					// foreach ($recipe_notes as $recipe_note) {
// 					
						// $i++;
// 						
						// // Display the title for the section the first time through the loop.
						// if ($i == 1) {
							// //echo '<h4>Recipe Notes</h4>' . chr(10);
							// echo '<div class="panel-group" id="accordion">' . chr(10);
								// echo '<div class="panel panel-default">' . chr(10);
									// echo '<div class="panel-heading">';
										// echo '<h4 class="panel-title">';
											// echo '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#recipeNotes">';
												// echo '<span class="padding-right-10 glyphicon glyphicon-collapse-down"> </span>';
												// echo 'Show Recipe Notes';
												// //echo '<span class="padding-left-20 glyphicon glyphicon-collapse-down"></span>';
											// echo '</a>';
										// echo '</h4>'; // end of - panel-title
									// echo '</div>' . chr(10); // end of - panel-heading		
									// echo '<div id="recipeNotes" class="panel-collapse collapse">' . chr(10);
										// echo '<div class="panel-body">' . chr(10);													
						// }
// 						
						// // Determine the class for the panel.
						// if ($i % 2 == 0) {
							// $panel_class = 'panel-default';
						// } else {
							// $panel_class = 'panel-custom';
						// } 					
// 							
						// $note_content = ($recipe_note['note'] != '' ? str_replace(chr(10), '<br />', $recipe_note['note']) : '');
// 						
						// // echo '<h5>' . $recipe_note['title'] . '</h5>' . chr(10);
						// // echo '<p class="margin-bottom-20">' . $note_content . '</p>' . chr(10);
// 						
// 						
						// echo '<div class="panel ' . $panel_class . '">' . chr(10);
							// echo '<div class="panel-heading"><h5>' . $recipe_note['title'] . '</h5></div>' . chr(10);
							// echo '<div class="panel-body">' . chr(10);
						    	// echo '<p>' . $note_content . '</p>' . chr(10);
						  	// echo '</div>' . chr(10); // end of - panel-body
						// echo '</div>' . chr(10); // end of - panel					
// 						
// 						
// 						
					// } // end of - foreach
// 					
// 					
					// if ($i >= 1) {
									// echo '</div>' . chr(10); // end of - panel-body
								// echo '</div>' . chr(10); // end of - panel-collapse
							// echo '</div>' . chr(10); // end of - panel
						// echo '</div>' . chr(10); // end of - panel-group					
					// }
// 					
					// // No records found so display an alert message.
					// if ($i == 0) {
						// //echo '<div class="alert alert-danger">No Recipes Notes Found</div>' . chr(10);
					// }  		
// 					
				// echo '</div>' . chr(10);														
				?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->