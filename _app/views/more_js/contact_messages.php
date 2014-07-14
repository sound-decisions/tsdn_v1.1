

<script type="text/javascript">
$(document).ready(function () {

	$(".update_status").click(function() {

		var url_start = 'http://localhost:8080/TRAINING/CODEIGNITER_2.1.4/up_and_running/';

		var id = $(this).data('id');
		var status = $(this).data('status');
		var span_status = $(this).data('spanid');

		$.ajax({
			type: "POST",
			url: url_start + "index.php/contact_messages/update_status", 
			data: { id: id, status: status },
			success: function(msg) {
				$('#' + span_status).text(status);							
			},
			error: function() {
				alert("Unable to update the status of the contact message.");
			}
		});

		event.preventDefault();
	});

}); // end of - $(document).ready(function ()
</script>

<?php
/* End of file contact_messages.php */
/* Location: ./application/views/more_js/contact_messages.php */	