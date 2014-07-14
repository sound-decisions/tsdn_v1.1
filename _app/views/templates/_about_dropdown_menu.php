<?php
echo '<li class="dropdown' . (@$top_menu == 'About' ? ' active' : '') . '">' . chr(10);
	echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">About <b class="caret"></b></a>' . chr(10);
	echo '<ul class="dropdown-menu">' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'The Site' ? 'class="active"' : '') . '><a href="' . site_url('about') . '">The Site</a></li>' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'News' ? 'class="active"' : '') . '><a href="' . site_url('news') . '">News</a></li>' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'Contact' ? 'class="active"' : '') . '><a href="' . site_url('contact-messages/add') . '">Contact</a></li>' . chr(10);
	echo '</ul>' . chr(10);
echo '</li>' . chr(10); // end of - About


/* End of file _about_dropdown_menu.php */
/* Location: ./application/views/templates/_about_dropdown_menu.php */
