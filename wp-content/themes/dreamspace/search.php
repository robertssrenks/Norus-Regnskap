<?php

get_header();

get_template_part('intslider');

?>

<section>

    <div class="content-wrapper">

        <div class="container">

			<?php get_template_part('includes/breadcrumbs'); ?>
            
            <div class="content">

				<div class="archive-title"><?php get_template_part('includes/archive_title'); ?></div>
				
                <?php echo do_shortcode('[spacing size="10px"]'); ?>
                
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>                
					
                    <div class="search-block">
                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <?php echo excerpt('26'); ?>
                        
                        <div class="search-permalink"><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></div>
    					
                        <hr class="gw-divider clearboth" />
                    </div>
                    
                <?php endwhile; endif; ?>
                
		        <?php echo do_shortcode('[spacing size="16px"]'); ?>
                
                <div class="pagination-wrapper">
                    <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                        <?php next_posts_link(__('&larr; Older Entries', 'framework')) ?>
                        <?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?>
                    <?php } ?>
                </div>
                
                <?php wp_reset_query(); ?>
                        
            </div><!-- end of content -->
            
        </div><!-- end of .container -->
        
    </div><!-- end of .content-wrapper -->

</section>

<?php get_footer(); ?>