<?php

/* get quote text and quote author from custom fields values */
$quote = get_post_meta($post->ID, 'q_text', true);
$quote_name = get_post_meta($post->ID, 'q_author', true);

    
if(is_single()) { ?>           
    
    
    <!-- post date, categories, comments, author -->
    <div class="entry-misc entry-misc-quote">
        <span><i class="fa fa-clock-o"></i><?php the_time(get_option('date_format')); ?></span>
        <span><i class="fa fa-file-o"></i><?php the_category(', '); ?></span>
        <span><i class="fa fa-comments-o"></i><?php comments_popup_link(__('no comments', 'framework'), __('1 comment', 'framework'), __('% comments', 'framework')); ?></span>
        <span><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span>
    </div>    
    
    <!-- quote body -->    
    <div class="entry-quote" href="<?php the_permalink();?>">
        <span class="quote-content"><?php echo esc_html($quote); ?></span>
        <?php if($quote_name) { ?>
            <span class="quote-name"><?php echo esc_html($quote_name); ?></span>
        <?php } ?>
        <span class="qquote"></span>
    </div>
    
    <!-- post tags -->
	<?php if(has_tag()) { ?>
    <div class="tags-wrapper"><?php the_tags('',''); ?></div>
    <?php } ?>    
    
    
<?php } else { ?>           
    
    
    <!-- post date, categories, comments, author -->
    <div class="entry-misc entry-misc-quote">
        <span><i class="fa fa-clock-o"></i><?php the_time(get_option('date_format')); ?></span>
        <span><i class="fa fa-file-o"></i><?php the_category(', '); ?></span>
        <span><i class="fa fa-comments-o"></i><?php comments_popup_link(__('no comments', 'framework'), __('1 comment', 'framework'), __('% comments', 'framework')); ?></span>
        <span><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span>
    </div>

    <!-- quote body -->
    <a class="entry-quote" href="<?php the_permalink();?>">
        <span class="quote-content"><?php echo esc_html($quote); ?></span>
        <?php if($quote_name) { ?>
            <span class="quote-name"><?php echo esc_html($quote_name); ?></span>
        <?php } ?>
        <span class="qquote"></span>
    </a>
    
    
<?php } ?>