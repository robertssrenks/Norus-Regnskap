<?php 
/*
Template Name: Blog template 3
*/

/* masonry on 3 columns */

get_header();

get_template_part('intslider');

$footerbar = get_post_meta($post->ID, 'footerbar', true);

$page_title = get_post_meta($post->ID, 'mytitle', true);	
$page_desc = get_post_meta($post->ID, 'mydesc', true);	
$page_align = get_post_meta($post->ID, 'align', true);

if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} else if ( get_query_var('page') ) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

$pag_blog3 = $goldenworks['pag_blog3'];

$gw_cat3 = get_post_meta($post->ID, 'mycat', true);

$gw_cat3_id = get_tag_id_by_slug($gw_cat3);

if(!$pag_blog3) { $pag_blog3 = 6; }

/* query arguments */
$args_blog3 = array(
		"cat" => $gw_cat3_id,	
		"paged" => $paged,
		"posts_per_page" => $pag_blog3,
		'post_status' => 'publish'
		);
		
global $more;

?>

<section>

    <div class="content-wrapper">

        <div class="container">
			
			<?php get_template_part('includes/breadcrumbs'); ?>   
            
            <div class="blog-masonry">
            
	            <div class="gutter-sizer"></div>
                
                <?php query_posts($args_blog3);
                
                if (have_posts()) : while (have_posts()) : the_post(); 
                
                $more = 0; ?>

                <div class="xd-3 masonry-item">              

                    <article class="entry-block">
                
                        <?php $posttype = get_post_format();
                
                        get_template_part( 'includes/blog/'.$posttype );
                    
                        if($posttype == '') { get_template_part( 'includes/blog/standard' ); } ?>                      
                        
                    </article>

                </div>

                <?php wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=page %'); ?>
                
                <?php endwhile; endif; ?>
                
            </div><!-- end of .blog-masonry -->
    
    		<!-- posts pagination -->
            <div class="pagination-wrapper">
                <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                    <?php next_posts_link(__('&larr; Older Entries', 'framework')) ?>
                    <?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?>
                <?php } ?>
            </div>
            
            <?php wp_reset_query(); ?>

        </div><!-- end of .container -->   
    
    
    </div>

	<!-- footer bar -->
	<?php get_template_part('includes/ftop_bar'); ?>
    
</section>


<?php get_footer(); ?>