
/*
  jQuery(function(){
    
    jQuery('.blog-masonry').masonry({
      itemSelector: '.masonry-item',
		gutter: 50
    });
    
  });
*/
  
  
  



jQuery(document).ready(function() {


/*
	var container = document.querySelector('.blog-masonry');


		
	var msnry = new Masonry( container, {
		// options
	//	columnWidth: 200,
		gutter: 50,
		itemSelector: '.masonry-item'
		
	});

*/	




	var $container = jQuery('.blog-masonry').masonry({
		gutter: ".gutter-sizer",
		itemSelector: '.masonry-item'			
	});
	
	

	
	
	
	// layout Masonry again after all images have loaded
	$container.imagesLoaded( function() {
		$container.masonry('layout');
	});




	 jQuery(window).bind("resize", resizeWindow);
        function resizeWindow( e ) {
            var newWindowWidth = jQuery(window).width();
 			

			
			
            if(newWindowWidth<1300){

				
                //jQuery('blog-masonry').masonry();
            } else {
                //jQuery('blog-masonry').masonry();
				
				
            }
        }
		
		
		
		
});




	


/*
jQuery( window ).resize(function() {
	
		var container = document.querySelector('.blog-masonry');
		
		
		
		setTimeout(
		function() 
  {	
	
	
	
	var msnry = new Masonry( container, {
		// options
		isResizable: true,	
	//	columnWidth: 200,
		gutter: 50,
		transitionDuration : 0,
		itemSelector: '.masonry-item'
		
	
	});
	
	
	
	
	
		 }, 600);	

}); */