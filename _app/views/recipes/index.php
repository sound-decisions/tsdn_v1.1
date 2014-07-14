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
	
	
	echo '<div class="row">' . chr(10);
		echo '<div class="col col-md-12">' . chr(10);
		
			echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);
		
		echo '</div><!-- end of - col col-md-12 -->' . chr(10);
	echo '</div><!-- end of - row -->' . chr(10);
	
	
	echo '<div class="row">' . chr(10);
		echo '<div class="col col-md-12">' . chr(10);
		
			echo $recipes_view . chr(10);  
		
		echo '</div><!-- end of - col col-md-12 -->' . chr(10);
	echo '</div><!-- end of - row -->' . chr(10);	
	
	?>
</div><!-- end of - container -->