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
            // Get the search results from the imdb_model.
            $info = $results;
            

            echo '<h4 class="margin-bottom-20">Search IMDB for:  ' . $title_search . '</h4>' . chr(10);


            if (isset($info["Search"])) {


                $info = $info["Search"];
    //                echo '<br /><br />' . chr(10);
    //                var_dump($info);
    //                echo '<br /><br />' . chr(10);

                foreach ($info as $movie)
                {
                	echo '<p>' . chr(10);
	                    echo '<a href="' . site_url("movies/imdb/" . $movie["imdbID"]) . '">';
	                        echo $movie["Title"];
	                        echo '<span class="padding-left-10"></span>';
	                        echo '(';
	                        echo $movie['Year'];  
	                        echo ')';
	                    echo '</a>' . chr(10);
					echo '</p>' . chr(10);
                } // end of - foreach
                
            } else {
                
                echo '<div class="message_panel_error">No Search Results Returned.</div>' . chr(10);
                
            }
            
            ?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->	
</div><!-- end of - container -->			