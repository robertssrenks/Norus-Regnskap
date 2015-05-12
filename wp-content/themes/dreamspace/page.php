<?php 

get_header();

get_template_part('intslider');

$newscontent = get_post_meta($post->ID, 'mycontent', true);
$newscontent_data = do_shortcode( $newscontent );
?>

<section>

    <div class="content-wrapper">

        <div class="container">

			<?php get_template_part('includes/breadcrumbs'); ?>
            
            <?php if($newscontent_data) { ?>            
            <div class="news-header">
            	<?php echo $newscontent_data; ?>
            </div>
            <?php } ?>             
            
            <?php if($goldenworks['sidebar-position'] == 'left') { get_sidebar(); } ?>
            
            <div class="inner-content">

				<?php if (have_posts()) : while (have_posts()) : the_post();
					the_content();                   

				endwhile; endif; wp_reset_query(); ?>
				
	            <!-- comments section -->
				<?php comments_template('', true); ?> 
                        
            </div><!-- end of .inner-content -->
            
            <?php if($goldenworks['sidebar-position'] == 'right') { get_sidebar(); } ?>
            
        </div><!-- end of .container -->
        
    </div><!-- end of .content-wrapper -->
    
	<!-- footer bar -->
	<?php get_template_part('includes/ftop_bar'); ?>    
    
</section>

<?php get_footer(); ?>