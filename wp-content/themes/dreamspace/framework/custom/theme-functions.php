<?php

/*-----------------------------------------------------------------------------------*/
/* Remove jump link */
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'remove_more_jump_link' ) ) {
	function remove_more_jump_link($link) {
		$offset = strpos($link, '#more-');
		if ($offset) {
			$end = strpos($link, '"',$offset);
		}
		if ($end) {
			$link = substr_replace($link, '', $offset, $end-$offset);
		}
		return $link;
	}
	add_filter('the_content_more_link', 'remove_more_jump_link');
}



/*-----------------------------------------------------------------------------------*/
/*	Configure Excerpt String
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'excerpt' ) ) {
	function excerpt($limit) {
	  $excerpt = explode(' ', get_the_excerpt(), $limit);
	  if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	  } else {
		$excerpt = implode(" ",$excerpt);
	  }	
	  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	  return $excerpt;
	}
}



/*-----------------------------------------------------------------------------------*/
/* Force tag cloud to use 11px font size */
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'tag_cloud_filter' ) ) {
	function tag_cloud_filter($args = array()) {
	   $args['smallest'] = 14;
	   $args['largest'] = 24;
	   $args['unit'] = 'px';
	   return $args;
	}
	
	add_filter('widget_tag_cloud_args', 'tag_cloud_filter', 90);
}



/*-----------------------------------------------------------------------------------*/
/* Gets tag id by name */
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'get_tag_id_by_slug' ) ) {
	function get_tag_id_by_slug($tag_name) {
		global $wpdb;
		$tag_ID = $wpdb->get_var("SELECT * FROM ".$wpdb->terms." WHERE `slug`  = '".$tag_name."'");
		
		return $tag_ID;
	}
}



/*-----------------------------------------------------------------------------------*/
/* Remove p and br tags from shortcodes
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'wpex_fix_shortcodes' ) ) {
	function wpex_fix_shortcodes($content){   
		$array = array (
			'<p>[' => '[', 
			']</p>' => ']', 
			']<br />' => ']'
		);
	
		$content = strtr($content, $array);
		return $content;
	}
	add_filter('the_content', 'wpex_fix_shortcodes');
}	



/*-----------------------------------------------------------------------------------*/
/* Custom Gravatar
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'gw_custom_gravatar' ) ) {
	function gw_custom_gravatar ($avatar_defaults) {
	$myavatar = get_template_directory_uri() . '/images/gravatar.png';
	
	
	$avatar_defaults[$myavatar] = __('Dreamspace Gravatar', 'framework');
	return $avatar_defaults;
	}
	add_filter( 'avatar_defaults', 'gw_custom_gravatar' );
}



/*-----------------------------------------------------------------------------------*/
/* Responsive image functions
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'remove_thumbnail_dimensions' ) ) {
	add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
	add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
	 
	function remove_thumbnail_dimensions( $html ) {
			$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
			return $html;
	}
}



/*-----------------------------------------------------------------------------------*/
/* Check if pagination exists
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'show_posts_nav' ) ) {
	function show_posts_nav() {
		global $wp_query;
		return ($wp_query->max_num_pages > 1);
	}
}



/*-----------------------------------------------------------------------------------*/
/* Get taxonomies terms links
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'custom_taxonomies_terms_links' ) ) {
	function custom_taxonomies_terms_links() {
		global $post, $post_id;
		// get post by post id
		$post = &get_post($post->ID);
		// get post type by post
		$post_type = $post->post_type;
		// get post type taxonomies
		$taxonomies = get_object_taxonomies($post_type);
		
		$out = '';
		
		foreach ($taxonomies as $taxonomy) {        
			$terms = get_the_terms( $post->ID, $taxonomy );
			if ( !empty( $terms ) ) {
				foreach ( $terms as $term )
					$out .= '<a href="' .get_term_link($term->slug, $taxonomy) .'">'.$term->name.'</a> , ';
			}
		}
		return $out;
	}
}



/*-----------------------------------------------------------------------------------*/
/* Remove category rel attribute
/*-----------------------------------------------------------------------------------*/
if ( !function_exists('gw_remove_catlist_rel') ) {
	function gw_remove_catlist_rel( $output ) {
		// Remove rel attribute from the category list
		return str_replace( ' rel="category tag"', '', $output );
	}
	 
	add_filter( 'wp_list_categories', 'gw_remove_catlist_rel' );
	add_filter( 'the_category', 'gw_remove_catlist_rel' );
}



/*-----------------------------------------------------------------------------------*/
/* Change the output of password protected posts and pages
/*-----------------------------------------------------------------------------------*/
if ( !function_exists('gw_password_form') ) {
	function gw_password_form() {
		global $post;
		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		$o = '<h4 class="password-protected-title">' . __( "This Page / Post is password protected. To view it please enter your password below:", "framework" ) . '</h4>
		<div class="pass-protected-icon"></div><form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post" class="pass-protected-form">
		<label for="' . $label . '">' . __( "Password", "framework" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" class="password-protected-input" /><input type="submit" name="Submit" value="' . esc_attr__( "Submit", "framework" ) . '" />
		</form>
		';
		return $o;
	}
	add_filter( 'the_password_form', 'gw_password_form' );
}



/*-----------------------------------------------------------------------------------*/
/* Ensure that the document title tag is created for wordpress versions older than 4.1
/*-----------------------------------------------------------------------------------*/	
if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function theme_slug_render_title() { ?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php }
    add_action( 'wp_head', 'theme_slug_render_title' );
endif;



/*-----------------------------------------------------------------------------------*/
/* Change the output of categories widget
/*-----------------------------------------------------------------------------------*/
if ( !function_exists('add_span_cat_count') ) {
	function add_span_cat_count($links) {
		$links = str_replace('</a> (', '</a> <span class="widget-count">(', $links);
		$links = str_replace(')', ')</span>', $links);
		return $links;
	}
	add_filter('wp_list_categories', 'add_span_cat_count');
}



/*-----------------------------------------------------------------------------------*/
/* Make the date format translatable for WPML
/*-----------------------------------------------------------------------------------*/
if ( !function_exists('add_span_cat_count') ) {
	function translate_date_format($format) {
		if (function_exists('icl_translate')) {
			$format = icl_translate('Formats', $format, $format);
		}
		return $format;
	}
	add_filter('option_date_format', 'translate_date_format');
}

?>