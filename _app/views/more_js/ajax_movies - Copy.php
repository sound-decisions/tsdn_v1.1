<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<script type="text/javascript">

$('.toggle-featured').click(function(){
	
	event.preventDefault();
	
	var link_id = this.id;
	// Remove toggle-featured- from the passed in value to get the actual id.
	var id = link_id.replace("toggle-featured-", "");
	
	//alert("link_id = " + link_id);
	//alert("id = " + id);
	
	var url = '<?php echo base_url(); ?>index.php/movies/toggle-featured/' + id + '';
	//alert("url = " + url);

    $.ajax({
            type:       'POST', 
   			url:        url, 
            data:       'id=" + id + "', 
            success: 	function(result) {
            				//alert("success - " + result);
            				var $link = $('#' + link_id);
            				if (result != "") {
	            				if (result == "yes") {
	                                $link.text('Featured');
	            				} else {
	            					$link.text('Not Featured');
	            				}
            				} else {
            					$link.text('Did Not Work');
            				}
                		}, // end of - success function
	        failure: 	function (result) {
                            alert("failure - " + result);
                        }, // end of - failure function
	        error: 		function (result) {
                            alert("error - " + result);
                        } // end of - error function               
            }); // end of - $.ajax
 
});

</script>

<?php
/* End of file movies.php */
/* Location: ./application/views/more_js/movies.php */