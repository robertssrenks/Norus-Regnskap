jQuery(window).load(function() {
  jQuery('.flexslider').flexslider({
    animation: "fade",
    slideshow: true,
	touch: true,
	smoothHeight: true,
	controlNav: false,
    prevText: "&#xf104;",
    nextText: "&#xf105;",
    slideshowSpeed: 6000,
	animationSpeed: 1000,
	directionNav: true,
	after:function(){
		var slider1 = jQuery('.flexslider').data('flexslider');
		slider1.resize();
	}	
  });
});