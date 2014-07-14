<?php
if ($displayed_from_page != 'dashboard') {
	//echo '<div class="col col-sm-6">' . chr(10);
}


echo '<h4 class="page_title">Sections</h4>' . chr(10);

echo '<div class="list-group margin-bottom-20">' . chr(10);

	echo '<a href="' . site_url('about-movies') . '" class="list-group-item thin">';
		echo '<div class="clearfix">';
			echo '<div class="list-item-icon">';
				echo '<img src="' . base_url("images/graphics/movies_75.png") . '" class="img-responsive" />';
			echo '</div>';
			echo '<div class="list-item-text">';
				echo '<h4 class="margin-bottom-2">Movies</h4>';
				echo 'Keep track of your movie collection, create a Watch List and indicate which Movies you have seen.';
			echo '</div>';
		echo '</div>';
	echo '</a>' . chr(10);
	
	echo '<a href="' . site_url('about-recipes') . '" class="list-group-item thin">';
		echo '<div class="clearfix">';
			echo '<div class="list-item-icon">';
				echo '<img src="' . base_url("images/graphics/recipes_75.png") . '" class="img-responsive" />';
			echo '</div>';
			echo '<div class="list-item-text">';
				echo '<h4 class="margin-bottom-2">Recipes</h4>';
				//echo 'Our Recipe Section is more of a Log that indicates the original Recipe used and then Notes to indicate the number of variations or options you have for making it.';
				echo 'Save your favorite Recipes here and make notes about them indicating variations or options you have tried.';
			echo '</div>';
		echo '</div>';
	echo '</a>' . chr(10);
	
	echo '<a href="' . site_url('about-links') . '" class="list-group-item thin">';
		echo '<div class="clearfix">';
			echo '<div class="list-item-icon">';
				echo '<img src="' . base_url("images/graphics/links_75.png") . '" class="img-responsive" />';
			echo '</div>';
			echo '<div class="list-item-text">';
				echo '<h4 class="margin-bottom-2">Links</h4>';
				//echo 'Store your favorite website urls by category and they will be available to you where ever you happen to be.';
				echo 'Store your favorite website links and the sign in information needed to access them.';
			echo '</div>';
		echo '</div>';
	echo '</a>' . chr(10);
	
	echo '<a href="' . site_url('about-notes') . '" class="list-group-item thin">';
		echo '<div class="clearfix">';
			echo '<div class="list-item-icon">';
				echo '<img src="' . base_url("images/graphics/notes_75.png") . '" class="img-responsive" />';
			echo '</div>';
			echo '<div class="list-item-text">';
				echo '<h4 class="margin-bottom-2">Notes</h4>';
				//echo 'Instead of using Post It notes or writing things on various pieces of paper, create and save Notes here.  Categories and Sub-Categories will make them easy to find.';
				echo 'Write you Notes here and save them by Category so they are easy find, look at, edit and delete as needed.';
			echo '</div>';
		echo '</div>';
	echo '</a>' . chr(10);
	
	echo '<a href="' . site_url('about-websites') . '" class="list-group-item thin">';
		echo '<div class="clearfix">';
			echo '<div class="list-item-icon">';
				echo '<img src="' . base_url("images/graphics/websites_75.png") . '" class="img-responsive" />';
			echo '</div>';
			echo '<div class="list-item-text">';
				echo '<h4 class="margin-bottom-2">Websites</h4>';
				//echo 'We create many Websites based on ideas we come up with.  You might find some of these interesting, entertaining or useful in some way.';
				echo 'We create some entertaining and useful Websites and make them available here.';
			echo '</div>';
		echo '</div>';
	echo '</a>' . chr(10);	

echo '</div>' . chr(10);



if ($displayed_from_page != 'dashboard') {
	//echo '</div><!-- end of - col col-sm-6-->' . chr(10);
}
?>