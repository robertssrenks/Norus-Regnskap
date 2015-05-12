<?php 
/*
Template Name: News template
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

$pag_news = $goldenworks['pag_news'];

/* get the news category assiged via custom field */
$news_categ = get_post_meta($post->ID, 'newscat', true);

$newscontent = get_post_meta($post->ID, 'mycontent', true);
$newscontent_data = do_shortcode( $newscontent );

/* query arguments */
$args_news = array(
		"post_type" => "news",
		"news_category" => $news_categ,
		"paged" => $paged,
		"posts_per_page" => $pag_news,
		'post_status' => 'publish'
		);

global $more;
$more = 0;
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
            
            <!-- page content -->
            <div class="inner-content">
            	
                <div class="news-wrapper">
                        
					<?php query_posts($args_news);
                    
                    if (have_posts()) : while (have_posts()) : the_post(); ?>
    
                    <!-- news entry -->
                    <article class="entry-news">
                
                        <!-- date box -->
                        <div class="date-news">
                            <span class="dn-big"><?php the_time('j'); ?></span>
                            
                            <span class="dn-small"><?php the_time('M Y'); ?></span>
                        </div>
                        
                        <!-- title and categories -->                    
                        <div class="entry-news-title">
                            <h4 id="post-<?php the_ID(); ?>" <?php post_class('news-title'); ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <div class="en-cat"><i class="fa fa-file-text-o"></i><?php _e('posted under ', 'framework'); echo substr(custom_taxonomies_terms_links(), 0, -2); ?></div>
                        </div>
                                                                
                    </article>
                    
                    <?php endwhile; endif; ?>
                
                </div><!-- end of .news-wrapper --> 
                
        
                <div class="pagination-wrapper pw-news">
                    <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                        <?php next_posts_link(__('&larr; Older Entries', 'framework')) ?>
                        <?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?>
                    <?php } ?>
                </div>
                
                <?php wp_reset_query(); ?>         
            
            
            </div><!-- end of .inner-content -->
            
            <?php if($goldenworks['sidebar-position'] == 'right') { get_sidebar(); } ?>            
            
        </div>    
    
    </div>

	<!-- footer bar -->
	<?php get_template_part('includes/ftop_bar'); ?>
    
</section>



<?php get_footer(); ?>