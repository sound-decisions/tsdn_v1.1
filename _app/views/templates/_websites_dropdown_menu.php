<?php
echo '<li class="dropdown' . (@$top_menu == 'Websites' ? ' active' : '') . '">' . chr(10);
	echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Websites <b class="caret"></b></a>' . chr(10);
	echo '<ul class="dropdown-menu">' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'About Websites' ? 'class="active"' : '') . '><a href="' . site_url('websites/about') . '">About The Websites Section</a></li>' . chr(10);
		echo '<li class="divider"></li>' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'I Want To Be A Loser' ? 'class="active"' : '') . '><a href="' . site_url('websites/i-want-to-be-a-loser') . '">I Want To Be A Loser</a></li>' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'My Movie Collection' ? 'class="active"' : '') . '><a href="' . site_url('websites/my-movie-collection') . '">My Movie Collection</a></li>' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'NFL Football Pool' ? 'class="active"' : '') . '><a href="' . site_url('websites/nfl-football-pool') . '">NFL Football Pool</a></li>' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'The Link Vault' ? 'class="active"' : '') . '><a href="' . site_url('websites/the-link-vault') . '">The Link Vault</a></li>' . chr(10);
	echo '</ul>' . chr(10);
echo '</li>' . chr(10); // end of - websites


/* End of file _websites_dropdown_menu.php */
/* Location: ./application/views/templates/_websites_dropdown_menu.php */
