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
		<div class="col col-md-8">

			<?php
			echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);

			// Content is loaded from the news_list.php view.
			echo '<div id="news_item_content">' . chr(10);
				echo $news_view . chr(10);
			echo '</div>' . chr(10);
			?>

		</div><!-- end of - col col-md-8 -->
		<div class="col col-md-4">

			<?php
			echo '<h4 class="page_title">Latest News</h4>' . chr(10);

			// Content is loaded from the _news_headline_menu.php view.
			echo $news_headline_menu_view . chr(10);
			?>

		</div><!-- end of - col col-md-4 -->		
	</div><!-- end of - row -->
</div><!-- end of - container -->