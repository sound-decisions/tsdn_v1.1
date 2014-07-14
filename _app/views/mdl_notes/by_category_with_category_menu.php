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
		<div class="col col-sm-7 col-md-7 col-lg-8">

			<?php
			echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);

			echo $notes_view . chr(10);
			?>

		</div>		
		<div class="col col-sm-5 col-md-5 col-lg-4">
			
			<?php						
			echo $note_categories_view . chr(10); 			
			?>
			
		</div>
	</div><!-- end of - row -->
</div><!-- end of - container -->