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
			//echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);

			$i = 0;

	        foreach ($cooking_hints as $cooking_hint) {

	        	$i++;

				if ($i % 2 == 0) {
					$panel_class = 'panel-default';
				} else {
					$panel_class = 'panel-custom';
				} 	        	
				
	        	// Format content for display.
	            $cooking_hint_content = ($cooking_hint['content'] != '' ? str_replace(chr(10), '<br />', $cooking_hint['content']) : '');				
				
				if ($i == 1) {
					echo '<h4>' . $cooking_hint['title'] . '</h4>' . chr(10);
				} else {
					echo '<h4 class="margin-top-20">' . $cooking_hint['title'] . '</h4>' . chr(10);
				}
				
				echo '<p>' . $cooking_hint_content . '</p>' . chr(10);
				         
	        } // end of - foreach
			?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->