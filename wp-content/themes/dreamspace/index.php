<?php get_header(); ?>


<section>

    <div class="content-wrapper">
    
        <!-- no breadcrumbs so we add a spacer -->
        <div class="bc-space"></div>    
    
        <div class="container">
			

            
            
            <?php if($goldenworks['sidebar-position'] == 'left') { get_sidebar(); } ?>
            
            <!-- page content -->
            <div class="inner-content">
            	
                <div class="archive-title">
                    <?php _e('Your latest posts', 'framework'); ?>
                </div>
                        
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	            <!-- blog entry -->
            	<article class="entry-block">
            
					<?php $posttype = get_post_format();
            
                    get_template_part( 'includes/blog/'.$posttype );
                
                    if($posttype == '') { get_template_part( 'includes/blog/standard' ); } ?>                      
                    
                </article>
            
				<?php wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=page %'); ?>
                
                <?php endwhile; endif; ?>
                
        
                <div class="pagination-wrapper">
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