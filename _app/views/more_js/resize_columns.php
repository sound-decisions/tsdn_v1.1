<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<script type="text/javascript"> 

$(document).ready(function() {  

	// Resize some columns.
	function resize_columns() {

		// 1025 976
		if ($(window).width() >= 975) {
		//if (window.innerWidth <= 1025) {

			//alert("jQuery window.width = " + $(window).width());
			//alert("window.innerWidth = " + window.innerWidth);

	    	var h = $("#c-left").height();

		    $("#c-middle").height(h); 
		    $("#c-right").height(h); 

		    //alert("h = " + h);

		    // Refresh on resize.
		    //location.reload(true);

		} else {

			//$( "body" ).prepend( "<div>" + $( window ).width() + "</div>" );
			//alert("reloading");

			$("#c-left").css("width","100%");
			$("#c-middle").css("width","100%");
			$("#c-middle").css("width","100%");

			//location.reload(true);
		}

		location.reload(true);

	} // end of - function resize_columns


	$(window).resize(function() {	    

		resize_columns();

		// if ($(window).width() >= 1025) {
		// //if (window.innerWidth <= 1025) {

		// 	//alert("jQuery window.width = " + $(window).width());
		// 	//alert("window.innerWidth = " + window.innerWidth);

	 //    	var h = $("#c-left").height();

		//     $("#c-middle").height(h); 
		//     $("#c-right").height(h); 

		//     //alert("h = " + h);

		//     // Refresh on resize.
		//     //location.reload(true);

		// } else {

		// 	location.reload(true);
		// }

	});


}); // end of - $(document).ready(function()
</script>

<?php
/* End of file resize_columns.php */
/* Location: ./application/views/misc_code/resize_columns.php */