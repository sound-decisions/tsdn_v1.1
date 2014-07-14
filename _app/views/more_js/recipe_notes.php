<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<script type="text/javascript">
$(document).ready(function ($) {
	
	$('#recipeNotes').on('show.bs.collapse', function() {
		//$('a.accordion-toggle > span').removeClass('glyphicon-collapse-down').addClass('glyphicon-collapse-up');
		//$('a.accordion-toggle').text("Hide Recipe Notes");
		$('a.accordion-toggle').html("<span class=\"padding-right-10 glyphicon glyphicon-collapse-up\"> </span>Hide Recipe Notes");
	});  
	
	$('#recipeNotes').on('hide.bs.collapse', function() {
		//$('a.accordion-toggle > span').removeClass('glyphicon-collapse-up').addClass('glyphicon-collapse-down');
		//$('a.accordion-toggle').text("Show Recipe Notes");
		$('a.accordion-toggle').html("<span class=\"padding-right-10 glyphicon glyphicon-collapse-down\"> </span>Show Recipe Notes");
	});   
	
});
</script>

<?php
/* End of file recipe_notes.php */
/* Location: ./application/views/more_js/recipe_notes.php */