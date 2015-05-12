//jQuery(document).ready(function() {	

//var gw_scroller = function () {
	
	
jQuery(function(){


	jQuery(window).on("load resize",function(e){
	//jQuery(window).load(function() {	
	
	//jQuery(window).resize(function() {
		"use strict";
		
		
		
	
		function isScrolledTo(elem) {
			var docViewTop = jQuery(window).scrollTop(); //number of pixels hidden above current screen
			var docViewBottom = docViewTop + jQuery(window).height();
			var elemTop = jQuery(elem).offset().top; //number of pixels above the elem
			var elemBottom = elemTop + jQuery(elem).height();

			return ((elemTop <= docViewTop || elemTop >= docViewTop));
		}
		
		
		var catcher = jQuery('.catcher');
		var sticky = jQuery('.kb-nav');
		var header = jQuery('.header-wrapper');
		var footer = jQuery('.footer-parent');
		var headTop = header.offset().top;
		var footTop = footer.offset().top;
		
		
		if (jQuery(window).width() < 960) {
			
		}
		
		
		
		jQuery(window).scroll(function() {
			
			if(isScrolledTo(sticky)) {/* fixed nav */
				sticky.css('position', 'fixed');
				sticky.css('top', headTop + 100);
			}
			
			var stopHeight = catcher.offset().top + catcher.height();
			var stickyFoot = sticky.offset().top + sticky.height();

			if (stickyFoot > footTop - 60) { /* scroll gets at the footer */

				sticky.css({
					position:'absolute',
					top: footTop - sticky.height() - stopHeight
				});
			  
			} else { /* default scrolling */
			
			if ( stopHeight > sticky.offset().top ) {
				sticky.css('position','relative');
				sticky.css('top',0);
			}
			  
		}
			
	});
	
	//}).resize();
	});
	
	
	
	
});


//});



//};

//jQuery(document).ready(gw_scroller);
//jQuery(window).resize(gw_scroller);

























