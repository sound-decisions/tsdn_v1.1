<div class="container">
    <div class="row">
        <div class="col-md-12">

            <?php         
            echo '<h4 class="page_title">SPAM/SPAM BOT Detected</h4>' . chr(10);

            // If a message is passed then display it, otherwise use the default one.
            if ($this->session->flashdata("message") !== FALSE) {       
                echo '<div class="alert alert-danger">' . $this->session->flashdata("message") . '</div>' . chr(10);
            } else {                
                echo '<div class="alert alert-danger">' . chr(10);
                    echo '<p>We have detected something that would indicate that the form just submitted was not done by a real live person.</p>' . chr(10);
                    echo '<p>If this is not the case, we are very sorry for the inconvenience.  please try again.</p>' . chr(10);
                echo '</div>' . chr(10);
            }
            ?>

        </div> <!-- end of - col-md-12 -->
    </div> <!-- end of - row -->
</div> <!-- end of - container -->