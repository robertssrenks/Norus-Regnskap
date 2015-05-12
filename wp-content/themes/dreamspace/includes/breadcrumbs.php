<?php global $goldenworks;

if($goldenworks['display-breadcrumbs'] == 1) {

	$breadcrumbs = get_post_meta($post->ID, 'breadcrumbs', true);
	
	if(class_exists('gw_breadcrumb') && !$breadcrumbs == "false") { 
		
		/* breadcrumbs, if plugin exists */ ?>
		<div class="gw-breadcrumbs">
		<?php $gw = new gw_breadcrumb(); ?>
		</div>
		<div class="clearboth"></div>
		
	<?php } else { /* no breadcrumbs so we add a spacer */ ?>
	
		<div class="bc-space"></div>
			 
	<?php } 

} else { ?>
	
    <div class="bc-space"></div>	
    
<?php } ?>
