<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>


<script type="text/javascript" src="<?php echo base_url('js/ekko-lightbox.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function ($) {

	// delegate calls to data-toggle="lightbox"
	$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
		event.preventDefault();
		return $(this).ekkoLightbox();			
	});

});
</script>

<?php
/* End of file ekko_lightbox.php */
/* Location: ./application/views/more_js/ekko_lightbox.php */