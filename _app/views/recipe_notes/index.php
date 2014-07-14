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

	        foreach ($recipe_notes as $recipe_note) {

	        	$i++;
				
				$note_content = ($recipe_note['note'] != '' ? str_replace(chr(10), '<br />', $recipe_note['note']) : '');
				
				if ($recipe_note['title'] != '') {
					echo '<h5>' . $recipe_note['title'] . '</h5>' . chr(10);
				}
				
				echo '<p>' . $note_content . '</p>' . chr(10);
				         
	        } // end of - foreach
			?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->