<div class="container">

	<?php
	// If a message has been set then display it.
	if ($this->session->flashdata("message") !== FALSE) {
		echo '<div class="row">' . chr(10);
			echo '<div class="col col-md-12">' . chr(10);
				echo '<div class="alert ' . $this->session->flashdata("message_class") . '">' . $this->session->flashdata("message") . '</div>' . chr(10);
			echo '</div><!-- end of - col col-md-12 -->' . chr(10);
		echo '</div><!-- end of - row -->' . chr(10);
	}
	?>


	<div class="row">
		<div class="col col-md-12">

			<h4 class="page_title"><?php echo $title; ?></h4>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->		
	<div class="row">	
		<div class="col col-md-12">

				<?php
				echo '<div class="panel panel-default">' . chr(10);
					echo '<div class="panel-heading">' . chr(10);
						echo '<h4>' . $link_category->name . '</h4>' . chr(10);
					echo '</div>' . chr(10); // end of - panel-heading
					echo '<div class="panel-body">' . chr(10);


						$i = 0;
						
						foreach ($links as $link) {
						
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
									echo '<a href="' . $link['url'] . '" target="_blank" class="block">';
										echo '<h5>';
											echo $link['name'];
										echo '</h5>';
									echo '</a>';
								echo '</div>' . chr(10);
								
								//echo '<div class="pull-right">' . chr(10);
								echo '<div class="action-link-holder">' . chr(10);											
									// Only display the edit and delete icons for the owner of the link.
									if ($this->session->userdata('member_id') == $link['member_id']) {
										echo '<a href="' . site_url("mdl-links/view/") . '/' . $link['id'] . '"><span class="glyphicon glyphicon-eye-open action-link">&nbsp;</span></a>' . chr(10);
										echo '<a href="' . site_url("mdl-links/edit/") . '/' . $link['id'] . '"><span class="glyphicon glyphicon-pencil action-link">&nbsp;</span></a>' . chr(10);
										echo '<a href="' . site_url("mdl-links/delete/") . '/' . $link['id'] . '" onclick="return confirm(\'Are you sure you want to delete this link?\');"><span class="glyphicon glyphicon-remove action-link">&nbsp;</span></a>' . chr(10);
									}
								echo '</div>' . chr(10);
								
							echo '</li>' . chr(10);
									
						} // end of - foreach



					echo '</div>' . chr(10); // end of - panel-body
					echo '<div class="panel-footer">' . chr(10);

	                	echo '<div class="clearfix">' . chr(10);
		                	echo '<div class="pull-left">' . chr(10);
		                		echo '<p>' . dateAndTimeFormattedForDisplayShortVersion($link_category->created_at) . '</p>' . chr(10);
		                	echo '</div>' . chr(10);
		                	echo '<div class="pull-right">' . chr(10);			                 																																
								// Only display the edit and delete icons for the owner of the recipe.
								if ($this->session->userdata('member_id') == $link_category->member_id) {		                    	
				                    //echo '<span class="link_separator"></span>' . chr(10);
				                    echo '<a href="' . site_url("mdl-link-categories/edit/") . '/' . $link_category->id . '"><span class="glyphicon glyphicon-pencil action-link">&nbsp;</span></a>' . chr(10);
				                    //echo '<span class="link_separator"></span>' . chr(10);
				                    echo '<a href="' . site_url("mdl-link-categories/delete/") . '/' . $link_category->id . '" onclick="return confirm(\'Are you sure you want to delete this link category?\');"><span class="glyphicon glyphicon-remove action-link"></span></a>' . chr(10);
				            	}
			             	echo '</div>' . chr(10);
		             	echo '</div>' . chr(10);

					echo '</div>' . chr(10); // end of - panel-footer					
				echo '</div>' . chr(10); // end of - panel													
				?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->		
</div><!-- end of - container -->