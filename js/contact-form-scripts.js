
// Handle the Contact Form.
$(document).ready(function () {

	$("button#submit").click(function() {

		$.ajax({
			type: "POST",
			url: '<?php echo base_url(); ?>index.php/contact_messages/add', 
			data: $('form#contact_form').serialize(),
			success: function(msg) {
				$('form#contact_form').submit();
				$("#thanks").html(msg);
				$("#contact_form").modal('hide');	
			},
			error: function() {
				alert("An error occurred while submitting the form.");
			}
		});

		event.preventDefault();
	});
	
}); // end of - $(document).ready(function () {