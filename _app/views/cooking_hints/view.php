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
	        	// Format content for display.
	            $cooking_hint_content = ($cooking_hind->content != '' ? str_replace(chr(10), '<br />', $cooking_hind->content) : '');
								
				echo '<h4>' . $cooking_hint->title . '</h4>' . chr(10);
				echo '<p>' . $cooking_hint_content . '</p>' . chr(10);
				?>
			</div>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->