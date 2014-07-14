<div class="container">
	<div class="row">
		<div class="col col-md-12">

			<?php
			echo '<h4 class="page_title">' . $title . '</h4>' . chr(10);
			?>

		</div><!-- end of - col col-md-12 -->
	</div><!-- end of - row -->	
    <div class="row">
        <div class="col-md-12">

            <?php
            // Temp Code.
            // Display the Search SQL.
            // echo '<p>SQL:  ' . $this->session->userdata('movie_search_sql') . '</p>' . chr(10);
            // echo '<p>Starts With:  ' . $this->session->userdata('movie_starts_with_search') . '</p>' . chr(10);
            
            
            $letters = range('A', 'Z');
            if ($this->session->userdata('movie_starts_with_search') == '0') {
                $starts_with = '';
            } else {
                $starts_with = $this->session->userdata('movie_starts_with_search');
            }
            
            
            // Display the search form.
            echo '<div class="center-block well well-sm">' . chr(10);
			
			
				echo '<div class="center-block">' . chr(10);
	                                                            
	                $attributes = array('name' => 'search_movies', 'id' => 'search_movies', 'class' => 'form-inline');                
	                $hidden = array('starts_with_hidden' => $this->session->userdata('movie_starts_with_search'));
	
	                echo form_open($search_form_action, $attributes, $hidden) . chr(10);
	                
	
	                echo '<div class="center-block margin-bottom-10">' . chr(10);
	
	                    $data = array(
	                        'name'        => 'starts_with',
	                        'id'          => 'starts_with_not_set',
	                        'value'       => '',  
	                    );                    
	                    echo form_radio($data) . chr(10);
	
	                    $data = array(
	                        'name'        => 'starts_with',
	                        'id'          => 'starts_with_num',
	                        'value'       => 'NUM', 
	                        'checked'     =>  $this->session->userdata('movie_starts_with_search') == 'NUM' ? TRUE : FALSE, 
	                    );                    
	                    echo form_radio($data) . chr(10);
	                    echo form_label('#', 'starts_with_num') . chr(10);
	
	                    foreach ($letters as $letter) {
	                        $data = array(
	                            'name'        => 'starts_with',
	                            'id'          => 'starts_with_' . strtolower($letter),
	                            'value'       => $letter, 
	                            'checked'     =>  $this->session->userdata('movie_starts_with_search') == $letter ? TRUE : FALSE,
	                        );                    
	                        echo form_radio($data) . chr(10);
	                        echo form_label($letter, 'starts_with_' . strtolower($letter)) . chr(10);
	                    }
	
	
	                echo '</div>' . chr(10); 
	             
					echo '<div class="form-group">' . chr(10);
	                   
	                    $data = array(
	                        'name' => 'title_search', 
	                        'id' => 'title_search', 
	                        'placeholder' => 'Search by Title',
	                        'value' => $this->session->userdata('movie_title_search'), 
	                        'class' => 'medium form-control'
	                    );
	                    echo form_input($data);
	                    //echo form_input('title', $this->session->userdata('movie_title_search'));
					echo '</div>' . chr(10); // end of - form-group
					
					echo '<div class="form-group">' . chr(10); 
	                    // Create the list of items for the drop down.
	                    $options = array(  
	                        '' => 'All Genres',
	                        'Action' => 'Action', 
	                        'Adventure' => 'Adventure', 
	                        'Animation' => 'Animation',                 
	                        'Anime' => 'Anime', 
	                        'Children' => 'Children', 
	                        'Comedy' => 'Comedy', 
	                        'Crime' => 'Crime', 
	                        'Drama' => 'Drama', 
	                        'Documentary' => 'Documentary', 
	                        'Family' => 'Family', 
	                        'Fantasy' => 'Fantasy', 
	                        'Horror' => 'Horror', 
	                        'Music' => 'Music', 
	                        'Musical' => 'Musical', 
	                        'Mystery' => 'Mystery', 
	                        'Romance' => 'Romance', 
	                        'Sci Fi' => 'Sci Fi', 
	                        'Sports' => 'Sports', 
	                        'Television' => 'Television', 
	                        'Thriller' => 'Thriller', 
	                        'Other' => 'Other'
	                    );
						
						$data = 'id="genre_search" class="form-control"';
						
	                    echo form_dropdown('genre_search', $options, $this->session->userdata('movie_genre_search'), $data);
					echo '</div>' . chr(10); // end of - form-group	
					
					echo '<div class="form-group">' . chr(10); 
	                    // Create the list of items for the drop down.
	                    $options = array(  
	                        '' => 'All MPAA Ratings',
	                        'G' => 'G', 
	                        'PG' => 'PG', 
	                        'PG-13' => 'PG-13',                 
	                        'R' => 'R', 
	                        'NC-17' => 'NC-17', 
	                        'NR' => 'NR'
	                    );
	
	                    $data = 'id="mpaa_rating_search" class="form-control"';
						
	                    echo form_dropdown('mpaa_rating_search', $options, $this->session->userdata('movie_mpaa_rating_search'), $data);
					echo '</div>' . chr(10); // end of - form-group
	    
	    
					echo '<div class="form-group">' . chr(10);
	                   
	                    $data = array(
	                        'name' => 'year_released_search', 
	                        'id' => 'year_released_search', 
	                        'placeholder' => 'Search by Year',
	                        'value' => $this->session->userdata('movie_year_released_search'), 
	                        'class' => 'medium form-control'
	                    );
	                    echo form_input($data);
	                    //echo form_input('title', $this->session->userdata('movie_title_search'));
					echo '</div>' . chr(10); // end of - form-group	    
					
					
					echo '<div class="form-group">' . chr(10);
	                   
	                    $data = array(
	                        'name' => 'persons_name_search', 
	                        'id' => 'persons_name_search', 
	                        'placeholder' => 'Search by Name',
	                        'value' => $this->session->userdata('movie_persons_name_search'), 
	                        'class' => 'medium form-control'
	                    );
	                    echo form_input($data);
	                    //echo form_input('title', $this->session->userdata('movie_title_search'));
					echo '</div>' . chr(10); // end of - form-group						
	    
	    
	                $attributes = array('name' => 'submit', 'value' => 'Search', 'class' => 'btn btn-primary btn-sm');
	                echo form_submit($attributes) . chr(10);
	                // $attributes = array('name' => 'reset', 'id' => 'btn_reset', 'value' => 'Reset', 'class' => 'btn btn-danger');    
	                // $js = 'onClick="reset_form_values()"';                        
	                // echo form_reset($attributes, '', $js) . chr(10);    
	                $attributes = array('name' => 'btn_reset', 'id' => 'btn_reset', 'content' => 'Reset', 'class' => 'btn btn-danger btn-sm');
	                $js = 'onClick="reset_form_values()"';
	                echo form_button($attributes, '', $js) . chr(10);
	
	                echo form_close() . chr(10);
	
	            echo '</div>' . chr(10);    // end of - search_form_elements
	            
	        echo '</div>' . chr(10);    // end of - well well-sm
            ?>

        </div> <!-- end of - col-md-12 -->
    </div> <!-- end of - row -->
</div> <!-- end of - container -->

<script type="text/javascript" src="<?php echo base_url('js/movie-search-form.js'); ?>"></script>