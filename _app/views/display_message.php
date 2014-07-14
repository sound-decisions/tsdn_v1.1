<div class="container">
	<div class="row">
		<div class="col col-md-12">

			<?php
			if ($title != '') {
				echo '<h2>' . html_escape($title) . '</h2>' . chr(10);
			}			
			echo '<div class="alert ' . html_escape($class) . '">' . html_escape($message) . '</div>' . chr(10);
			?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->	