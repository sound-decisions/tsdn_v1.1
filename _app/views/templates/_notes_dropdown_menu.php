<?php
echo '<li class="dropdown' . (@$top_menu == 'Notes' ? ' active' : '') . '">' . chr(10);
	echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Notes <b class="caret"></b></a>' . chr(10);
	echo '<ul class="dropdown-menu">' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'Notes By Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-notes/by-category/0') . '">Notes By Category</a></li>' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'Note Categories' ? 'class="active"' : '') . '><a href="' . site_url('mdl-note-categories') . '">Note Categories</a></li>' . chr(10);
		//echo '<li ' . (@$dropdown_menu == 'Grouped By Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-notes/list-gbc') . '">Note List Grouped By Category</a></li>' . chr(10);
		echo '<li class="divider"></li>' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'Add A Note' ? 'class="active"' : '') . '><a href="' . site_url('mdl-notes/add') . '">Add A Note</a></li>' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'Add A Note Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-note-categories/add') . '">Add A Note Category</a></li>' . chr(10);
	echo '</ul>' . chr(10);
echo '</li>' . chr(10); // end of - notes


/* End of file _notes_dropdown_menu.php */
/* Location: ./application/views/templates/_notes_dropdown_menu.php */
