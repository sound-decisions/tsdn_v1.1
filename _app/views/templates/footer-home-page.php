</div><!-- end of - body_container -->
<!-- <p>Scren width : <span class="w"></span>px</p> -->
<!-- <p>Responsive state : <span class="s"></span></p> -->
<div class="responsive-state"></div>

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script> -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/isotope.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function () {
	
	$('.carousel').carousel({
	  interval: 7500
	})	
	
	
  	$( window ).resize(function() {
		$('#sections-container').isotope({
  			itemSelector : '.section-item',
  			layoutMode : 'fitRows'
    	});
  	});	
	

}); // end of - $(document).ready(function ()
</script>

</body>
</html>