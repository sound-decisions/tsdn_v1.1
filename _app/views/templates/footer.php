</div><!-- end of - body_container -->
<!-- <p>Scren width : <span class="w"></span>px</p> -->
<!-- <p>Responsive state : <span class="s"></span></p> -->
<div class="responsive-state"></div>


<div class="footer_container_holder">
<div class="footer_container">
<div class="container">	

	<div class="row">
		<footer>
			<div class="col col-lg-12">

				<?php
				$current_year = date('Y', time());


				echo '<div class="clearfix hidden-xs">' . chr(10);
					echo '<div class="pull-left">';
						echo '<a href="#">Back To Top</a>';
					echo '</div>' . chr(10);
					echo '<div class="pull-right">';
						echo '<a href="' . site_url('terms-of-use') . '">Terms of Use</a>';
						echo '<span class="padding-left-10 padding-right-10">|</span>';
						echo '<a href="' . site_url('privacy-policy') . '">Privacy Policy</a>';
					echo '</div>' . chr(10);
				echo '</div>' . chr(10);
				
				echo '<div class="visible-xs margin-top">';
					echo '<div class="margin-bottom-20">' . chr(10);
						echo '<a href="#">Back To Top</a>';
					echo '</div>' . chr(10);
					
					echo '<div>' . chr(10);
						echo '<a href="' . site_url('terms-of-use') . '">Terms of Use</a>';
						echo '<span class="padding-left-10 padding-right-10">|</span>';
						echo '<a href="' . site_url('privacy-policy') . '">Privacy Policy</a>';
					echo '</div>' . chr(10);
				echo '</div>' . chr(10);
				
				echo '<div class="center-text margin-top-30"><span title="Last Updated:  April 30 2014" class="footer-site-version"><strong>v1.1</strong></span></div>' . chr(10);	

				echo '<div class="center-text margin-top-10 margin-bottom-20">' . chr(10);
					echo '<p class="hidden-xs">Copyright &copy; 2011 - ' . $current_year . ' Sound Decisions Inc.  All Rights Reserved.</p>' . chr(10);
					echo '<p class="visible-xs">Copyright &copy; 2011 - ' . $current_year . '<br />Sound Decisions Inc.<br />All Rights Reserved.</p>' . chr(10);
				echo '</div>' . chr(10);		
				?>
				
			</div><!-- end of - col col-lg-12 -->
		</footer>
	</div><!-- end of - row -->

</div><!-- end of - container -->
</div><!-- end of - footer_container -->
</div><!-- end of - footer_container_holder


<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script> -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function () {



}); // end of - $(document).ready(function ()

// This is the base url for the site so it can be used any additional .js files.
var g_base_url = '<?php echo base_url(); ?>';
</script>
<script type="text/javascript" src="<?php echo base_url('js/common_footer_scripts.js'); ?>"></script>

</body>
</html>