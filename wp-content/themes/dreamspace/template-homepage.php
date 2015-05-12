<?php 
/*
Template Name: Homepage
*/

get_header();

get_template_part('intslider');

$has_sidebar = get_post_meta($post->ID, 'displaysidebar', true);

$footerbar = get_post_meta($post->ID, 'footerbar', true);

?>

<section>

    <div class="content-wrapper">

        <div class="container">

			<div class="bc-space"></div>
            
 			<?php if($has_sidebar == "true") { /* print layout with sidebar */?>   
            
            
				<?php if($goldenworks['sidebar-position'] == 'left') { get_sidebar(); } ?>
                
                <div class="inner-content">
    
                    <?php if (have_posts()) : while (have_posts()) : the_post();
                        the_content();                   
    
                    endwhile; endif; wp_reset_query(); ?>
                    
                    <!-- comments section -->
                    <?php comments_template('', true); ?> 
                            
                </div><!-- end of .inner-content -->
                
                <?php if($goldenworks['sidebar-position'] == 'right') { get_sidebar(); } ?>            
            
            
            <?php } else { /* there is no sidebar so we print a fullwidth layout */?>


                <div class="content">
    
                    <?php if (have_posts()) : while (have_posts()) : the_post();
                        the_content();                   
    
                    endwhile; endif; wp_reset_query(); ?>
                    
                    <?php comments_template('', true); ?> 
                            
                </div><!-- end of content -->
            
            
            <?php } /* end of sidebar case */ ?>
            
        </div><!-- end of .container -->
        
    </div><!-- end of .content-wrapper -->

	<!-- footer bar -->
	<?php get_template_part('includes/ftop_bar'); ?>
    
</section>

<?php get_footer(); ?>