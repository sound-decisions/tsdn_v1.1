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
		<div class="col col-xs-12 col-sm-3 col-lg-3">

			<?php
			$image_properties = array(
			          'src' => base_url(RECIPE_CATEGORY_PHOTOS_PATH . $recipe_category->photo),
			          'alt' => 'Recipe Category Photo',
			          'class' => 'img-responsive img-rounded',
			          'width' => '200',
			          'height' => '200',
			          'title' => 'Recipe Category Photo',
			);

			echo img($image_properties) . chr(10);
			?>

		</div><!-- end of - col col-sm-3 -->
		<div class="col col-xs-12 col-sm-9 col-lg-9">

			<?php
			// Format values for display.
			$description_content = ($recipe_category->description != '' ? str_replace(chr(10), '<br />', $recipe_category->description) : '');
			
			// $label_class = 'col-xs-12 col-sm-4 col-md-3 col-lg-3 detail_label';
			// $content_class = 'col-xs-12 col-sm-8 col-md-9 col-lg-9';
			
			$label_class = 'col-xs-12 detail_label_left';
			$content_class = 'col-xs-12';			

			echo '<div class="detail_section">' . chr(10);
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . ' first">Name:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $recipe_category->name . '</p>' . chr(10);
				echo '</div>' . chr(10);
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Description:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $description_content . '</p>' . chr(10);
				echo '</div>' . chr(10);	
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Sort Order:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . $recipe_category->sort_order . '</p>' . chr(10);
				echo '</div>' . chr(10);
									
				echo '<div class="clearfix">' . chr(10);
					echo '<p class="' . $label_class . '">Added On:</p>' . chr(10);
					echo '<p class="' . $content_class . '">' . dateAndTimeFormattedForDisplayLongVersionWithDayName($recipe_category->created_at) . '</p>' . chr(10);
				echo '</div>' . chr(10);
				
				echo '<div class="clearfix">' . chr(10);
					echo '<div class="pull-right margin-top-10">' . chr(10);
					
						echo '<div>';
							echo '<a href="' . site_url('recipe_categories/edit/' . $recipe_category->id . '') . '" class="btn btn-primary">Edit Recipe Category</a>';
							echo '<span class="padding-right-10"></span>';
							echo '<a id="go-back" href="#" class="btn btn-danger">Cancel</a>';
						echo '</div>' . chr(10);
					
					echo '</div>' . chr(10);
				echo '</div>' . chr(10);
				
			echo '</div>' . chr(10);																	
			?>

		</div><!-- end of - col col-sm-9 -->
	</div><!-- end of - row -->	
	
</div><!-- end of - container -->