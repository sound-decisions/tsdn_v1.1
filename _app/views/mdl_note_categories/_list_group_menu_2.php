<?php


$i = 0;


echo '<div class="panel-group" id="accordion">' . chr(10);

	echo '<h4 class="page_title">' . chr(10);
		echo '<a data-toggle="collapse" data-parent="#accordion" href="#CategoryList" class="page_title">Note Categories<span id="CategoryListGlyphicon" class="pull-right glyphicon glyphicon-minus"></span></a>' . chr(10);
	echo '</h4>' . chr(10);

    echo '<div id="CategoryList" class="panel-collapse collapse">' . chr(10);
 

		echo '<div class="list-group">' . chr(10);
			
			$last_category = '';
			
			foreach ($categories as $category) {
			
				$i++;
			
				if ($i % 2 == 0) {
					$panel_class = 'panel-default';
					$background_color = 'row2';
				} else {
					$panel_class = 'panel-custom';
					$background_color = 'row1';
				}        	
			
				echo '<a href="' . site_url('mdl-notes/by-category/' . $category->id) . '" class="list-group-item thin ' . $background_color . '">';
					if ($category->category != $last_category) {
						echo $category->category;
					}			
					if ($category->sub_category != '') {
						//echo '<span class="padding-right-10"></span>';
						echo '<ul class="sub-category"><li>';
							echo $category->sub_category;
						echo '</li></ul>';
					}	
				echo '</a>' . chr(10);
		
				// Save the last category displayed so that can only display sub categories.
				$last_category = $category->category;
		
			} // end of - foreach
		
		echo '</div>' . chr(10);


	echo '</div>' . chr(10);
echo '</div>' . chr(10);



// No records found so display an alert message.
if ($i == 0) {
	echo '<div class="alert alert-danger">No Link Categories Found</div>' . chr(10);
}   
			
/* End of file _list_group_menu_2.php */
/* Location: ./application/views/mdl_link_categories/_list_group_menu_2.php */	
			