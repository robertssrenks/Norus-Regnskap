<?php 
/*
Template Name: Fullwidth
*/

get_header();

$newscontent = get_post_meta($post->ID, 'mycontent', true);
$newscontent_data = do_shortcode( $newscontent );

get_template_part('intslider');

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
            
            <div class="content">

				<?php if (have_posts()) : while (have_posts()) : the_post();
					the_content();                   

				endwhile; endif; wp_reset_query(); ?>
                
				<?php comments_template('', true); ?> 
                        
            </div><!-- end of content -->
            
        </div><!-- end of .container -->
        
    </div><!-- end of .content-wrapper -->


	<!-- footer bar -->
	<?php get_template_part('includes/ftop_bar'); ?>

</section>

<?php get_footer(); ?>