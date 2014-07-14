<?php
echo '<li class="dropdown' . (@$top_menu == 'Recipes' ? ' active' : '') . '">' . chr(10);
	echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Recipes <b class="caret"></b></a>' . chr(10);
	echo '<ul class="dropdown-menu">' . chr(10);
		//echo '<li ' . (@$dropdown_menu == 'By Category' ? 'class="active"' : '') . '><a href="' . site_url('recipe-categories/select') . '">By Category</a></li>' . chr(10);
		echo '<li ' . (@$dropdown_menu == 'By Category' ? 'class="active"' : '') . '><a href="' . site_url('recipes/by-category/0') . '">By Category</a></li>' . chr(10);
		// Display the following menu items if a member is signed in.
		if ($this->session->userdata('member_id') != '') {
			echo '<li ' . (@$dropdown_menu == 'My Recipes' ? 'class="active"' : '') . '><a href="' . site_url('recipes/my-recipes') . '">My Recipes</a></li>' . chr(10);
		}
		//echo '<li ' . (@$dropdown_menu == 'Recipes' ? 'class="active"' : '') . '><a href="' . site_url('recipes') . '">All Recipes</a></li>' . chr(10);
		// Display the following menu items if a member is signed in.
		if ($this->session->userdata('member_id') != '') {						
			echo '<li ' . (@$dropdown_menu == 'Add A Recipe' ? 'class="active"' : '') . '><a href="' . site_url('recipes/add') . '">Add A Recipe</a></li>' . chr(10);
		}
		echo '<li ' . (@$dropdown_menu == 'Cooking Hints' ? 'class="active"' : '') . '><a href="' . site_url('cooking_hints') . '">Cooking Hints</a></li>' . chr(10);
	echo '</ul>' . chr(10);
echo '</li>' . chr(10); // end of - recipes


/* End of file _recipes_dropdown_menu.php */
/* Location: ./application/views/templates/_recipes_dropdown_menu.php */
