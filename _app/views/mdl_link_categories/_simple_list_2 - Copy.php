<?php

	// Create an object array by looping through 2 arrays 
	// to get the values in the order that we want.
	$a_mdl_link_categories = array();
	
	foreach ($link_categories_no_p as $mdl_link_category_p) {
		
		$data = new stdClass();
		$data->id = $mdl_link_category_p['id'];
		$data->parent_id = $mdl_link_category_p['parent_id'];
		$data->name = $mdl_link_category_p['name'];
		
		$a_mdl_link_categories[] = $data;

			foreach ($link_categories_w_p as $mdl_link_category) {
				
				if ($mdl_link_category_p['id'] == $mdl_link_category['parent_id']) {
					$data = new stdClass();
					$data->id = $mdl_link_category['id'];
					$data->parent_id = $mdl_link_category['parent_id'];
					$data->name = $mdl_link_category_p['name'] . ': ' . $mdl_link_category['name'];
					
					$a_mdl_link_categories[] = $data;
				}
				
			} // end of - foreach

	} // end of - foreach	


 //print_r( $a_mdl_link_categories );


echo '<table class="table table-striped">' . chr(10);
	echo '<tr>' . chr(10);
		echo '<th>ID</th>' . chr(10);
		echo '<th>Parent ID</th>' . chr(10);
		echo '<th>Category</th>' . chr(10);
		//echo '<th>Sub Category</th>' . chr(10);
	echo '</tr>' . chr(10);		

	$i = 0;
	
	foreach ($a_mdl_link_categories as $mdl_link_category_p) {
	
		$i++;        		
		
		echo '<tr>' . chr(10);
			echo '<td>' . $mdl_link_category_p->id . '</td>' . chr(10);
			echo '<td>' . $mdl_link_category_p->parent_id . '</td>' . chr(10);
			echo '<td>' . $mdl_link_category_p->name . '</td>' . chr(10);
			
			// echo '<td>';
			// foreach ($link_categories_w_p as $mdl_link_category) {
// 				
				// if ($mdl_link_category_p['id'] == $mdl_link_category['parent_id']) {
					// echo $mdl_link_category['name'] . '<br />' . chr(10);
				// }
// 				
			// } // end of - foreach
			// echo '</td>';
						
		echo '</tr>' . chr(10);

	} // end of - foreach	

echo '</table>' . chr(10);








echo '<table class="table table-striped">' . chr(10);
	echo '<tr>' . chr(10);
		echo '<th>ID</th>' . chr(10);
		echo '<th>Parent ID</th>' . chr(10);
		echo '<th>Parent Category</th>' . chr(10);
		echo '<th>Sub Category</th>' . chr(10);
	echo '</tr>' . chr(10);		

	$i = 0;
	
	//foreach ($link_categories_no_p as $mdl_link_category) {
	foreach ($link_categories_no_p as $mdl_link_category_p) {
	
		$i++;        		
		
		echo '<tr>' . chr(10);
			echo '<td>' . $mdl_link_category_p['id'] . '</td>' . chr(10);
			echo '<td>' . $mdl_link_category_p['parent_id'] . '</td>' . chr(10);
			echo '<td>' . $mdl_link_category_p['name'] . '</td>' . chr(10);
			
			echo '<td>';
			foreach ($link_categories_w_p as $mdl_link_category) {
				
				if ($mdl_link_category_p['id'] == $mdl_link_category['parent_id']) {
					echo $mdl_link_category['name'] . '<br />' . chr(10);
				}
				
			} // end of - foreach
			echo '</td>';
						
		echo '</tr>' . chr(10);

	} // end of - foreach	

echo '</table>' . chr(10);



// echo '<table class="table table-striped">' . chr(10);
	// echo '<tr>' . chr(10);
		// echo '<th>ID</th>' . chr(10);
		// echo '<th>Parent ID</th>' . chr(10);
		// echo '<th>Category</th>' . chr(10);
		// echo '<th>Parent Category</th>' . chr(10);
	// echo '</tr>' . chr(10);		
// 
	// $i = 0;
// 	
	// //foreach ($link_categories_no_p as $mdl_link_category) {
	// foreach ($link_categories_w_p as $mdl_link_category) {
// 	
		// $i++;        		
// 		
		// echo '<tr>' . chr(10);
			// echo '<td>' . $mdl_link_category['id'] . '</td>' . chr(10);
			// echo '<td>' . $mdl_link_category['parent_id'] . '</td>' . chr(10);
			// echo '<td>' . $mdl_link_category['name'] . '</td>' . chr(10);
			// echo '<td></td>' . chr(10);
		// echo '</tr>' . chr(10);
// 
	// } // end of - foreach	
// 
// echo '</table>' . chr(10);




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