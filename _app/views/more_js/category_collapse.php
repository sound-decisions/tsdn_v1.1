<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<script type="text/javascript">
$(document).ready(function ($) {
	
	
	// Find responsive breakpoints.
	function responsive_state()
	{
	    return $('.responsive-state').css('width');
	}
	
	
	function check_screen_size()
	{
		var strWidth = responsive_state();
		var strWidthNum = strWidth.replace("px", "");
		
		if (strWidthNum <= 767) {
		//if (responsive_state() == '767px') {
			$('#CategoryList').collapse('hide');
			
			//$('#CategoryList').removeClass("in");
		}
		
		if (strWidthNum >= 1000) {
			$('#CategoryList').collapse('show');
		}
		

	    //$('span.w').text($(document).width());
	    //$('span.s').text(responsive_state());
	    //$('span.s').text(strWidthNum + strShowHide);
	    return false;
	}
	
	// When the window resizes check the screen size to see if the things should be done.
	//$(window).resize(check_screen_size);
	
	// Always check the screen size when the page loads.
	check_screen_size();
	
	
	// When the Category List is shown or hidden do the following.
	$('#CategoryList').on('hide.bs.collapse', function () {
		$('#CategoryListGlyphicon').removeClass("glyphicon-minus");
	  	$('#CategoryListGlyphicon').addClass("glyphicon-plus");
	});

	$('#CategoryList').on('show.bs.collapse', function () {
		$('#CategoryListGlyphicon').removeClass("glyphicon-plus");
	  	$('#CategoryListGlyphicon').addClass("glyphicon-minus");
	});	
	
});
</script>

<?php
/* End of file recipe_notes.php */
/* Location: ./application/views/more_js/category_collapse.php */