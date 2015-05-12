<?php 

get_header(); 

get_template_part('intslider');

?>

<section>

    <div class="content-wrapper">
    	
        <div class="container">
			
			<?php get_template_part('includes/breadcrumbs'); ?>                       

            <div class="archive-title"><?php get_template_part('includes/archive_title'); ?></div>
            
            
            <!-- page content -->
            <div class="content pxd3-parent">

                <ul id="portfolio-container" class="portfolio-wrapper">
                
                    <?php

                    if (have_posts()) : while (have_posts()) : the_post(); 
                    
                    $portfolio_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'port-thumb');
					
					/* get video link */
		            $video_link = get_post_meta($post->ID, "video_link", true);
                    
                    /* create the category class for isotope filtering */
                    $sort_categories = get_the_terms( get_the_ID(), 'portfolio_category' );
                    $sclass = "";
                    
                    if(is_object($sort_categories) || is_array($sort_categories)) { 
                        foreach ($sort_categories as $cat)
                        {
                            $sclass .= $cat->slug.' '; 
                        }
                    } ?>
                
                    <!-- portfolio 1/3 column -->
                    <li class="pxd-3 portfolio-item <?php echo $sclass; ?>">
    
                        <!-- portfolio entry -->
                        <article class="entry-portfolio">
                            
                            <?php if(has_post_thumbnail() ) { /* display post thumbnail if present */ ?>
                                <div class="port-viewer">
                            
                                    <?php the_post_thumbnail('port-thumb'); ?>
                                    
                                    <div class="port-mask pm-align">
                                        
                                        <div class="port-buttons">
                                        <?php if($video_link) { ?>
                                            <div class="port-zoom"><a href="<?php echo $video_link; ?>" class="magnific-popup mfp-iframe"><i class="fa fa-play"></i></a></div>
                                        <?php } else { ?>
                                            <div class="port-zoom"><a href="<?php echo $portfolio_thumb[0]; ?>" class="magnific-popup"><i class="fa fa-plus"></i></a></div>
                                        <?php } ?>
                                            <div class="port-link"><a href="<?php echo the_permalink(); ?>"><i class="fa fa-arrow-right"></i></a></div>                                        
                                        </div>
                                    </div>                                
                                
                                </div>
                                
                                <div class="clearboth"></div>       
                            <?php } ?>                            
                            
                            
                            <!-- title and categories -->   
                            <?php if( function_exists('zilla_likes') ) { ?>
                                     
                            <div class="entry-port-title">
                                <h4 id="post-<?php the_ID(); ?>" <?php post_class('news-title'); ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <div class="ep-cat"><?php echo substr(custom_taxonomies_terms_links(), 0, -2); ?></div>
                            </div>
                            <div class="port-zilla"><?php zilla_likes(); ?></div>
                            
                            <?php } else { ?>
                            
                            <div class="entry-port-title ept-full">
                                <h4 id="post-<?php the_ID(); ?>" <?php post_class('news-title'); ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <div class="ep-cat"><?php echo substr(custom_taxonomies_terms_links(), 0, -2); ?></div>
                            </div>
                                                        
                            <?php } ?>
                                                                    
                        </article>
                    
                    </li><!-- end of .pxd-3 -->

                
                <?php endwhile; endif; ?>

                </ul><!-- end of #portfolio-container -->
           
        
                <div class="pagination-wrapper pw-port3col">
                    <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                        <?php next_posts_link(__('&larr; Older Entries', 'framework')) ?>
                        <?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?>
                    <?php } ?>
                </div>
                
                <?php wp_reset_query(); ?>         
            
            
            </div><!-- end of .content -->
            
          
        </div>    
    
    </div>
    
</section>


<?php get_footer(); ?>