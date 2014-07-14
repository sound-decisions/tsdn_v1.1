<?php

$i = 0;
$last_category = '';

foreach ($mdl_link_categories as $mdl_link_category) {

	$i++;

	if ($i % 2 == 0) {
		$panel_class = 'panel-default';
		$background_color = 'row2';
	} else {
		$panel_class = 'panel-custom';
		$background_color = 'row1';
	}        	

	if ($i == 1) {
		echo '<ul class="list-group">' . chr(10);
	}
	
	echo '<li class="list-group-item thin ' . $background_color . ' clearfix">';
	
		echo '<div class="pull-left margin-right-100">';
		// echo '<div class="pull-left">';
			echo '<h5>';
				echo '<a href="' . site_url("mdl-links/by-category/") . '/' . $mdl_link_category->id . '" class="block">';
					if ($mdl_link_category->category != $last_category) {
						echo $mdl_link_category->category;	
					}				
					if ($mdl_link_category->sub_category != '') {
						//echo '<span class="padding-right-10"></span>';
						echo '<ul class="sub-category"><li>';
							echo $mdl_link_category->sub_category;
						echo '</li></ul>';
					}	
				echo '</a>';
			echo '</h5>';
		echo '</div>' . chr(10);
		
		//echo '<div class="pull-right">' . chr(10);
		echo '<div class="action-link-holder">' . chr(10);											
			// Only display the edit and delete icons for the owner of the link category.
			//if ($this->session->userdata('member_id') == $mdl_link_category->member_id) {
				echo '<a href="' . site_url("mdl-link-categories/view/") . '/' . $mdl_link_category->id . '"><span class="glyphicon glyphicon-eye-open action-link">&nbsp;</span></a>' . chr(10);
				echo '<a href="' . site_url("mdl-link-categories/edit/") . '/' . $mdl_link_category->id . '"><span class="glyphicon glyphicon-pencil action-link">&nbsp;</span></a>' . chr(10);
				echo '<a href="' . site_url("mdl-link-categories/delete/") . '/' . $mdl_link_category->id . '" onclick="return confirm(\'Are you sure you want to delete this link category?\');"><span class="glyphicon glyphicon-remove action-link">&nbsp;</span></a>' . chr(10);
			//}
		echo '</div>' . chr(10);
		
	echo '</li>' . chr(10);
			
	$last_category = $mdl_link_category->category;		
			
} // end of - foreach


// No records found so display an alert message.
if ($i == 0) {
	echo '<div class="alert alert-danger">No Links Categories Found</div>' . chr(10);
} else {
	echo '</ul>' . chr(10);	
}

			
/* End of file _list_group.php */
/* Location: ./application/views/mdl_link_categories/_list_group.php */		
	