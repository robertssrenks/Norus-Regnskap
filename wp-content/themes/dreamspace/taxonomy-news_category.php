<?php 

get_header();

get_template_part('intslider');

?>

<section>

    <div class="content-wrapper">
    
        <div class="container">
			
			<?php get_template_part('includes/breadcrumbs'); ?>
            
            
            <?php if($goldenworks['sidebar-position'] == 'left') { get_sidebar(); } ?>
            
            <!-- page content -->
            <div class="inner-content">
            	
                <div class="archive-title"><?php get_template_part('includes/archive_title'); ?></div> 
                            
                <div class="news-wrapper">
                        
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
                    <!-- news entry -->
                    <article class="entry-news">
                
                        <!-- date box -->
                        <div class="date-news">
                            <span class="dn-big"><?php the_time('j'); ?></span>
                            
                            <span class="dn-small"><?php the_time('M Y'); ?></span>
                        </div>
                        
                        <!-- title and categories -->                    
                        <div class="entry-news-title">
                            <h4 id="post-<?php the_ID(); ?>" <?php post_class('news-title'); ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <div class="en-cat"><?php _e('posted under ', 'framework'); echo substr(custom_taxonomies_terms_links(), 0, -2); ?></div>
                        </div>
                                                                
                    </article>
                    
                    <?php endwhile; endif; ?>
                
                </div><!-- end of .news-wrapper --> 
                
        
                <div class="pagination-wrapper pw-news">
                    <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                        <?php next_posts_link(__('&larr; Older Entries', 'framework')) ?>
                        <?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?>
                    <?php } ?>
                </div>
                
                <?php wp_reset_query(); ?>         
            
            
            </div><!-- end of .inner-content -->
            
            <?php if($goldenworks['sidebar-position'] == 'right') { get_sidebar(); } ?>            
            
        </div>    
    
    </div>

</section>



<?php get_footer(); ?>