<?php

if ( is_page_template('template-homepage.php')) {
	
	get_template_part('includes/rev_slider'); 
	
} else {

	$headercontent = get_post_meta($post->ID, 'hcontent', true);
	
	$headerbg = get_post_meta($post->ID, 'hbackground', true);
	
	$headerbg_color = get_post_meta($post->ID, 'hbgcolor', true); 
	
	$headercolor = get_post_meta($post->ID, 'hcolor', true); 
	
	$portcontent = get_post_meta($post->ID, 'portcontent', true);
	
	
	$gw_headerbg_color = '';
	$gw_headercolor = '';
	$gw_headerbg = '';
	$gwtop_styling = '';
	
	if($headerbg_color) {
		$gw_headerbg_color = ' background-color:' . $headerbg_color . ';';
	}
	
	if($headerbg) {
		$gw_headerbg = ' background-image:url(' . $headerbg . ');';
	}

	$gwtop_styling = 'style="' . $gw_headerbg_color . ' ; ' . $gw_headerbg . '"';	
	
	
	if($headercolor) {
		$gw_headercolor = ' style="color:'. $headercolor . '"';
	}
	
	if($headercontent) { ?>
	
		<section class="gwtop-wrapper" <?php echo $gwtop_styling; ?>>
        	
			<div class="gwtop" <?php echo $gw_headercolor; ?>>
				<?php echo do_shortcode($headercontent); ?>
			</div>
		
		</section>
	
	<?php } 
	
	if( (!$headercontent) && ($portcontent) && !is_tax() ) { ?>
		<section class="gwtop-wrapper">	
        	<?php echo do_shortcode($portcontent); ?>
		</section>        	
	<?php }


} /*end of is_page_template()*/
?>