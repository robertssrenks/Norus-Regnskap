jQuery(function($){
	$(document).ready(function(){
		
		// Toggle
		$("h3.gw-toggle-trigger").click(function(){
			$(this).toggleClass("active").next().slideToggle("fast");
			return false; //Prevent the browser jump to the link anchor
		});
					
		// UI tabs
		$( ".gw-tabs" ).tabs();
		
		// UI accordion
		$(".gw-accordion").accordion({autoHeight: false});		

	}); // END doc ready
}); // END function ($)