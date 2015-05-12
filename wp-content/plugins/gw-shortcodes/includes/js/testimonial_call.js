jQuery(window).load(function() {
  jQuery('.flexslider').flexslider({
    animation: "slide",
    slideshow: true,
	touch: true,
	smoothHeight: true,
	controlNav: false,
    prevText: "&#xf104;",
    nextText: "&#xf105;",
    slideshowSpeed: 7500,
	after:function(){
		var slider1 = jQuery('.flexslider').data('flexslider');
		slider1.resize();
	}		
  });
});