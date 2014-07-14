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
            if ($this->session->userdata('member_starts_with_search') == '0') {
                $starts_with = '';
            } else {
                $starts_with = $this->session->userdata('member_starts_with_search');
            }
            
            
            // Display the search form.
            echo '<div class="center-block well well-sm">' . chr(10);
			
			
				echo '<div class="center-block">' . chr(10);
	                                                            
	                $attributes = array('name' => 'search_members', 'id' => 'search_members', 'class' => 'form-inline');                
	                $hidden = array('starts_with_hidden' => $this->session->userdata('member_starts_with_search'));
	
	                echo form_open($form_action, $attributes, $hidden) . chr(10);
	                
	
	                echo '<div class="center-block margin-bottom-10">' . chr(10);
						
	                    $data = array(
	                        'name'        => 'starts_with',
	                        'id'          => 'starts_with_not_set',
	                        'value'       => '',  
	                    );                    
	                    echo form_radio($data) . chr(10);						
						
	                    foreach ($letters as $letter) {
	                        $data = array(
	                            'name'        => 'starts_with',
	                            'id'          => 'starts_with_' . strtolower($letter),
	                            'value'       => $letter, 
	                            'checked'     =>  $this->session->userdata('member_starts_with_search') == $letter ? TRUE : FALSE,
	                        );                    
	                        echo form_radio($data) . chr(10);
	                        echo form_label($letter, 'starts_with_' . strtolower($letter)) . chr(10);
	                    }
	
	
	                echo '</div>' . chr(10); 
	             
					echo '<div class="form-group">' . chr(10);
	                   
	                    $data = array(
	                        'name' => 'name_search', 
	                        'id' => 'name_search', 
	                        'placeholder' => 'Search by Name',
	                        'value' => $this->session->userdata('member_name_search'), 
	                        'class' => 'medium form-control'
	                    );
	                    echo form_input($data);
					echo '</div>' . chr(10); // end of - form-group
					
					echo '<div class="form-group">' . chr(10); 

						$data = 'id="status_search" class="form-control"';
						
	                    echo form_dropdown('status_search', $status_options, $this->session->userdata('member_status_search'), $data);
					echo '</div>' . chr(10); // end of - form-group	
					
					echo '<div class="form-group">' . chr(10); 
	
	                    $data = 'id="access_search" class="form-control"';
						
	                    echo form_dropdown('access_search', $access_options, $this->session->userdata('member_access_search'), $data);
					echo '</div>' . chr(10); // end of - form-group
	    
	                $attributes = array('name' => 'submit', 'value' => 'Search', 'class' => 'btn btn-primary');
	                echo form_submit($attributes) . chr(10);
	                // $attributes = array('name' => 'reset', 'id' => 'btn_reset', 'value' => 'Reset', 'class' => 'btn btn-danger');    
	                // $js = 'onClick="reset_form_values()"';                        
	                // echo form_reset($attributes, '', $js) . chr(10);    
	                $attributes = array('name' => 'btn_reset', 'id' => 'btn_reset', 'content' => 'Reset', 'class' => 'btn btn-danger');
	                $js = 'onClick="reset_form_values()"';
	                echo form_button($attributes, '', $js) . chr(10);                            
	
	                echo form_close() . chr(10);
	
	            echo '</div>' . chr(10);    // end of - search_form_elements
	            
	        echo '</div>' . chr(10);    // end of - well well-sm
            ?>

        </div> <!-- end of - col-md-12 -->
    </div> <!-- end of - row -->
</div> <!-- end of - container -->

<script type="text/javascript" src="<?php echo base_url('js/member-search-form.js'); ?>"></script>