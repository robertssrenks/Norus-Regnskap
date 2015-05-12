<?php 
if(is_tag()){ 
	echo __('<i class="fa fa-file-text-o"></i> Tag: ', 'framework').single_tag_title('',FALSE); 
}

elseif(is_year()){ 
	echo __('<i class="fa fa-file-text-o"></i> Posts in: ', 'framework').get_the_time('Y'); 
}
	
elseif(is_month()){
	$gw_month = get_the_time('F');
	echo __('<i class="fa fa-file-text-o"></i> Posts in: ', 'framework').$gw_month;
}

elseif(is_day() || is_time()){ 
	$gw_year = get_the_time('Y');
	$gw_month = get_the_time('m');
	$gw_month_display = get_the_time('F');
	
	echo __('<i class="fa fa-file-text-o"></i> Posts in: ', 'framework').$gw_month_display.' '.$gw_year;
}

elseif(is_author()){
	global $post;
	$author_id=$post->post_author;
	
	_e('<i class="fa fa-file-text-o"></i> Posts by: ','framework').the_author_meta( 'user_login', $author_id );
}
elseif(is_search()){
	global $post;
	$author_id=$post->post_author;
	
	_e('<i class="fa fa-file-text-o"></i> Search results for: ','framework').the_search_query();
}

else {/* we are displaying categories */
	_e('<i class="fa fa-file-text-o"></i> Posts under: ','framework').single_cat_title();
}

?>