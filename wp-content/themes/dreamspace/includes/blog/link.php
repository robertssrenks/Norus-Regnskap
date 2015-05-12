<?php 
$link = get_post_meta($post->ID, 'linkurl', true);
?>
<div class="post-link">
    <h3 id="post-<?php the_ID(); ?>"><a href="<?php echo esc_html($link); ?>"><?php the_title(); ?></a></h3>
    
    <span><?php echo "-".esc_html($link)."-"; ?></span>
    <span class="plink"></span>
</div>
