<?php 
/*
Template Name: Blog template 5
*/

/* Blog with date over image */

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

$pag_blog5 = $goldenworks['pag_blog5'];

$gw_cat5 = get_post_meta($post->ID, 'mycat', true);

$gw_cat5_id = get_tag_id_by_slug($gw_cat5);

if(!$pag_blog5) { $pag_blog5 = 6; }

/* query arguments */
$args_blog5 = array(
		"cat" => $gw_cat5_id,	
		"paged" => $paged,
		"posts_per_page" => $pag_blog5,
		'post_status' => 'publish'
		);
		
global $more;

?>

<section>

    <div class="content-wrapper">

        <div class="container">

			<?php get_template_part('includes/breadcrumbs'); ?>
            
            <?php if($goldenworks['sidebar-position'] == 'left') { get_sidebar(); } ?>
            
            <!-- page content -->
            <div class="inner-content">
                
                <div class="row">
                
				<?php query_posts($args_blog5); 
                
				$blog_counter = 0;
				
                if (have_posts()) : while (have_posts()) : the_post(); 
                
					$more = 0; 

					$blog_counter ++;
					
					$posttype = get_post_format(); 

					?>
				
                	<div class="col-md-6">
                
                        <!-- blog entry -->
                        <article class="entry-block bcolumn-block">
                    		
                            <?php 
                            /* for this kind of blog template, only standard posts are supported */
                            if($posttype =! '') {
                                get_template_part('includes/blog/columns/standard');
                            } ?>
                            
                        </article>
            
		            </div><!-- end of .col-md-6 -->
                    
					<?php if(($blog_counter % 2) == 0) { ?>
                		<div class="clearboth"></div>
                    <?php } ?>
                
            
					<?php wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=page %'); ?>
                    
                    <?php endwhile; endif; ?>
                
                
            	</div><!-- end of .row -->
                
                
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