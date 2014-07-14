<?php
echo '<li class="dropdown yamm-fw' . (@$top_menu == 'Admin Menu' ? ' active' : '') . '">' . chr(10);
	echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin Menu <b class="caret"></b></a>' . chr(10);
	echo '<ul class="dropdown-menu">' . chr(10);

		echo '<li>' . chr(10);
			echo '<div class="row">' . chr(10);

				echo '<div class="yamm-content">' . chr(10);

					echo '<div class="col-sm-4">' . chr(10);
						echo '<ul class="dropdown-menu-fw">' . chr(10);
							echo '<li class="dropdown-section-header"><h4>Standard Admin Section</h4></li>' . chr(10);
							echo '<li class="dropdown-header">Members</li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Member List' ? 'class="active"' : '') . '><a href="' . site_url('members') . '">Member List</a></li>' . chr(10);
							echo '<li class="dropdown-header">Contact Messages</li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Contact Messages' ? 'class="active"' : '') . '><a href="' . site_url('contact-messages') . '">Contact Messages</a></li>' . chr(10);
							echo '<li class="dropdown-header">News</li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Add A News Item' ? 'class="active"' : '') . '><a href="' . site_url('news/add') . '">Add A News Item</a></li>' . chr(10);
						echo '</ul>' . chr(10);
					echo '</div>' . chr(10);

					echo '<div class="col-sm-4">' . chr(10);
						echo '<ul class="dropdown-menu-fw">' . chr(10);
							echo '<li class="dropdown-section-header"><h4>Website Sections</h4></li>' . chr(10);
							//echo '<li class="divider"></li>' . chr(10);
							echo '<li class="dropdown-header">Movies</li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Movies' ? 'class="active"' : '') . '><a href="' . site_url('movies/admin-list') . '">Movie List</a></li>' . chr(10);
							//echo '<li ' . (@$top_menu == 'Movie Search Results' ? 'class="active"' : '') . '><a href="' . site_url('movies/admin-search') . '">Movie List/Search</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Add A Movie' ? 'class="active"' : '') . '><a href="' . site_url('movies/add') . '">Add A Movie</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Search IMDB' ? 'class="active"' : '') . '><a href="' . site_url('movies/imdb-search') . '">Search IMDB</a></li>' . chr(10);											
							echo '<li class="dropdown-header">Recipes</li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Recipes' ? 'class="active"' : '') . '><a href="' . site_url('recipes/admin-list') . '">Recipe List</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Recipe Categories' ? 'class="active"' : '') . '><a href="' . site_url('recipe_categories') . '">Recipe Categories</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Add A Recipe Category' ? 'class="active"' : '') . '><a href="' . site_url('recipe_categories/add') . '">Add A Recipe Category</a></li>' . chr(10);
							echo '<li class="dropdown-header">Cooking Hints</li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Add A Cooking Hint' ? 'class="active"' : '') . '><a href="' . site_url('cooking_hints/add') . '">Add A Cooking Hint</a></li>' . chr(10);
						echo '</ul>' . chr(10);
					echo '</div>' . chr(10);

					echo '<div class="col-sm-4">' . chr(10);
						echo '<ul class="dropdown-menu-fw">' . chr(10);
							echo '<li class="dropdown-section-header"><h4>My Daily Life</h4></li>' . chr(10);
							echo '<li class="dropdown-header">Links</li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Link List' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links') . '">Link List</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Link List Grouped By Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links/list-gbc') . '">Link List Grouped By Category</a></li>' . chr(10);
							//echo '<li ' . (@$dropdown_menu == 'Add A Link' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links/add') . '">Add A Link</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Admin Link Categories' ? 'class="active"' : '') . '><a href="' . site_url('mdl-link-categories/admin-list') . '">Link Category List</a></li>' . chr(10);
							//echo '<li ' . (@$dropdown_menu == 'Add A Link Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-link-categories/add') . '">Add A Link Category</a></li>' . chr(10);
							echo '<li class="dropdown-header">Notes</li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Note List' ? 'class="active"' : '') . '><a href="' . site_url('mdl-notes') . '">Note List</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Note List Grouped By Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-notes/list-gbc') . '">Notes List Grouped By Category</a></li>' . chr(10);
							//echo '<li ' . (@$dropdown_menu == 'Add A Note' ? 'class="active"' : '') . '><a href="' . site_url('mdl-notes/add') . '">Add A Note</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Note Categories' ? 'class="active"' : '') . '><a href="' . site_url('mdl-note-categories/admin-list') . '">Note Category List</a></li>' . chr(10);
							//echo '<li ' . (@$dropdown_menu == 'Add A Note Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-note-categories/add') . '">Add A Note Category</a></li>' . chr(10);
						echo '</ul>' . chr(10);
					echo '</div>' . chr(10);

				echo '</div>' . chr(10); // end of - yamm-content							

			echo '</div>' . chr(10); // end of - row

		echo '</li>' . chr(10);
		
	echo '</ul>' . chr(10);
echo '</li>' . chr(10); // end of - dropdown yamm-fw


/* End of file _admin_dropdown_menu.php */
/* Location: ./application/views/templates/_admin_dropdown_menu.php */
