<?php 

/*###### PORTFOLIO CUSTOM POST ######*/

/* create the portfolio custom post */
function gw_custom_post_portfolio() {
	$labels = array(
		'name'               => _x( 'Portfolio', 'post type general name', 'framework' ),
		'singular_name'      => _x( 'Portfolio item', 'post type singular name', 'framework' ),
		'add_new'            => _x( 'Add New', 'post', 'framework' ),
		'add_new_item'       => __( 'Add New Post', 'framework' ),
		'edit_item'          => __( 'Edit Portfolio Post', 'framework' ),
		'new_item'           => __( 'New Post', 'framework' ),
		'all_items'          => __( 'All Portfolio posts', 'framework' ),
		'view_item'          => __( 'View portfolio post', 'framework' ),
		'search_items'       => __( 'Search portfolio', 'framework' ),
		'not_found'          => __( 'No portfolio posts found', 'framework' ),
		'not_found_in_trash' => __( 'No portfolio posts found in the Trash', 'framework' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Portfolio'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our portfolio specific data',
		'public'        => true,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
		'has_archive'   => true,
		'rewrite'		=> array('slug' => 'portfolio')	
	);
	register_post_type( 'portfolio', $args );
	
    flush_rewrite_rules();
}
add_action( 'init', 'gw_custom_post_portfolio' );




/* portfolio updated messages */
function gw_portfolio_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['portfolio'] = array(
		0 => '', 
		1 => sprintf( __('Portfolio post updated. <a href="%s">View portfolio post</a>', 'framework'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'framework'),
		3 => __('Custom field deleted.', 'framework'),
		4 => __('Portfolios updated.', 'framework'),
		5 => isset($_GET['revision']) ? sprintf( __('Portfolio post restored to revision from %s', 'framework'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Portfolio post published. <a href="%s">View portfolio post</a>', 'framework'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Portfolios saved.', 'framework'),
		8 => sprintf( __('Portfolio submitted. <a target="_blank" href="%s">Preview portfolio post</a>', 'framework'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Portfolio scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview portfolio post</a>', 'framework'), date_i18n( __( 'M j, Y @ G:i', 'framework' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Portfolio draft updated. <a target="_blank" href="%s">Preview portfolio post</a>', 'framework'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}
add_filter( 'post_updated_messages', 'gw_portfolio_updated_messages' );



/* register portfolio taxonomy */
function gw_taxonomies_portfolio() {
	$labels = array(
		'name'              => _x( 'Portfolio Categories', 'taxonomy general name', 'framework' ),
		'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name', 'framework' ),
		'search_items'      => __( 'Search Portfolio Categories', 'framework' ),
		'all_items'         => __( 'All Portfolio Categories', 'framework' ),
		'parent_item'       => __( 'Parent Portfolio Category', 'framework' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:', 'framework' ),
		'edit_item'         => __( 'Edit Portfolio Category', 'framework' ), 
		'update_item'       => __( 'Update Portfolio Category', 'framework' ),
		'add_new_item'      => __( 'Add New Portfolio Category', 'framework' ),
		'new_item_name'     => __( 'New Portfolio Category', 'framework' ),
		'menu_name'         => __( 'Portfolio Categories', 'framework' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'portfolio_category', 'portfolio', $args );
}
add_action( 'init', 'gw_taxonomies_portfolio', 0 );



/* here is a key-value array where the keys are used to reference certain post information */
function portfolio_edit_columns($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('Portfolio Title', 'framework'),
		"portfolio_desc" => __('Description', 'framework'),
		"portfolio_category" => __('Category', 'framework'),
		"portfolio_image" => __('Thumbnail', 'framework')						
	);
	return $columns;
}
add_filter("manage_edit-portfolio_columns", "portfolio_edit_columns");



/* columns displayed for portfolio custom post */
function portfolio_custom_columns($column){
	global $post;
	switch ($column)
	{
		case "portfolio_desc":
			echo excerpt('25');
			break;
		case "portfolio_category":
			echo get_the_term_list($post->ID, 'portfolio_category', '', ', ','');
			break;  
		case "portfolio_image":
			$custom = get_post_custom();
			the_post_thumbnail('thumb-admin');
			break;														
	}
}
add_action("manage_posts_custom_column",  "portfolio_custom_columns");




/* define the portfolio meta box */
add_action( 'add_meta_boxes', 'portfolio_meta_box' );
function portfolio_meta_box() {
    add_meta_box( 
        'portfolio_meta_box',
        __( 'Portfolio post options', 'framework' ),
        'portfolio_meta_box_content',
        'portfolio',
        'advanced',
        'low'
    );
}



/* create the meta box contents */
function portfolio_meta_box_content( $post ) {
	wp_nonce_field( plugin_basename( __FILE__ ), 'portfolio_meta_box_content_nonce' );
	
	$custom = get_post_custom($post->ID);

	$video_link = '';
	$portsb = '';	
	$portrw = '';	
	
	if (isset($custom["video_link"][0])) { 
		$video_link = $custom["video_link"][0]; 
	}
	
	if (isset($custom["portsb"][0])) { 
		$portsb = $custom["portsb"][0]; 
	}
	
	if (isset($custom["portrw"][0])) { 
		$portrw = $custom["portrw"][0]; 
	} else {
		$portrw = 1; 		
	}		
	?>
	
	<style type="text/css">
	.gw-customlist {
		list-style:none;
		margin:0;
		padding:0;	
	}
	.gw-customlist li {
		display:block;
		width:100%;
		margin:0 0 4px 0;	
	}
	.gw-input-large {
		position:relative;
		top:2px;
		left:2px;
		width:56%;
	}
	.gw-customradio {
		position:relative;
		top:2px;
	}
	@media only screen and (max-width: 800px) {
		.gw-input-large {
			width:80%;
		}		
	}
	@media only screen and (max-width: 480px) {
		.gw-input-large {
			width:100%;
			left:0;			
		}				
	}
    </style>
  	
  <ul class="gw-customlist">
  	<li>
		<label for="video_link"><?php _e('Porfolio video link', 'framework') ?></label>
		<input type="text" id="video_link" name="video_link" class="gw-input-large" value="<?php echo $video_link; ?>" />
    </li>
    
    <li><p><?php _e('Do you wish to have sidebar in this post detail ?', 'framework'); ?></p></li>
    <li><input type="radio" id="portsb_1" name="portsb"  value="1" <?php if ($portsb == 1) echo 'checked';?> class="gw-customradio" /><label for="portsb_1"><?php _e('Yes', 'framework') ?></label></li>
    <li><input type="radio" id="portsb_2" name="portsb"  value="2" <?php if ($portsb == 2) echo 'checked';?> class="gw-customradio" /><label for="portsb_2"><?php _e('No', 'framework') ?></label></li>  
      
    <li><p><?php _e('Do you wish to display related works on this particular post ?', 'framework'); ?></p></li>
    <li><input type="radio" id="portrw_1" name="portrw"  value="1" <?php if ($portrw == 1) echo 'checked';?> class="gw-customradio" /><label for="portrw_1"><?php _e('Yes', 'framework') ?></label></li>
    <li><input type="radio" id="portrw_2" name="portrw"  value="2" <?php if ($portrw == 2) echo 'checked';?> class="gw-customradio" /><label for="portrw_2"><?php _e('No', 'framework') ?></label></li>  
            
    
  </ul>
    <?php
}


/* save meta data */
add_action( 'save_post', 'portfolio_meta_box_save' );

function portfolio_meta_box_save() {
	global $post;

	if(isset($_POST["video_link"]))
	update_post_meta($post->ID, "video_link", $_POST["video_link"]);  

	if(isset($_POST["portsb"]))
	update_post_meta($post->ID, "portsb", $_POST["portsb"]);
	
	if(isset($_POST["portrw"]))
	update_post_meta($post->ID, "portrw", $_POST["portrw"]); 	  
}


?>