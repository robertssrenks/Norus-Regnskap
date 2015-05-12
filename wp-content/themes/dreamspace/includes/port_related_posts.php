<?php

$similar_works = get_the_terms( get_the_ID(), 'portfolio_category' );	
$simwfinal = "";

if(is_object($similar_works) || is_array($similar_works))
{
	foreach ($similar_works as $simw)
	{
		$simwfinal .= $simw->slug.', ';
	}
}					 
 
global $wp_query;
$thePostID = $wp_query->post->ID;
				

$args_port_related = array(
		"portfolio_category" => $simwfinal,
		"post__not_in" => array($thePostID),
		"posts_per_page" => 4		
		);
		
		
?>
<div class="clearboth"></div>

<!-- Related posts section -->
<div class="related-wrapper">

	<h4 class="related-title"><?php _e('Related works', 'framework'); ?></h4>

    
    <div class="content pxd4-parent">

        <ul id="portfolio-container" class="portfolio-wrapper">
        
            <?php query_posts($args_port_related);

            if (have_posts()) : while (have_posts()) : the_post(); 
            
            $portfolio_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'port-thumb');
            
            /* get video link */
            $video_link = get_post_meta($post->ID, "video_link", true);
            
            /* shorten title */
            $short_title = '';
            if (strlen(get_the_title()) > 28) { 
                $short_title = substr(get_the_title(), 0, 28) . '...'; 
            } else { 
                $short_title = get_the_title(); 
            }
            
            ?>
        
            <!-- portfolio 1/4 column -->
            <li class="pxd-4 portfolio-item">

                <!-- portfolio entry -->
                <article class="entry-portfolio ep-grid">
                    
                    <?php if(has_post_thumbnail() ) { /* display post thumbnail if present */ ?>
                        <div class="port-viewer pv-grid">
                    
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
            
            </li><!-- end of .pxd-4 -->

        
        <?php endwhile; endif; wp_reset_query(); ?>
    
        </ul><!-- end of #portfolio-container -->
   
    </div><!-- end of .content .pxd4-parent -->

</div><!-- end of .related-wrapper -->