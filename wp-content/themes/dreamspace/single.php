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

				<?php
                
                if (have_posts()) : while (have_posts()) : the_post(); ?>

            	<article class="entry-block entry-block-single">
            
					<?php $posttype = get_post_format();
            
                    get_template_part( 'includes/blog/'.$posttype );
                
                    if($posttype == '') { get_template_part( 'includes/blog/standard' ); } ?>                      
                    
                </article>
                
                <?php endwhile; endif; wp_reset_query(); ?>
            	
                <?php edit_post_link(__('edit post', 'framework'), '<div class="gw-edit"><i class="fa fa-pencil"></i>', '</div>'); ?>
            
            	<!-- if enabled, display social media bar -->
            	<?php if($goldenworks['bsocial-icons'] == '1') { get_template_part( 'includes/socialmedia' ); } ?>
                
                <?php get_template_part( 'includes/author_biography' ); ?>
                
				
	            <!-- comments section -->
				<?php comments_template('', true); ?> 
                        
            </div><!-- end of .inner-content -->
            
        
            <?php if($goldenworks['sidebar-position'] == 'right') { get_sidebar(); } ?>
            
        </div><!-- end of .container -->
        
    </div><!-- end of .content-wrapper -->

</section>


<?php get_footer(); ?>