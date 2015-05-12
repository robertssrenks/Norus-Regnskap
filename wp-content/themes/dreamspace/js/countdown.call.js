jQuery(document).ready(function() {
	
	/* countdown timer call */
	jQuery("#countdown").countdown({
		//date: "17 march 2014 12:00:00",
		date: countdown_data.cs_timer.toString(),
		format: "on"
	},
	function() {
		/* callback function */
	});	
	
});/* end of document ready */	