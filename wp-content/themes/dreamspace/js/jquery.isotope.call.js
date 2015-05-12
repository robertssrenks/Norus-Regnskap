//jQuery(window).load(function() {	
		
jQuery(function(){
	
	/* portfolio isotope filtering */
	var $container = jQuery('#portfolio-container');
	
	$container.imagesLoaded( function(){
		//alert('images are loaded now');
	
		jQuery(window).smartresize(function(){

			$container.isotope({ filter: '*', itemSelector: '.portfolio-item', animationOptions: { duration: 320, easing: 'easeOutQuart', queue: false, resizable: false } });
							
		}).smartresize();
	
	});

	jQuery('.portfolio-filter a').click(function(){
		jQuery('.portfolio-filter').find('a').removeClass('pselected'); 
		jQuery(this).addClass('pselected'); 
		var selector = jQuery(this).attr('data-filter');
		$container.isotope({
			filter: selector,
			animationOptions: {
				duration: 320,
				easing: 'easeOutQuart',
				queue: false
			}
		});
		return false;
	});
		
	
});		


//});//end of window load