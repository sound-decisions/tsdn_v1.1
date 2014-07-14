<div class="container">
    <div class="row">
        <div class="col-md-12">

            <?php            
            // Display the search results.
            if (sizeof($results) < 1) {

                echo '<div class="alert alert-danger">No Movies Found</div>' . chr(10);        

            } else {

                echo '<div class="alert alert-info">' . (sizeof($results)) . ' Movies Found</div>' . chr(10);

                $i = 0;
                //$i = $starting_count;          

                echo '<table class="list">' . chr(10);
                    echo '<tr>' . chr(10);
                        echo '<th class="text-center">#</th>' . chr(10);
                        echo '<th>Title</th>' . chr(10);
                        echo '<th>Genre</th>' . chr(10);
                        echo '<th>Rated</th>' . chr(10);
                        echo '<th class="text-center">Year</th>' . chr(10);                        
                        echo '<th class="text-right">Runtime</th>' . chr(10);
                        echo '<th>&nbsp;</th>' . chr(10);
                    echo '</tr>' . chr(10);

                    foreach ($results as $data) {

                        $i++;

                        $runtime = $data['runtime'];


                        echo '<tr>' . chr(10);
                            echo '<td class="text-right">' . $i . '</td>' . chr(10);
                            echo '<td>' . $data['title'] . '</td>' . chr(10);
                            echo '<td>' . $data['genre'] . '</td>' . chr(10);
                            echo '<td>' . $data['mpaa_rating'] . '</td>' . chr(10);
                            echo '<td class="text-center">' . $data['year_released'] . '</td>' . chr(10);
                            echo '<td class="text-right">' . $runtime . '</td>' . chr(10);
                            echo '<td class="text-right">' . chr(10);
                                //echo '<a href="' . site_url("movies/" . $data['id']) . '"><span class="glyphicon glyphicon-eye-open action-link">&nbsp;</span></a>' . chr(10);
                                echo '<a href="' . site_url("movies/" . $data['id']) . '">View</a>' . chr(10);
                                echo '<span class="link_separator">|</span>' . chr(10);
                                echo '<a href="' . site_url("movies/edit/" . $data['id']) . '">Edit</a>' . chr(10);
                                echo '<span class="link_separator">|</span>' . chr(10);
                                echo '<a href="' . site_url("movies/delete/" . $data['id']) . '" onclick="return confirm(\'Are you sure you want to delete this Movie?\');">Delete</a>' . chr(10);                        
                            echo '</td>' . chr(10);
                        echo '</tr>' . chr(10);

                    } // end of - foreach 

                echo '</table>' . chr(10);                  
            }
            ?>

        </div> <!-- end of - col-md-12 -->
    </div> <!-- end of - row -->
</div> <!-- end of - container -->