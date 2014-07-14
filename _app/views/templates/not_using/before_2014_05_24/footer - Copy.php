</div><!-- end of - body_container -->
<!-- <p>Scren width : <span class="w"></span>px</p> -->
<!-- <p>Responsive state : <span class="s"></span></p> -->
<div class="responsive-state"></div>


<div class="footer_container">
<div class="container">	

	<div class="row">
		<footer>
			<div class="col col-lg-12">

				<?php
				$current_year = date('Y', time());

				echo '<p class="hidden-xs">Copyright &copy; 2011 - ' . $current_year . ' Sound Decisions Inc.  All Rights Reserved.  <span title="Last Updated:  Februray 22 2014">v1.1</span></p>' . chr(10);
				echo '<p class="visible-xs">Copyright &copy; 2011 - ' . $current_year . ' Sound Decisions Inc.<br />All Rights Reserved.  <span title="Last Updated:  Februray 22 2014">v1.1</span></p>' . chr(10);
				
				
				echo '<p class="margin-top-20 margin-bottom-20">';
					echo '<a href="' . site_url('terms-of-use') . '">Terms of Use</a>';
					echo '<span class="padding-left-10 padding-right-10">|</span>';
					echo '<a href="' . site_url('privacy-policy') . '">Privacy Policy</a>';
				echo '</p>' . chr(10);
				?>
				
			</div><!-- end of - col col-lg-12 -->
		</footer>
	</div><!-- end of - row -->

</div><!-- end of - container -->
</div><!-- end of - footer_container -->



<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script> -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function () {

	$('[data-toggle="tooltip"]').tooltip({'placement': 'bottom'});

	// Workaround for 2 data-toggle values.
	// Add the following to the element:  data-tooltip="tooltip"
    $('body').tooltip({
        selector: "[data-tooltip=tooltip]",  
        placement: "bottom", 
        container: "body"
    });	


	// $( '#header-logo' ).hover(
		// function() {
			// // $( this ).attr('src', '< ?php echo base_url("images/sdn/the_sound_decisions_header_logo_red_350x60.png"); ?>');
			// $( this ).attr('src', '< ?php echo base_url("images/sdn/the_sound_decisions_header_logo_red_350x60_ul.png"); ?>');
		// }, function() {
			// // $( this ).attr('src', '< ?php echo base_url("images/sdn/the_sound_decisions_header_logo_yellow_350x60.png"); ?>');
			// $( this ).attr('src', '< ?php echo base_url("images/sdn/the_sound_decisions_header_logo_yellow_350x60_ul.png"); ?>');
		// }
	// );


	// Universal Go Back/Cancel Button Click Handler.
	$('#go-back').click(function(){
		parent.history.back();
		return false;
	});	

}); // end of - $(document).ready(function ()
</script>

</body>
</html>