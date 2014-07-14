
$(document).ready(function () {
	
	
	$('.toggle-on-watch-list').click(function(event) {
		
		event.preventDefault();
		
		var link_id = this.id;
		// Remove toggle-on-watch-list- from the passed in value to get the actual id.
		var id = link_id.replace("toggle-on-watch-list-", "");
		
		var a_ids = id.split("-");
		var movie_id = a_ids[0];
		//alert("movie_id = " + movie_id);
		
		// alert("link_id = " + link_id);
		// alert("id = " + id);
		
		var url = g_base_url + 'index.php/member-movies/toggle-on-watch-list/' + id + '';
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
		                                $link.removeClass("btn-default");
		                                $link.addClass("btn-success");
		            				} else {
		            					// If the link has a class of watch-list added then hide the movie if taken off the watch list.
		            					if ($link.is(".watch-list")) {		            						
			            					var $div = $('#movie-holder-' + movie_id);
			            					$div.hide(500);		            						
		            					} else {		            						
			                                $link.removeClass("btn-success");
			                                $link.addClass("btn-default");		            						
		            					}		            					
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
	 
	}); // end of - $('.toggle-on-watch-list').click(function()	
	
	
	
	$('.toggle-seen-it').click(function(event) {
		
		event.preventDefault();
		
		var link_id = this.id;
		// Remove toggle-on-watch-list- from the passed in value to get the actual id.
		var id = link_id.replace("toggle-seen-it-", "");
		
		//alert("link_id = " + link_id);
		//alert("id = " + id);
		
		var url = g_base_url + 'index.php/member-movies/toggle-seen-it/' + id + '';
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
		                                $link.removeClass("btn-default");
		                                $link.addClass("btn-success");		                                
		            				} else {
		                                $link.removeClass("btn-success");
		                                $link.addClass("btn-default");		            					
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
	 
	}); // end of - $('.toggle-seen-it').click(function()		
	
	
	
	// Mark a movie as featured or not featured based on its current value.
	$('.toggle-featured').click(function(event) {
		
		event.preventDefault();
		
		var link_id = this.id;
		// Remove toggle-featured- from the passed in value to get the actual id.
		var id = link_id.replace("toggle-featured-", "");
		
		//alert("link_id = " + link_id);
		//alert("id = " + id);
		
		var url = g_base_url + 'index.php/movies/toggle-featured/' + id + '';
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
		                                $link.removeClass("btn-default");
		                                $link.addClass("btn-success");		                                
		            				} else {
		            					// If the link has a class of featured-list added then hide the movie if taken off the featured list.
		            					if ($link.is(".featured-list")) {		            						
			            					var $div = $('#movie-holder-' + id);
			            					$div.hide(500);		            						
		            					} else {		            						
			                                $link.removeClass("btn-success");
			                                $link.addClass("btn-default");		            						
		            					}			            							            					
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
	 
	}); // end of - $('.toggle-featured').click(function()
	
	
	
	
	
	$('.toggle-in-720').click(function(event) {
		
		event.preventDefault();
		
		var link_id = this.id;
		// Remove toggle-in-720- from the passed in value to get the actual id.
		var id = link_id.replace("toggle-in-720-", "");
		
		//alert("link_id = " + link_id);
		//alert("id = " + id);
		
		var url = g_base_url + 'index.php/member-movies/toggle-in-720/' + id + '';
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
		                                $link.removeClass("btn-default");
		                                $link.addClass("btn-success");		                                
		            				} else {
		                                $link.removeClass("btn-success");
		                                $link.addClass("btn-default");		            					
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
	 
	}); // end of - $('.toggle-in-720').click(function()	
	
	
	
	$('.toggle-in-1080').click(function(event) {
		
		event.preventDefault();
		
		var link_id = this.id;
		// Remove toggle-in-1080- from the passed in value to get the actual id.
		var id = link_id.replace("toggle-in-1080-", "");
		
		//alert("link_id = " + link_id);
		//alert("id = " + id);
		
		var url = g_base_url + 'index.php/member-movies/toggle-in-1080/' + id + '';
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
		                                $link.removeClass("btn-default");
		                                $link.addClass("btn-success");		                                
		            				} else {
		                                $link.removeClass("btn-success");
		                                $link.addClass("btn-default");		            					
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
	 
	}); // end of - $('.toggle-in-1080').click(function()
	
	
	
	$('.toggle-in-3d').click(function(event) {
		
		event.preventDefault();
		
		var link_id = this.id;
		// Remove toggle-in-3d- from the passed in value to get the actual id.
		var id = link_id.replace("toggle-in-3d-", "");
		
		//alert("link_id = " + link_id);
		//alert("id = " + id);
		
		var url = g_base_url + 'index.php/member-movies/toggle-in-3d/' + id + '';
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
		                                $link.removeClass("btn-default");
		                                $link.addClass("btn-success");		                                
		            				} else {
		                                $link.removeClass("btn-success");
		                                $link.addClass("btn-default");		            					
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
	 
	}); // end of - $('.toggle-in-3d').click(function()		
	
	


}); // end of - $(document).ready(function ()