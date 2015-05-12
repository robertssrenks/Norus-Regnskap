<?php 
global $goldenworks; 

$footercontent = get_post_meta($post->ID, 'fcontent', true);

$footerbg = get_post_meta($post->ID, 'fbackground', true);

$footerbg_color = get_post_meta($post->ID, 'fbgcolor', true); 

$footercolor = get_post_meta($post->ID, 'fcolor', true); 


$gw_footerbg_color = '';
$gw_footercolor = '';
$gw_footerbg = '';
$gwbottom_styling = '';


if($footerbg_color) {
	$gw_footerbg_color = ' background-color:' . $footerbg_color . '';
}

if($footerbg) {
	$gw_footerbg = ' background-image:url(' . $footerbg . ');';
}
	
	
$gwbottom_styling = 'style="' . $gw_footerbg_color . ' ; ' . $gw_footerbg . '"';	
	
	
if($footercolor) {
	$gw_footercolor = ' style="color:'. $footercolor . '"';
}


if($footercontent) { ?>

	<!-- top footer content + background -->
	<section class="ftopbar"  <?php echo $gwbottom_styling; ?>>
	
		<div class="ftopbar-wrapper" <?php echo $gw_footercolor; ?>>
			<?php echo do_shortcode($footercontent); ?>
		</div>
	
	</section>

<?php } ?>