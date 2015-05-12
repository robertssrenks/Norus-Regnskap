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
        <span><i class="fa fa-clock-o"></i><?php the_time(get_option('date_format')); ?></span>
        <span><i class="fa fa-file-o"></i><?php the_category(', '); ?></span>
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

            
            <div class="port-viewer">
        
                <?php the_post_thumbnail('post-thumb'); ?>
                
                <div class="port-mask pm-align">
                    
                    <div class="post-buttons">
                        <div class="port-link"><a href="<?php echo the_permalink(); ?>"><i class="fa fa-arrow-right"></i></a></div>                                        
                    </div>
                </div>                                
            
            </div>            
            
            <div class="clearboth"></div>        
        <?php } ?>           
    
    <?php } ?>
    
    <!-- post title -->        
    <h2 id="post-<?php the_ID(); ?>" <?php post_class(); ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    
    <!-- post date, categories, comments, author -->    
    <div class="entry-misc">
        <span><i class="fa fa-clock-o"></i><?php the_time(get_option('date_format')); ?></span>
        <span><i class="fa fa-file-o"></i><?php the_category(', '); ?></span>
        <span><i class="fa fa-comments-o"></i><?php comments_popup_link(__('no comments', 'framework'), __('1 comment', 'framework'), __('% comments', 'framework')); ?></span>
        <span><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span>
    </div>
    
	<!-- post content -->
    <?php the_content(__('continue reading', 'framework')); ?>

<?php } ?>