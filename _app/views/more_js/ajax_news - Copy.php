<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<script type="text/javascript">
// Display the selected news item in a div element with the id news_item_content.
$('.show-news-story').click(function(){
	
	event.preventDefault();
	
	var id = this.id;
	//alert("id = " + id);
	
	var url = '<?php echo base_url(); ?>index.php/news/get-news-item-using-ajax/' + id + '';
	//alert("url = " + url);

    $.ajax({
            type:       'POST', 
   			url:        url, 
            data:       'id=" + id + "', 
            success: 	function(result) {
            				//alert("success - " + result);
            				var $div = $('#news_item_content');
            				if (result != "") {
	            				$div.html(result);
            				} else {
            					$div.html('Did Not Work');
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
/* End of file ajax_news.php */
/* Location: ./application/views/more_js/ajax_news.php */