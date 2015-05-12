<?php $video = get_post_meta($post->ID, 'myvideo', true); ?>

<?php if(is_single()) { ?>

    <!-- video --> 
    <?php if ( !post_password_required() ) { ?>    
    <div class="video-wrapper">
        <div class="video-content">
            <?php echo stripslashes(htmlspecialchars_decode($video)); ?>
        </div>
    </div>
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
    <div class="tags-wrapper"><?php the_tags('',''); ?></div>
    <?php } ?>
    
<?php } else { ?>
    
    <!-- video --> 
    <?php if ( !post_password_required() ) { ?>    
    <div class="video-wrapper">    
        <div class="video-content">
            <?php echo stripslashes(htmlspecialchars_decode($video)); ?>    
        </div> 
    </div>               
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