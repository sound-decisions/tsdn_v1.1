<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<script type="text/javascript">

$('.link_item').click(function(){

	var id = this.id;
	var url = '<?php echo base_url(); ?>index.php/mdl-links/update-visit-count/' + id + '';
	//var url = 'http://localhost:8080/TRAINING/CODEIGNITER_2.1.4/up_and_running/index.php/mdl-links/update-visit-count';

	//alert("url = " + url);

    $.ajax({
            type:       'POST', 
   			url:        url, 
            data:       'id=" + id + "', 
            success: 	function(result) {
            				//alert("success - " + result);
            				// if (result != "") {
            					// //$('#display_result').append(result);
                                // $('#display_result').html(result);
            				// } else {
            					// $('#display_result').append("Worked but No Data Returned.");
            				// }
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
/* End of file mdl_links.php */
/* Location: ./application/views/more_js/mdl_links.php */