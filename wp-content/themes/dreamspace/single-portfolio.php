<?php 

get_header();

get_template_part('intslider');	            
		
$portsb = get_post_meta($post->ID, "portsb", true);
$portrw = get_post_meta($post->ID, "portrw", true);

if(!$portsb) { $portsb = 1; }			


?>

<section>

    <div class="content-wrapper">

        <div class="container">

			<?php get_template_part('includes/breadcrumbs'); ?>
            
			
			<?php if($portsb == "1") { /* if we have sidebar */ ?>
            
				<?php if($goldenworks['sidebar-position'] == 'left') { get_sidebar(); } ?>
                
                <div class="inner-content">
    
                    <?php
                    
                    if (have_posts()) : while (have_posts()) : the_post(); ?>
    
                    <article class="entry-block-single">

                        <?php the_content(); ?>
                        
                    </article>
                    
                    <?php endwhile; endif; wp_reset_query(); ?>
                    
                    <?php edit_post_link(__('edit post', 'framework'), '<div class="gw-edit"><i class="fa fa-pencil"></i>', '</div>'); ?>
                    
       
                </div><!-- end of .inner-content -->
                
                <?php if($goldenworks['sidebar-position'] == 'right') { get_sidebar(); } ?>
            
			<?php } else { /* no sidebar */ ?>
            
                <div class="content">
    
                    <?php
                    
                    if (have_posts()) : while (have_posts()) : the_post(); ?>
    
                    <article class="entry-block-single">
                    
                        <?php the_content(); ?>
                        
                    </article>
                    
                    <?php endwhile; endif; wp_reset_query(); ?>
                    
                    <?php edit_post_link(__('edit post', 'framework'), '<div class="gw-edit"><i class="fa fa-pencil"></i>', '</div>'); ?>                    
                        
                </div><!-- end of .content -->            
            
            <?php } ?>
            

			<?php if($portrw == "1") {
                if($goldenworks['related-port'] == "1") {
                    get_template_part('includes/port_related_posts'); 	
                }
            }?>
            

            <!-- comments section -->
            <?php comments_template('', true); ?> 
                    

        </div><!-- end of .container -->
        
    </div><!-- end of .content-wrapper -->

</section>


<?php get_footer(); ?>