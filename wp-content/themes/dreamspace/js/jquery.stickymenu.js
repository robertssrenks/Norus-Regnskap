jQuery(document).ready(function() {	

	/* display the top fixed menu on scroll */
	jQuery(document).scroll(function () {
		var y = jQuery(this).scrollTop();
		
		var header = jQuery('.header-wrapper');
		var headTop = header.offset().top;

		var hheight = jQuery(".header-wrapper").outerHeight();

		
		if (y > hheight) {
			jQuery('.menu-parent').addClass('fix-menu');
			
		} else {
			jQuery('.menu-parent').removeClass('fix-menu');
		}
	});	
	
});/* end of document ready */		