<?php

echo '<div class="list-group margin-bottom-20">' . chr(10);

	foreach ($latest_news as $news_item) {
    	
    	//echo '<a href="#" id="' . $news_item['id'] . '" class="list-group-item show-news-story">' . $news_item['headline'] . '</a>' . chr(10);

    	echo '<a href="#" id="' . $news_item['id'] . '" class="list-group-item thin show-news-story">';
			echo '<div class="clearfix">';
				echo '<div class="list-item-icon">';
					echo '<img src="' . base_url("images/graphics/news_75.png") . '" class="img-responsive" />';
				echo '</div>';
				echo '<div class="list-item-text">';
					echo $news_item['headline'];
				echo '</div>';
			echo '</div>';
		echo '</a>' . chr(10);

	} // end of - foreach

echo '</div>' . chr(10);

/* End of file _news_headline_menu.php */
/* Location: ./application/views/news/_news_headline_menu.php */