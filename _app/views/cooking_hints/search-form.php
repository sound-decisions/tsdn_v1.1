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
            
                                 
            // Display the search form.
            echo '<div class="well well-sm">' . chr(10);

                $attributes = array('name' => 'search_cooking_hints', 'id' => 'search_cooking_hints', 'class' => 'form-inline');

                echo form_open($form_action, $attributes) . chr(10);
             
				echo '<div class="form-group col-sm-6">' . chr(10);
                   
                    $data = array(
                        'name' => 'title_search', 
                        'id' => 'title_search', 
                        'placeholder' => 'Search by Title or Content',
                        'value' => $this->session->userdata('cooking_hints_title_search'), 
                        'class' => 'form-control'
                    );
                    echo form_input($data);
                    //echo form_input('title', $this->session->userdata('movie_title_search'));
				echo '</div>' . chr(10); // end of - form-group
				
    
                $attributes = array('name' => 'submit', 'value' => 'Search', 'class' => 'btn btn-primary btn-xs');
                echo form_submit($attributes) . chr(10);
                // $attributes = array('name' => 'reset', 'id' => 'btn_reset', 'value' => 'Reset', 'class' => 'btn btn-danger');    
                // $js = 'onClick="reset_form_values()"';                        
                // echo form_reset($attributes, '', $js) . chr(10);    
                $attributes = array('name' => 'btn_reset', 'id' => 'btn_reset', 'content' => 'Reset', 'class' => 'btn btn-danger btn-xs');
                $js = 'onClick="reset_form_values()"';
                echo form_button($attributes, '', $js) . chr(10);

                echo form_close() . chr(10);

            echo '</div>' . chr(10);    // end of - search_form_elements
            ?>

        </div> <!-- end of - col-md-12 -->
    </div> <!-- end of - row -->
</div> <!-- end of - container -->

<script type="text/javascript" src="<?php echo base_url('js/cooking-hints-search-form.js'); ?>"></script>