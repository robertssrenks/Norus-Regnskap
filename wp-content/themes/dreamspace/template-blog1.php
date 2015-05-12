<?php 
/*
Template Name: Blog template 1
*/

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

$pag_blog1 = $goldenworks['pag_blog1'];

$gw_cat1 = get_post_meta($post->ID, 'mycat', true);

$gw_cat1_id = get_tag_id_by_slug($gw_cat1);

if(!$pag_blog1) { $pag_blog1 = 6; }

$blogcontent = get_post_meta($post->ID, 'mycontent', true);
$blogcontent_data = do_shortcode( $blogcontent );

/* query arguments */
$args_blog1 = array(
		"cat" => $gw_cat1_id,	
		"paged" => $paged,
		"posts_per_page" => $pag_blog1,
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

				<?php query_posts($args_blog1); 
                
                if (have_posts()) : while (have_posts()) : the_post(); 
                
                $more = 0; ?>

	            <!-- blog entry -->
            	<article class="entry-block">
            
					<?php $posttype = get_post_format();

                    get_template_part( 'includes/blog/'.$posttype );
                
                    if($posttype == '') { get_template_part( 'includes/blog/standard' ); } ?>                      
                    
                </article>
            
				<?php wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=page %'); ?>
                
                <?php endwhile; endif; ?>
                
        
                <div class="pagination-wrapper">
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