<?php


echo '<table class="table table-striped">' . chr(10);
	echo '<tr>' . chr(10);
		echo '<th>Category</th>' . chr(10);
		//echo '<th class="hidden-xs">Parent Category</th>' . chr(10);
		//echo '<th class="hidden-xs text-right" style="width:100px;">Sort Order</th>' . chr(10);
		echo '<th class="actions text-center">Actions</th>' . chr(10);
	echo '</tr>' . chr(10);		

	$i = 0;
	
	foreach ($mdl_note_categories as $mdl_note_category) {
	
		$i++;
	
		if ($i % 2 == 0) {
			$panel_class = 'panel-default';
		} else {
			$panel_class = 'panel-custom';
		} 	        		
		
		echo '<tr>' . chr(10);
			echo '<td class="hidden-xs">';
				if ($mdl_note_category['parent_name'] != '') {
				//if ($mdl_note_category['parent_name'] != $mdl_note_category['name']) {
					echo $mdl_note_category['parent_name'] . '<span class="padding-right-10">:</span>';
				}
				echo $mdl_note_category['name'];
			echo '</td>' . chr(10);
			echo '<td class="visible-xs">';
				if ($mdl_note_category['parent_name'] != '') {
					echo $mdl_note_category['parent_name'];
					echo '<br />';
					echo '<span class="padding-left-10"></span>';
				}				
				echo $mdl_note_category['name'];
				
				// echo '<div class="visible-xs border-top">';
					// echo '<div class="nowrap">' . chr(10);
						// echo '<div class="td-label-2 text-right">' . chr(10);
							// echo 'Sort Order:';
						// echo '</div>' . chr(10);
						// echo '<div class="td-content">' . chr(10);
							// echo $mdl_note_category['sort_order'];
						// echo '</div>' . chr(10);
					// echo '</div>' . chr(10);
				// echo '</div>';
			// echo '</td>' . chr(10);
			//echo '<td class="hidden-xs">' . $mdl_note_category['parent_name'] . '</td>' . chr(10);
			//echo '<td class="hidden-xs text-right">' . $mdl_note_category['sort_order'] . '</td>' . chr(10);
			echo '<td class="nowrap">';
				// The javascript confirmation for deleting a record.
				$js = array('onclick' => "return confirm('Are you sure you want to delete this Note Category?')");
				
				echo anchor('mdl-note-categories/view/' . $mdl_note_category['id'], '<span class="glyphicon glyphicon-eye-open action-link"></span>');
				echo '<span class="padding-left-10"></span>';
				echo anchor('mdl-note-categories/edit/' . $mdl_note_category['id'], '<span class="glyphicon glyphicon-pencil action-link"></span>');
				echo '<span class="padding-left-10"></span>';
				echo anchor('mdl-note-categories/delete/' . $mdl_note_category['id'], '<span class="glyphicon glyphicon-remove action-link"></span>', $js);
			echo '</td>' . chr(10);
		echo '</tr>' . chr(10);		

	} // end of - foreach	

echo '</table>' . chr(10);




// No records found so display an alert message.
if ($i == 0) {
	echo '<div class="row">' . chr(10);
		echo '<div class="col col-md-12">' . chr(10);
				
			echo '<div class="alert alert-danger">No Note Categories Found.</div>' . chr(10);
	
		echo '</div>' . chr(10);
	echo '</div>' . chr(10); // end of - row		
}


/* End of file _simple_list.php */
/* Location: ./application/views/note_categories/_simple_list.php */