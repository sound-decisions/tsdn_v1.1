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
            // Display the search form.
            echo '<div class="center-block well well-sm">' . chr(10);
			
			
				echo '<div class="center-block">' . chr(10);
				
	                $attributes = array('name' => 'search_contact_messages', 'id' => 'search_contact_messages', 'class' => 'form-inline');
	
	                echo form_open($form_action, $attributes) . chr(10);
	                	             
					echo '<div class="form-group">' . chr(10);
	                   
	                    $data = array(
	                        'name' => 'name_search', 
	                        'id' => 'name_search', 
	                        'placeholder' => 'Search by Name',
	                        'value' => $this->session->userdata('contact_message_name_search'), 
	                        'class' => 'medium form-control'
	                    );
	                    echo form_input($data);
					echo '</div>' . chr(10); // end of - form-group
					
					echo '<div class="form-group">' . chr(10);
	                   
	                    $data = array(
	                        'name' => 'message_search', 
	                        'id' => 'message_search', 
	                        'placeholder' => 'Search by Message',
	                        'value' => $this->session->userdata('contact_message_message_search'), 
	                        'class' => 'medium form-control'
	                    );
	                    echo form_input($data);
					echo '</div>' . chr(10); // end of - form-group
					
					echo '<div class="form-group">' . chr(10);
	                   
	                    $data = array(
	                        'name' => 'notes_search', 
	                        'id' => 'notes_search', 
	                        'placeholder' => 'Search by Notes',
	                        'value' => $this->session->userdata('contact_message_notes_search'), 
	                        'class' => 'medium form-control'
	                    );
	                    echo form_input($data);
					echo '</div>' . chr(10); // end of - form-group										
					
					echo '<div class="form-group">' . chr(10); 

						$data = 'id="status_search" class="form-control"';
						
	                    echo form_dropdown('status_search', $status_options, $this->session->userdata('contact_message_status_search'), $data);
					echo '</div>' . chr(10); // end of - form-group	
						    
	                $attributes = array('name' => 'submit', 'value' => 'Search', 'class' => 'btn btn-primary btn-sm');
	                echo form_submit($attributes) . chr(10);   
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

<script type="text/javascript" src="<?php echo base_url('js/contact-message-search-form.js'); ?>"></script>