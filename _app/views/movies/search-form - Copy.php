<div class="container">
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
            echo '<div class="center-block">' . chr(10);
                                                            
                $attributes = array('name' => 'search_movies', 'id' => 'search_movies', 'class' => 'form-inline');                
                $hidden = array('starts_with_hidden' => $this->session->userdata('movie_starts_with_search'));

                echo form_open('movies/search_results', $attributes, $hidden) . chr(10);
                

                echo '<div class="center-block">' . chr(10);

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
                ?>

                <table class="form_elements col-centered">
                    <tr>
                        <td class="form_label"><label for="search_title">Title</label></td>
<!--                            <td><input type="text" name="title" value="<?php echo $this->session->userdata('movie_title_search'); ?>" /></td>-->
                        <td>
                            <?php
                            $data = array(
                                'name' => 'title_search', 
                                'id' => 'title_search', 
                                'value' => $this->session->userdata('movie_title_search'), 
                                'class' => 'medium'
                            );
                            echo form_input($data);
                            //echo form_input('title', $this->session->userdata('movie_title_search'));
                            ?>
                        </td>
                        <td class="form_label"><label for="genre_search">Genre</label></td>
                        <?php

                        // Create the list of items for the drop down.
                        $options = array(  
                            '' => '--Genre--',
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

                        echo '<td>' . chr(10);
                            echo form_dropdown('genre_search', $options, $this->session->userdata('movie_genre_search'));
                        echo '</td>' . chr(10);                
                        ?>                        
                        <td class="form_label"><label for="mpaa_rating_search">Rated</label></td>
                        <?php

                        // Create the list of items for the drop down.
                        $options = array(  
                            '' => '--MPAA Rating--',
                            'G' => 'G', 
                            'PG' => 'PG', 
                            'PG-13' => 'PG-13',                 
                            'R' => 'R', 
                            'NC-17' => 'NC-17', 
                            'NR' => 'NR'
                        );

                        echo '<td>' . chr(10);
                            echo form_dropdown('mpaa_rating_search', $options, $this->session->userdata('movie_mpaa_rating_search'));
                        echo '</td>' . chr(10);                
                        ?>
                        <td>
                            <?php      
                            $attributes = array('name' => 'submit', 'value' => 'Search', 'class' => 'btn btn-primary');
                            echo form_submit($attributes) . chr(10);
                            // $attributes = array('name' => 'reset', 'id' => 'btn_reset', 'value' => 'Reset', 'class' => 'btn btn-danger');    
                            // $js = 'onClick="reset_form_values()"';                        
                            // echo form_reset($attributes, '', $js) . chr(10);    
                            $attributes = array('name' => 'btn_reset', 'id' => 'btn_reset', 'content' => 'Reset', 'class' => 'btn btn-danger');
                            $js = 'onClick="reset_form_values()"';
                            echo form_button($attributes, '', $js) . chr(10);                            
                            ?>                                        
                        </td>
                    </tr>              
                </table>
                <!-- </div>  -->                
                    
                <?php
                echo form_close() . chr(10);

            echo '</div>' . chr(10);    // end of - search_form_elements
            ?>

        </div> <!-- end of - col-md-12 -->
    </div> <!-- end of - row -->
</div> <!-- end of - container -->

<script type="text/javascript" src="<?php echo base_url('js/movie-search-form.js'); ?>"></script>