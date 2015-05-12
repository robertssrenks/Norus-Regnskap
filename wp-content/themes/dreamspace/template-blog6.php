<?php 
/*
Template Name: Blog template 6
*/

/* Portrait blog */

get_header();

get_template_part('intslider');

$footerbar = get_post_meta($post->ID, 'footerbar', true);

if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} else if ( get_query_var('page') ) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

$pag_blog6 = $goldenworks['pag_blog6'];

$gw_cat6 = get_post_meta($post->ID, 'mycat', true);

$gw_cat6_id = get_tag_id_by_slug($gw_cat6);

if(!$pag_blog6) { $pag_blog6 = 6; }

$blogcontent = get_post_meta($post->ID, 'mycontent', true);
$blogcontent_data = do_shortcode( $blogcontent );

/* query arguments */
$args_blog6 = array(
		"cat" => $gw_cat6_id,	
		"paged" => $paged,
		"posts_per_page" => $pag_blog6,
		'post_status' => 'publish'
		);
		
global $more;

?>

<section>

    <div class="content-wrapper">

        <div class="container">

			<?php get_template_part('includes/breadcrumbs'); ?>
            
            <?php if($blogcontent_data) { ?>
            <div class="blog-header">
            	<?php echo $blogcontent_data; ?>
            </div>
            <?php } ?>            
            
            <?php if($goldenworks['sidebar-position'] == 'left') { get_sidebar(); } ?>
            
            <!-- page content -->
            <div class="inner-content">
                
				<?php query_posts($args_blog6); 
                
				$blog_counter = 0;
				
                if (have_posts()) : while (have_posts()) : the_post();
                
					$more = 0; 

					$blog_counter ++;
					
					$posttype = get_post_format(); 

					?>
				
                    <!-- blog entry -->
                    <article class="entry-block bportrait-block">
                        
                        <?php 
                        /* for this kind of blog template, only standard posts are supported */
                        if($posttype =! '') {
                            get_template_part('includes/blog/portrait/standard');
                        } ?>
                        
                    </article>

            
					<?php wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=page %'); ?>
                    
                    <?php endwhile; endif; ?>
                

                    <div class="pagination-wrapper bportrait-pag">
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