<?php 
/*
Template Name: KnowledgeBase
*/

get_header();

$footerbar = get_post_meta($post->ID, 'footerbar', true);

$kbnav = get_post_meta($post->ID, 'navigation', true);


get_template_part('intslider');

?>

<section>

    <div class="content-wrapper">

        <div class="container">

			<?php get_template_part('includes/breadcrumbs'); ?>
            
            <div class="content kb-wrapper">

			<?php if($kbnav) { ?>
            
                <nav class="kb-nav-wrapper">
					<div class="catcher"></div>
    
                	<?php echo $kbnav; ?>
                    
                    <div class="catcher"></div> 
                </nav>

				<section class="kb-content">
                
					<?php if (have_posts()) : while (have_posts()) : the_post();
                        the_content();                   
    
                    endwhile; endif; wp_reset_query(); ?>
                    
                    <?php comments_template('', true); ?>  
                                   
                </section>
                
                <div class="clearboth"></div>
                
                
			<?php } else { ?>
            
                <?php if (have_posts()) : while (have_posts()) : the_post();
                    the_content();                   

                endwhile; endif; wp_reset_query(); ?>
                
                <?php comments_template('', true); ?>                 
            
            <?php } ?>
        
            </div><!-- end of content -->
            
        </div><!-- end of .container -->
        
    </div><!-- end of .content-wrapper -->


	<!-- footer bar -->
	<?php get_template_part('includes/ftop_bar'); ?>

</section>

<?php get_footer(); ?>