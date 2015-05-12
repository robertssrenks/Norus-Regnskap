jQuery(document).ready(function() {	
	"use strict";
	
	// initialise superfish
	jQuery(function(){
		jQuery('ul.sf-menu').superfish({
		delay:       200,                            
		speed:       'fast', 
		autoArrows:  false,                          
		dropShadows: false    				
		});
	});
	
	
	// responsive menu
	jQuery('.sf-menu, .alt-menu').slicknav({
		label: '',
		duration: 300,
		easingOpen: "jswing", //available with jQuery UI
		prependTo: '.gw-mainmenu nav',
		closedSymbol: '&#xf105;',
		openedSymbol: '&#xf107;'		
	});
	
	
});/* end of document ready */	