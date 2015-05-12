jQuery(function($){
	jQuery(document).ready(function(){
		jQuery('.skillbar-wrapper').each(function(){
			jQuery(this).find('.skillbar-bar, .skillbar-percent').animate({ width: $(this).attr('data-percent') }, 1500 );
		});
	});
});