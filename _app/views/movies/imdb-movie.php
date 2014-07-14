<div class="container">
	<div class="row">
		<div class="col col-md-12">

			<?php 
			echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);							
			?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->
	<div class="row">
		<div class="col col-md-12">

	        <?php   
	        // Get the results from the model.
	        $info = $results;        
	        
	        
	        switch ($result_status) 
	        {
	            case "ERROR":
	                
	                echo '<div class="col-md-12">' . chr(10);
	                    echo '<div class="alert alert-danger">';
	                        echo $info["Error"];
	                    echo '</div>' . chr(10);
	                echo '</div>' . chr(10); // end of - col-md-12 
	                
	                break;
	            
	            case "SEARCH":
	                
	                echo '<div class="col-md-12">' . chr(10);
	                
	                    $info = $info["Search"];
	                    echo '<br /><br />' . chr(10);
	                    var_dump($info);
	                    //echo '<h3>' . $info['title'] . '</h3>' . chr(10);
	                    echo '<br /><br />' . chr(10);
	                    echo '<h3>Search Results</h3>' . chr(10);
	                    foreach ($info as $movie)
	                    {
	                        echo '<h4><a href="' . site_url("movies/imdb/" . $movie["imdbID"]) . '">' . $movie["Title"] . '</a></h4>' . chr(10);
	                    } // end of - foreach
	                    
	                echo '</div>' . chr(10); // end of - col-md-12        
	                
	                break;
	                
	            case "MOVIE":	                	                	              
	                
	                $poster_url = $info['Poster'];
	                                
	                
	                echo '<div class="col-md-3">' . chr(10);
	
	                    if ($poster_url != 'N/A') {
	
	                        echo '<img src="' . $info['Poster'] . '" width="186px" />' . chr(10);
	                        echo '<br />' . chr(10);
	                    }
	                    
	                    echo '<div class="imdb_rating">';
	                        echo '<div>';
	                            echo $info['imdbRating'];
	                        echo '</div>' . chr(10);
	                    echo '</div>' . chr(10);
	                echo '</div>' . chr(10);
	                    
	               
	
	                echo '<div class="col-md-9 details">' . chr(10);
	                    echo '<h3>' . $info["Title"] . '</h3>' . chr(10);
	                    echo '<h5>' . $info["Genre"] . ' - ' . $info["Rated"] . ' - ' . $info["Runtime"] . ' - ' . $info["Year"] . '</h5>' . chr(10);
	                    echo '<p>' . $info["Plot"] . '</p>' . chr(10);
	                    echo '<p><strong>Starring</strong><br />' . $info["Actors"] . '</p>' . chr(10);
	                    echo '<p><strong>Directed By</strong><br />' . $info["Director"] . '</p>' . chr(10);
	                    echo '<p><strong>Written By</strong><br />' . $info["Writer"] . '</p>' . chr(10);
	                    echo '<p><a href="' . $this->imdb_model->imdb_url . $info['imdbID'] . '" />IMDB Link</a></p>' . chr(10);
																	
						echo '<p><a href="' . site_url("movies/imdb-movie-create/") . '/' . $imdb_id . '" class="btn btn-primary">Add IMDB Movie</a></p>' . chr(10);
						
	                echo '</div>' . chr(10);   
					
					
					// // Display the actual data returned from IMDB.
	                // echo '<div class="col-md-12">' . chr(10);
	                    // var_dump($info);
	                    // echo '<br /><br />' . chr(10);
	                // echo '</div>' . chr(10);					
	                
	                break;
	            
	            default:
	                
	                echo '<div class="col-md-12">' . chr(10);
	                    echo '<div class="message_panel_error">';
	                        echo 'An Unexpected Error Occurred.  Please Try Again.';
	                    echo '</div>' . chr(10);
	                echo '</div>' . chr(10); 
	            
	                break;
	            
	        } // end of - switch
	        ?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->	
</div><!-- end of - container -->			