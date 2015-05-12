<?php 
/*
Template Name: Portfolio 4 columns grid
*/

get_header(); 

get_template_part('intslider');

if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} else if ( get_query_var('page') ) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

$pag_portfolio = $goldenworks['pag_port4g'];

/* get the portfolio category assigned via custom field */
$port_categ = get_post_meta($post->ID, 'portcat', true);

$port_categ_id = get_tag_id_by_slug($port_categ);


$portcontent = get_post_meta($post->ID, 'mycontent', true);
$portcontent_data = do_shortcode( $portcontent );

/* query arguments */
$args_port = array(
		"post_type" => "portfolio",
		"portfolio_category" => $port_categ,		
		"paged" => $paged,
		"posts_per_page" => $pag_portfolio,
		'post_status' => 'publish'
		);

global $more;
$more = 0;
?>


<section>

    <div class="content-wrapper">
    	
        <div class="container">
			
			<?php get_template_part('includes/breadcrumbs'); ?>            

            <?php if($portcontent_data) { ?>            
            <div class="port-header">
            	<?php echo $portcontent_data; ?>
            </div>
            <?php } ?>            

            
            <!-- portfolio filter -->
            <?php if ($goldenworks['p4colg-filter'] == 1) { ?> 
            <div class="portfolio-filter-wrapper pfw-4grid">
                <ul id="ifilter" class="portfolio-filter" data-option-key="filter">
                    <li><a href="#" data-filter="*" class="pselected"><?php _e('all', 'framework'); ?></a></li><?php
                    /* get the taxonomies while excluding the parent */
                    $categories = get_categories('title_li=&order=asc&hide_empty=0&taxonomy=portfolio_category&child_of='.$port_categ_id);
                    foreach($categories as $category)
                    {
                        echo '<li><a href="#" data-filter=".'.$category->category_nicename.'">'.$category->cat_name.'</a></li>';		
                    } ?>
                </ul>
            </div>
            <?php } ?>   
                    
            
            <!-- page content -->
            <div class="content pxd4-parent">

                <ul id="portfolio-container" class="portfolio-wrapper">
                
                    <?php query_posts($args_port);

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
					
                    /* create the category class for isotope filtering */
                    $sort_categories = get_the_terms( get_the_ID(), 'portfolio_category' );
                    $sclass = "";
                    
                    if(is_object($sort_categories) || is_array($sort_categories)) { 
                        foreach ($sort_categories as $cat)
                        {
                            $sclass .= $cat->slug.' '; 
                        }
                    } ?>
                
                    <!-- portfolio 1/4 column -->
                    <li class="pxd-4 portfolio-item <?php echo $sclass; ?>">
    
                        <!-- portfolio entry -->
                        <article class="entry-portfolio ep-grid">
                            
                            <?php if(has_post_thumbnail() ) { /* display post thumbnail if present */ ?>
                                <div class="port-viewer pv-grid">
                            
                                    <?php the_post_thumbnail('port-thumb'); ?>
                                    
                                    <div class="port-overlay">
                                    	

                                        <h4 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink(); ?>"><?php echo $short_title; ?></a></h4>
                                        <div class="ep-cat"><?php echo substr(custom_taxonomies_terms_links(), 0, -2); ?></div>                                        
                                    
                                    </div>                             
                                
                                </div>
                                     
                            <?php } ?>                            
                            
                            <div class="clipfix">&nbsp;</div>                            
                                         
                        </article>
                    
                    </li><!-- end of .pxd-4 -->

                
                <?php endwhile; endif; ?>
            
                </ul><!-- end of #portfolio-container -->
           
        
                <div class="pagination-wrapper pw-portgrid">
                    <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                        <?php next_posts_link(__('&larr; Older Entries', 'framework')) ?>
                        <?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?>
                    <?php } ?>
                </div>
                
                <?php wp_reset_query(); ?>         
            
            
            </div><!-- end of .content -->
            
          
        </div>    
    
    </div>

	<!-- footer bar -->
	<?php get_template_part('includes/ftop_bar'); ?>
    
</section>


<?php get_footer(); ?>