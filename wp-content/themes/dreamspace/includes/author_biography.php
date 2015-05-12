  <div class="authorbio-wrapper">
	
    <div class="author-avatar">
    	<?php echo get_avatar( get_the_author_meta('user_email') , 80 ); ?>
    	<span class="author-title"><?php the_author_posts_link(); ?></span>
    </div>
    
    <div class="author-info">
		<h4 class="ab-title"><?php _e('About the author', 'framework'); ?></h4>    
		<?php the_author_meta('description'); ?>
    </div>
</div>                



