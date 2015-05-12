<?php 

get_header();

get_template_part('intslider');

?>

<section>

    <div class="content-wrapper">

        <div class="container">

			<?php get_template_part('includes/breadcrumbs'); ?>
            
            <?php if($goldenworks['sidebar-position'] == 'left') { get_sidebar(); } ?>
            
            <div class="inner-content">

                <div class="news-wrapper">
                        
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
                    <!-- news entry -->
                    <article class="entry-news-single">
                
                        <!-- date box -->
                        <div class="date-news">
                            <span class="dn-big"><?php the_time('j'); ?></span>
                            
                            <span class="dn-small"><?php the_time('M Y'); ?></span>
                        </div>
                        
                        <!-- title and categories -->                    
                        <div class="entry-news-title">
                            <h4 id="post-<?php the_ID(); ?>" <?php post_class('news-title'); ?>><?php the_title(); ?></h4>
                            <div class="en-cat"><?php _e('posted under ', 'framework'); echo substr(custom_taxonomies_terms_links(), 0, -2); ?></div>
                        </div>
                        <div class="newsclear"></div>
                        
						<?php if ( !post_password_required() ) { ?>
                        
                            <?php if(has_post_thumbnail() ) { /* display post thumbnail if present */ ?>
                                <?php the_post_thumbnail('news-thumb'); ?>
                                <div class="clearboth"></div>        
                            <?php } ?>
                        
                        <?php } ?>
                            
                        <?php the_content(); ?>
                        
                                                         
                    </article>
                    
                    <?php endwhile; endif; wp_reset_query(); ?>
                	
                    <?php edit_post_link(__('edit post', 'framework'), '<div class="gw-edit"><i class="fa fa-pencil"></i>', '</div>'); ?>
                    
                </div><!-- end of .news-wrapper -->                
                
            
            	<!-- if enabled, display social media bar -->
            	<?php if($goldenworks['nsocial-icons'] == '1') { get_template_part( 'includes/socialmedia' ); } ?>
				
	            <!-- comments section -->
				<?php comments_template('', true); ?> 
                        
            </div><!-- end of .inner-content -->
            
        
            <?php if($goldenworks['sidebar-position'] == 'right') { get_sidebar(); } ?>
            
        </div><!-- end of .container -->
        
    </div><!-- end of .content-wrapper -->

	<!-- enable footer bar on demand -->
	<?php if( ($goldenworks['fbar-news'] == 1) || ($goldenworks['fbar-all'] == 1) ) { get_template_part('includes/ftop_bar'); } ?>
    
</section>


<?php get_footer(); ?>