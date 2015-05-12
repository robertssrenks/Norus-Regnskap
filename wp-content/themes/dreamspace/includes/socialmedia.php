<div class="social-wrapper">
	<h5><?php _e('Spread the word!', 'framework'); ?></h5>
    
    <ul>
        <li><a data-placement="top" title="" data-toggle="tooltip" data-original-title="twitter" href="http://twitter.com/home?status=<?php echo get_permalink(); ?>" rel="external"><i class="fa fa-twitter"></i></a></li>
        <li><a data-placement="top" title="" data-toggle="tooltip" data-original-title="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" rel="external"><i class="fa fa-facebook"></i></a></li>
        <li><a data-placement="top" title="" data-toggle="tooltip" data-original-title="linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo get_permalink(); ?>&amp;title=<?php echo str_replace( ' ', '%20', get_the_title());  ?>"><i class="fa fa-linkedin"></i></a></li>
        <li><a data-placement="top" title="" data-toggle="tooltip" data-original-title="google plus" href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" rel="external"><i class="fa fa-google-plus"></i></a></li>
        <li><a data-placement="top" title="" data-toggle="tooltip" data-original-title="email" href="http://www.freetellafriend.com/tell/?heading=Share+This+Article&amp;bg=1&amp;option=email&amp;url=<?php echo get_permalink(); ?>"><i class="fa fa-envelope-o"></i></a></li>                                
    </ul>
</div>