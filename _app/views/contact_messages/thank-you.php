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

			<p>We will review your message right away and deal with things accordingly.</p>

			<p>If need be we will get in touch with you as soon as we can.</p>

			<p>Thanks Very Much,</p>

			<h5>The Management</h5>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
</div><!-- end of - container -->