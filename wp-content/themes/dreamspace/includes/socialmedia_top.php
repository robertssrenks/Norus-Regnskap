<?php global $goldenworks; ?>
<?php if ( isset($goldenworks['hicon_twitter']) || isset($goldenworks['hicon_facebook']) || isset($goldenworks['hicon_dribbble']) || 
isset($goldenworks['hicon_linkedin']) || isset($goldenworks['hicon_rss']) ) { ?>
<ul class="tsocial-icons">

	<?php if($goldenworks['hicon_twitter']) { ?>
		<li><a href="<?php echo esc_html($goldenworks['hicon_twitter']); ?>" class="topicon-twitter"><i class="fa fa-twitter"></i></a></li>
	<?php } ?>
	
	<?php if($goldenworks['hicon_facebook']) { ?>
		<li><a href="<?php echo esc_html($goldenworks['hicon_facebook']); ?>" class="topicon-facebook"><i class="fa fa-facebook"></i></a></li>
	<?php } ?>  
							  
	<?php if($goldenworks['hicon_dribbble']) { ?>
		<li><a href="<?php echo esc_html($goldenworks['hicon_dribbble']); ?>" class="topicon-dribbble"><i class="fa fa-dribbble"></i></a></li>
	<?php } ?>                             
	
	<?php if($goldenworks['hicon_linkedin']) { ?>
		<li><a href="<?php echo esc_html($goldenworks['hicon_linkedin']); ?>" class="topicon-linkedin"><i class="fa fa-linkedin"></i></a></li>
	<?php } ?> 
	
	<?php if($goldenworks['hicon_rss']) { ?>
		<li><a href="<?php echo esc_html($goldenworks['hicon_rss']); ?>" class="topicon-rss"><i class="fa fa-rss"></i></a></li>
	<?php } ?>                             
																																			 
</ul>
<?php } ?>