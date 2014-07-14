<?php
echo '<li class="dropdown' . (@$top_menu == 'Movies' ? ' active' : '') . '">' . chr(10);
	echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Movies <b class="caret"></b></a>' . chr(10);
	echo '<ul class="dropdown-menu">' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'About Movies' ? 'class="active"' : '') . '><a href="' . site_url('movies/about') . '">About The Movies Section</a></li>' . chr(10);
		echo '<li class="divider"></li>' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'Featured Movies' ? 'class="active"' : '') . '><a href="' . site_url('movies/featured-movies') . '">Featured Movies</a></li>' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'Browse Movies' ? 'class="active"' : '') . '><a href="' . site_url('movies') . '">Browse Movies</a></li>' . chr(10);
		
		if ($this->session->userdata('member_id') != '') {
			echo '<li class="divider"></li>' . chr(10);
			echo '<li ' . (@$dropdown_menu == 'My Watch List' ? 'class="active"' : '') . '><a href="' . site_url('movies/my-watch-list') . '">My Watch List</a></li>' . chr(10);
		}
		
	echo '</ul>' . chr(10);
echo '</li>' . chr(10); // end of - movies	


/* End of file _movies_dropdown_menu.php */
/* Location: ./application/views/templates/_movies_dropdown_menu.php */
