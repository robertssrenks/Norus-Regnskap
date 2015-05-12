<?php 

/*###### NEWS CUSTOM POST ######*/

/* create the news custom post */
function gw_custom_post_news() {
	$labels = array(
		'name'               => _x( 'News', 'post type general name', 'framework' ),
		'singular_name'      => _x( 'News item', 'post type singular name', 'framework' ),
		'add_new'            => _x( 'Add New', 'post', 'framework' ),
		'add_new_item'       => __( 'Add New Post', 'framework' ),
		'edit_item'          => __( 'Edit News Post', 'framework' ),
		'new_item'           => __( 'New Post', 'framework' ),
		'all_items'          => __( 'All News', 'framework' ),
		'view_item'          => __( 'View news post', 'framework' ),
		'search_items'       => __( 'Search news', 'framework' ),
		'not_found'          => __( 'No news posts found', 'framework' ),
		'not_found_in_trash' => __( 'No news posts found in the Trash', 'framework' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'News'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our news specific data',
		'public'        => true,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
		'rewrite'		=> array('slug' => 'news')	
	);
	register_post_type( 'news', $args );
	
    flush_rewrite_rules();
}
add_action( 'init', 'gw_custom_post_news' );




/* news updated messages */
function gw_news_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['news'] = array(
		0 => '', 
		1 => sprintf( __('News post updated. <a href="%s">View news post</a>', 'framework'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'framework'),
		3 => __('Custom field deleted.', 'framework'),
		4 => __('News updated.', 'framework'),
		5 => isset($_GET['revision']) ? sprintf( __('News post restored to revision from %s', 'framework'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('News post published. <a href="%s">View news post</a>', 'framework'), esc_url( get_permalink($post_ID) ) ),
		7 => __('News saved.', 'framework'),
		8 => sprintf( __('News submitted. <a target="_blank" href="%s">Preview news post</a>', 'framework'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('News scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview news post</a>', 'framework'), date_i18n( __( 'M j, Y @ G:i', 'framework' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('News draft updated. <a target="_blank" href="%s">Preview news post</a>', 'framework'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}
add_filter( 'post_updated_messages', 'gw_news_updated_messages' );



/* register news taxonomy */
function gw_taxonomies_news() {
	$labels = array(
		'name'              => _x( 'News Categories', 'taxonomy general name', 'framework' ),
		'singular_name'     => _x( 'News Category', 'taxonomy singular name', 'framework' ),
		'search_items'      => __( 'Search News Categories', 'framework' ),
		'all_items'         => __( 'All News Categories', 'framework' ),
		'parent_item'       => __( 'Parent News Category', 'framework' ),
		'parent_item_colon' => __( 'Parent News Category:', 'framework' ),
		'edit_item'         => __( 'Edit News Category', 'framework' ), 
		'update_item'       => __( 'Update News Category', 'framework' ),
		'add_new_item'      => __( 'Add New News Category', 'framework' ),
		'new_item_name'     => __( 'New News Category', 'framework' ),
		'menu_name'         => __( 'News Categories', 'framework' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'news_category', 'news', $args );
}
add_action( 'init', 'gw_taxonomies_news', 0 );



/* here is a key-value array where the keys are used to reference certain post information */
function news_edit_columns($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('News Title', 'framework'),
		"news_desc" => __('Description', 'framework'),
		"news_category" => __('Category', 'framework'),
		"news_image" => __('Thumbnail', 'framework')						
	);
	return $columns;
}
add_filter("manage_edit-news_columns", "news_edit_columns");



/* columns displayed for news custom post */
function news_custom_columns($column){
	global $post;
	switch ($column)
	{
		case "news_desc":
			the_excerpt();
			break;
		case "news_category":
			echo get_the_term_list($post->ID, 'news_category', '', ', ','');
			break;  
		case "news_image":
			$custom = get_post_custom();
			the_post_thumbnail('thumb-admin');
			break;														
	}
}
add_action("manage_posts_custom_column",  "news_custom_columns");


?>