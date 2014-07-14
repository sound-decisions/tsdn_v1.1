<?php


echo '<table class="table table-striped">' . chr(10);
	echo '<tr>' . chr(10);
		echo '<th>Categories</th>' . chr(10);
		echo '<th class="actions text-center">Actions</th>' . chr(10);
	echo '</tr>' . chr(10);		

	$i = 0;
	
	foreach ($mdl_link_categories as $mdl_link_category) {
	
		$i++;
	
		if ($i % 2 == 0) {
			$panel_class = 'panel-default';
		} else {
			$panel_class = 'panel-custom';
		} 	        		
		
		echo '<tr>' . chr(10);
			echo '<td class="hidden-xs hidden-sm">';
				echo $mdl_link_category->category;
				if ($mdl_link_category->sub_category != '') {
					echo '<span class="padding-right-10">:</span>';
					echo $mdl_link_category->sub_category;
				}
			echo '</td>' . chr(10);
			
			echo '<td class="visible-xs visible-sm">';
				echo $mdl_link_category->category;
				if ($mdl_link_category->sub_category != '') {
					echo '<br />';
					echo '<span class="padding-left-20"></span>';
					echo $mdl_link_category->sub_category;
				}
			echo '</td>' . chr(10);
			
			echo '<td class="nowrap">';
				// The javascript confirmation for deleting a record.
				$js = array('onclick' => "return confirm('Are you sure you want to delete this Link Category?  Keep in mind that all Links in this Category will be deleted as well')");
				
				echo anchor('mdl-link-categories/view/' . $mdl_link_category->id, '<span class="glyphicon glyphicon-eye-open action-link"></span>');
				echo '<span class="padding-left-10"></span>';
				echo anchor('mdl-link-categories/edit/' . $mdl_link_category->id, '<span class="glyphicon glyphicon-pencil action-link"></span>');
				echo '<span class="padding-left-10"></span>';
				echo anchor('mdl-link-categories/delete/' . $mdl_link_category->id, '<span class="glyphicon glyphicon-remove action-link"></span>', $js);
			echo '</td>' . chr(10);
		echo '</tr>' . chr(10);		

	} // end of - foreach	

echo '</table>' . chr(10);




// No records found so display an alert message.
if ($i == 0) {
	echo '<div class="row">' . chr(10);
		echo '<div class="col col-md-12">' . chr(10);
				
			echo '<div class="alert alert-danger">No Link Categories Found.</div>' . chr(10);
	
		echo '</div>' . chr(10);
	echo '</div>' . chr(10); // end of - row		
}


/* End of file _simple_list.php */
/* Location: ./application/views/recipe_categories/_simple_list.php */