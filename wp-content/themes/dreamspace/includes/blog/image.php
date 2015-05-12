<?php if(is_single()) { ?>
    
	<?php if(has_post_thumbnail() ) { /* display post thumbnail if present */ ?>
        <?php the_post_thumbnail('post-thumb'); ?>
		<div class="clearboth"></div>        
    <?php } ?>
    
    <!-- post title -->     
    <h2 id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php the_title(); ?></h2>
    
    <!-- post tags -->
	<?php if(has_tag()) { ?>
    <div class="tags-wrapper"><?php the_tags('',''); ?></div>
    <?php } ?>
        
<?php } else { ?>
        
    <?php if(has_post_thumbnail() ) { /* display post thumbnail if present */ ?>
    	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('post-thumb'); ?></a>
	    <div class="clearboth"></div>        
    <?php } ?>               
    
    <!-- post title -->        
    <h2 id="post-<?php the_ID(); ?>" <?php post_class(); ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

<?php } ?>