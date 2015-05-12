    
    <!-- post date, categories, comments, author -->
    <div class="entry-misc entry-misc-quote">
        <span><i class="fa fa-clock-o"></i><?php the_time(get_option('date_format')); ?></span>
        <span><i class="fa fa-file-o"></i><?php the_category(', '); ?></span>
        <span><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span>
    </div>
	<div class="clearboth"></div>
    
    <!-- aside post body -->
    <div class="aside-body">
        <?php the_content(); ?>
    </div>