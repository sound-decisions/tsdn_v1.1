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

			$i = 0;

	        foreach ($recipe_categories as $recipe_category) {

	        	$i++;

				if ($i % 2 == 0) {
					$panel_class = 'panel-default';
				} else {
					$panel_class = 'panel-custom';
				} 	        	

	        	// Format content for display.
	           	$description_content = ($recipe_category['description'] != '' ? str_replace(chr(10), '<br />', $recipe_category['description']) : '');

	           	echo '<div class="panel-group" id="accordion_' . $i . '">' . chr(10);

					//echo '<div class="panel panel-default tight-list">' . chr(10);
	           		echo '<div class="panel ' . $panel_class . ' tight-list">' . chr(10);
						echo '<div class="panel-heading clearfix">' . chr(10);
							echo '<h5 class="panel-title pull-left">' . chr(10);
								echo '<a data-toggle="collapse" data-parent="#accordion_' . $i . '" href="#collapse_' . $i . '">' . chr(10);
									echo $recipe_category['name'] . chr(10);
								echo '</a>' . chr(10);
							echo '</h5>' . chr(10); // end of - panel-title

							echo '<p class="pull-right">' . chr(10);
								echo '<a data-toggle="collapse" data-parent="#accordion_' . $i . '" href="#collapse_' . $i . '" data-tooltip="tooltip" title="Display Recipe Category Details"><span class="glyphicon glyphicon-eye-open action-link">&nbsp;</span></a>' . chr(10);
								// Only display the delete icon for admins.
								if ($this->session->userdata('member_access') == 'admin') {								
									echo '<a href="' . site_url("recipe_categories/edit/") . '/' . $recipe_category['id'] . '" data-toggle="tooltip" title="Edit Recipe Category"><span class="glyphicon glyphicon-pencil action-link">&nbsp;</span></a>' . chr(10);
									echo '<a href="' . site_url("recipe_categories/delete/") . '/' . $recipe_category['id'] . '" onclick="return confirm(\'Are you sure you want to delete this recipe category?\');" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-remove action-link">&nbsp;</span></a>' . chr(10);
								}
							echo '</p>' . chr(10);

						echo '</div>' . chr(10); // end of - panel-heading
						echo '<div id="collapse_' . $i . '" class="panel-collapse collapse">' . chr(10);
							echo '<div class="panel-body">' . chr(10);

								echo '<div class="clearfix">' . chr(10);
									echo '<div class="pull-left">' . chr(10);

										if ($recipe_category['photo_tn'] != '') {

											$image_properties = array(
											          'src' => base_url(RECIPE_CATEGORY_PHOTOS_PATH . $recipe_category['photo_tn']),
											          'alt' => 'Recipe Category Photo',
											          'class' => 'img-responsive img-rounded padding-right-20',
											          'width' => '100',
											          'height' => '100',
											          'title' => 'Recipe Category Photo',
											);

											echo img($image_properties) . chr(10);

										}

									echo '</div>' . chr(10);
									echo '<div>' . chr(10);
										if ($description_content != '') echo '<p>' . $description_content . '</p>' . chr(10);
									echo '</div>' . chr(10);
								echo '</div>' . chr(10);															

							echo '</div>' . chr(10); // end of - panel-body
							echo '<div class="panel-footer clearfix">' . chr(10);
								echo '<p class="pull-left">Added On:  ' . dateFormattedForDisplayLongVersion($recipe_category['created_at']) . '</p>' . chr(10);
								echo '<p class="pull-right">Sort Order:  ' . $recipe_category['sort_order'] . '</p>' . chr(10);
							echo '</div>' . chr(10); // end of - panel-footer
						echo '</div>' . chr(10); // end of - panel-collapse
					echo '</div>' . chr(10); // end of - panel panel-default

				echo '</div>' . chr(10); // end of - panel-group			
				         
	        } // end of - foreach
			?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->