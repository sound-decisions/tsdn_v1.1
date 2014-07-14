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

			<div>
				<?php
				// Format values for display.
				$description_content = ($recipe_category->description != '' ? str_replace(chr(10), '<br />', $recipe_category->description) : '');

				echo '<h3>' . $recipe_category->name . '</h3>' . chr(10);
				if ($description_content != '') echo '<p>' . $description_content . '</p>' . chr(10);		
				// if ($description_content != '') {
				// 	echo '<p>' . $recipe_category->description . '</p>' . chr(10);		
				// }
				echo '<p>Sort Order:  ' . $recipe_category->sort_order . '</p>' . chr(10);
				?>
			</div><!-- end of - magazine -->

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->