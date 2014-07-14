<?php
echo '<li class="dropdown' . (@$top_menu == 'Links' ? ' active' : '') . '">' . chr(10);
	echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Links <b class="caret"></b></a>' . chr(10);
	echo '<ul class="dropdown-menu">' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'Links Most Visited' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links/most-visited') . '">Links Most Visited</a></li>' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'Links By Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links/by-category/0') . '">Links By Category</a></li>' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'Link Categories' ? 'class="active"' : '') . '><a href="' . site_url('mdl-link-categories') . '">Link Categories</a></li>' . chr(10);
		//echo '<li ' . (@$dropdown_menu == 'Grouped By Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links/list-gbc') . '">Link List Grouped By Category</a></li>' . chr(10);
		echo '<li class="divider"></li>' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'Add A Link' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links/add') . '">Add A Link</a></li>' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'Add A Link Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-link-categories/add') . '">Add A Link Category</a></li>' . chr(10);
	echo '</ul>' . chr(10);
echo '</li>' . chr(10); // end of - links


/* End of file _links_dropdown_menu.php */
/* Location: ./application/views/templates/_links_dropdown_menu.php */
