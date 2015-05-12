jQuery(document).ready(function() {
	jQuery('.magnific-popup').magnificPopup({
		type:'image',
		gallery:{enabled:true}
	});
	
	jQuery('.magnific-popup-video').magnificPopup({
		type:'iframe',
		gallery:{enabled:true}
	});	
	
});