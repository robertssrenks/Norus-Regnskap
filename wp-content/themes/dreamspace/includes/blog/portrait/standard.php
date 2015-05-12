<?php $post_portrait = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-portrait'); ?>

<?php if(is_single()) { ?>

    <?php if ( !post_password_required() ) { ?>
    
		<?php if(has_post_thumbnail() ) { /* display post thumbnail if present */ ?>
            <?php the_post_thumbnail('post-thumb'); ?>
            <div class="clearboth"></div>        
        <?php } ?>
    
    <?php } ?>
        
    <!-- post title -->     
    <h2 id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php the_title(); ?></h2>
    
    <!-- post date, categories, comments, author -->
    <div class="entry-misc">
        <span><i class="fa fa-calendar"></i><?php the_time(get_option('date_format')); ?></span>
        <span><i class="fa fa-file-text-o"></i><?php the_category(', '); ?></span>
        <span><i class="fa fa-comments-o"></i><?php comments_popup_link(__('no comments', 'framework'), __('1 comment', 'framework'), __('% comments', 'framework')); ?></span>
        <span><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span>
    </div>
    
	<!-- post content -->
    <div class="salign-text">
        <?php the_content(); ?>
    </div>
    
    <!-- post tags -->
	<?php if(has_tag()) { ?>
    <div class="tags-wrapper"><?php the_tags(''); ?></div>
    <?php } ?>    
    
<?php } else { ?>
    
    
    
    <?php if ( !post_password_required() ) { ?>
    
		<?php if(has_post_thumbnail() ) { /* display post thumbnail if present */ ?>
        
        	<div class="bportrait-img">
            
                <div class="port-viewer">
                    
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $post_portrait[0]; ?>" alt="<?php the_title(); ?>" class="attachment-post-portrait" /></a>
                    
                    <div class="port-mask pm-align">
                        
                        <div class="post-buttons">
                            <div class="port-link"><a href="<?php echo the_permalink(); ?>"><i class="fa fa-arrow-right"></i></a></div>                                        
                        </div>
                    </div>                                
                
                </div><!-- end of .port-viewer -->  
                         
	        </div>
        
            <div class="clearboth"></div>       
        <?php } ?>            
    
    <?php } ?>
    
    <div class="bportrait-content">
        <!-- post title -->        
        <h2 id="post-<?php the_ID(); ?>" <?php post_class('column-title'); ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        
        <!-- post date, comments -->    
        <div class="entry-misc">
			<span class="bportrait-date"><?php the_time(get_option('date_format')); ?></span>
			<span class="bportrait-comments"><?php comments_popup_link(__('no comments', 'framework'), __('1 comment', 'framework'), __('% comments', 'framework')); ?></span>            
        </div>
        
        <!-- post content -->
        <?php the_content(__('continue reading', 'framework')); ?>
	</div>

<?php } ?>