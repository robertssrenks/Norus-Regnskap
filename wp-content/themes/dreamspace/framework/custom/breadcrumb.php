<?php
class gw_breadcrumb {
	var $options;
	
function gw_breadcrumb(){
	
	$this->options = array(
	'before' => '<span class="breadcrumb-separator">',
	'after' => ' </span>',
	'delimiter' => '&#xf105;'
	);
	
	$markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
	
	global $post;
	
	echo '<div class="breadcrumbs">';
		if(!is_front_page()){
			echo '<a href="'.home_url().'">';
			_e('Home', 'framework');
			echo "</a>";
			echo $markup;					
		}
		
		$output = $this->standard_breadcrumb($post);

		if(!is_front_page()){
			if (is_page() || is_single()){
				the_title();
			} else {
				echo $output;
			}
		}
		
		echo "</div>";
	}

function standard_breadcrumb($the_post){
	$markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
	if (is_page()){
		 if($the_post->post_parent) { 
			 $my_query = get_post($the_post->post_parent);			 
			 $this->standard_breadcrumb($my_query);
			 $link = '<a href="';
			 $link .= get_permalink($my_query->ID);
			 $link .= '">';
			 $link .= ''. get_the_title($my_query->ID) . '</a>'. $markup;
			 echo $link;
		  }	
	return;	 	
	} 
	
				
			
	if(is_single()){
		$category = get_the_category();
		if (is_attachment()){
		
			$my_query = get_post($the_post->post_parent);			 
			$category = get_the_category($my_query->ID);
			$ID = $category[0]->cat_ID;

			echo get_category_parents($ID, TRUE, $markup, FALSE );
			previous_post_link("%link $markup");

		}else{

			$customPost = get_post_type();
			
			if($customPost == 'post')
			{
				
				$ID = $category[0]->cat_ID;
				echo get_category_parents($ID, TRUE, $markup, FALSE );

			}
			
			if($customPost == 'portfolio')
			{	
				global $post;
							
				$terms = get_the_term_list( $post->ID, 'portfolio_category', '', '*%*', '' );
				$terms = explode('*%*',$terms);
				echo $terms[0].$markup;
			}
			else if($customPost == 'news')
			{
				global $post;		
				
				$terms = get_the_term_list( $post->ID, 'news_category', '', '*%*', '' );
				$terms = explode('*%*',$terms);
				echo $terms[0].$markup;
			}						
		}
	return;
	}
	
	if(is_tax()){
		  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		  return $term->name;

	}
	
	if(is_category()){
		$category = get_the_category(); 
		$i = $category[0]->cat_ID;
		$parent = $category[0]-> category_parent;
								
		if($parent > 0 && $category[0]->cat_name == single_cat_title("", false)){
			echo get_category_parents($parent, TRUE, $markup, FALSE);
		}
	
	
	return single_cat_title('',FALSE);
	}
	
	
	if(is_author()){
		
		global $post;
		return _e('Author: ', 'framework').the_author_meta('user_login', $post->post_author);
		
	}
	if(is_tag()){ return __('Tag: ', 'framework').single_tag_title('',FALSE); }
	
	if(is_404()){ return __('404 - Page not Found', 'framework'); }
	
	if(is_search()){ return __('Search results', 'framework'); }	
	
	if(is_year()){ return get_the_time('Y'); }
	
	if(is_month()){
	$gw_year = get_the_time('Y');
	echo "<a href='".get_year_link($gw_year)."'>".$gw_year."</a>".$markup;
	return get_the_time('F'); }
	
	if(is_day() || is_time()){ 
	$gw_year = get_the_time('Y');
	$gw_month = get_the_time('m');
	$gw_month_display = get_the_time('F');
	echo "<a href='".get_year_link($gw_year)."'>".$gw_year."</a>".$markup;
	echo "<a href='".get_month_link($gw_year, $gw_month)."'>".$gw_month_display."</a>".$markup;

	return get_the_time('jS (l)'); }
	
	}

}

?>