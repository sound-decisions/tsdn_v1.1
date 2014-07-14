<div class="container">
    <div class="row">
        <div class="col-md-12">

            <?php         
            echo '<h4 class="page_title">Email Not Sent</h4>' . chr(10);

 			echo '<div class="alert alert-danger">' . chr(10);
            	echo '<p>An attempt was made to send you an email and for whatever reason it just didn\'t work.</p>' . chr(10);
		
				// If a message has been set then display it.
				if ($this->session->flashdata("message") !== FALSE) {
					echo '<p class="margin-top text-left">' . $this->session->flashdata("message") . '</p>' . chr(10);
				} else {
					echo '<p>We are very sorry for the inconvenience.  If you were trying to do something on the site, please try again.</p>' . chr(10);
				}		
			
			echo '</div>' . chr(10); // end of - alert
            ?>

        </div> <!-- end of - col-md-12 -->
    </div> <!-- end of - row -->
</div> <!-- end of - container -->