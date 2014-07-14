// These are comment jquery scripts that are added to the footer section of every page.
$(document).ready(function () {

	// Tool Tip Scripts
	$('[data-toggle="tooltip"]').tooltip({'placement': 'left'});
	$('[data-toggle="tooltip-left"]').tooltip({'placement': 'left'});
	$('[data-toggle="tooltip-right"]').tooltip({'placement': 'right'});
	
	// Workaround for 2 data-toggle values.
	// Add the following to the element:  data-tooltip="tooltip"
	$('body').tooltip({
	    selector: "[data-tooltip=tooltip]",
	    placement: "bottom",
	    container: "body"
	});	
		
	
	// Universal Go Back/Cancel Button Click Handler.
	$('#go-back').click(function(){
		parent.history.back();
		return false;
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

}); // end of - $(document).ready(function ()
