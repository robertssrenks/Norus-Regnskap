<?php 

get_header();

get_template_part('intslider');

?>

<section>

    <div class="content-wrapper">

        <div class="container">     
            
            <div class="content">

				<?php if (have_posts()) : while (have_posts()) : the_post();
					the_content();                   

				endwhile; endif; wp_reset_query(); ?>
                        
            </div><!-- end of content -->
            
        </div><!-- end of .container -->
        
    </div><!-- end of .content-wrapper -->


	<!-- footer bar -->
	<?php get_template_part('includes/ftop_bar'); ?>

</section>

<?php get_footer(); ?>