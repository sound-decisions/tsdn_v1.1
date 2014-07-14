<?php
echo '<li class="dropdown yamm-fw' . (@$top_menu == 'Members Only' ? ' active' : '') . '">' . chr(10);
	echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Members Only <b class="caret"></b></a>' . chr(10);
	echo '<ul class="dropdown-menu">' . chr(10);

		echo '<li>' . chr(10);
			echo '<div class="row">' . chr(10);

				echo '<div class="yamm-content">' . chr(10);

					echo '<div class="col-sm-4">' . chr(10);
						echo '<ul class="dropdown-menu-fw">' . chr(10);
							echo '<li class="dropdown-section-header-link"><a href="' . site_url('recipes/about') . '">Recipes</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'About Recipes' ? 'class="active"' : '') . '><a href="' . site_url('recipes/about') . '">About The Recipes Section</a></li>' . chr(10);
							echo '<li class="divider"></li>' . chr(10);
							//echo '<li class="dropdown-header">Members</li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'By Category' ? 'class="active"' : '') . '><a href="' . site_url('recipes/by-category/0') . '">By Category</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'My Recipes' ? 'class="active"' : '') . '><a href="' . site_url('recipes/my-recipes') . '">My Recipes</a></li>' . chr(10);												
							echo '<li ' . (@$dropdown_menu == 'Cooking Hints' ? 'class="active"' : '') . '><a href="' . site_url('cooking_hints') . '">Cooking Hints</a></li>' . chr(10);
							echo '<li class="divider"></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Add A Recipe' ? 'class="active"' : '') . '><a href="' . site_url('recipes/add') . '">Add A Recipe</a></li>' . chr(10);
						echo '</ul>' . chr(10);
					echo '</div>' . chr(10);

					echo '<div class="col-sm-4">' . chr(10);
						echo '<ul class="dropdown-menu-fw">' . chr(10);
							echo '<li class="dropdown-section-header-link"><a href="' . site_url('mdl-links/about') . '">Links</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'About Links' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links/about') . '">About The Links Section</a></li>' . chr(10);
							echo '<li class="divider"></li>' . chr(10);
							//echo '<li class="dropdown-header">Movies</li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Links Most Visited' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links/most-visited') . '">Links Most Visited</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Links By Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links/by-category/0') . '">Links By Category</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Link Categories' ? 'class="active"' : '') . '><a href="' . site_url('mdl-link-categories') . '">Link Categories</a></li>' . chr(10);												
							echo '<li class="divider"></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Add A Link' ? 'class="active"' : '') . '><a href="' . site_url('mdl-links/add') . '">Add A Link</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Add A Link Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-link-categories/add') . '">Add A Link Category</a></li>' . chr(10);												
						echo '</ul>' . chr(10);
					echo '</div>' . chr(10);

					echo '<div class="col-sm-4">' . chr(10);
						echo '<ul class="dropdown-menu-fw">' . chr(10);
							echo '<li class="dropdown-section-header-link"><a href="' . site_url('mdl-notes/about') . '">Notes</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'About Notes' ? 'class="active"' : '') . '><a href="' . site_url('mdl-notes/about') . '">About The Notes Section</a></li>' . chr(10);
							echo '<li class="divider"></li>' . chr(10);
							//echo '<li class="dropdown-header">Links</li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Notes By Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-notes/by-category/0') . '">Notes By Category</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Note Categories' ? 'class="active"' : '') . '><a href="' . site_url('mdl-note-categories') . '">Note Categories</a></li>' . chr(10);												
							echo '<li class="divider"></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Add A Note' ? 'class="active"' : '') . '><a href="' . site_url('mdl-notes/add') . '">Add A Note</a></li>' . chr(10);
							echo '<li ' . (@$dropdown_menu == 'Add A Note Category' ? 'class="active"' : '') . '><a href="' . site_url('mdl-note-categories/add') . '">Add A Note Category</a></li>' . chr(10);
						echo '</ul>' . chr(10);
					echo '</div>' . chr(10);

				echo '</div>' . chr(10); // end of - yamm-content							

			echo '</div>' . chr(10); // end of - row

		echo '</li>' . chr(10);
		
	echo '</ul>' . chr(10);
echo '</li>' . chr(10); // end of - dropdown yamm-fw


/* End of file _members_only_dropdown_menu.php */
/* Location: ./application/views/templates/_members_only_dropdown_menu.php */
