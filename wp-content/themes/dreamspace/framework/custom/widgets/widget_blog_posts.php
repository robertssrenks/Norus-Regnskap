<?php
/**
 * BlogWidget Class
 */
class BlogWidget extends WP_Widget {
    /** constructor */
    function BlogWidget() {
		$widget_ops = array('classname' => 'widget_gw_posts', 'description' => __('Displays your latest posts by a certain category.','framework') );
		$this->WP_Widget('gw-blog', __('GW Latest posts', 'framework'), $widget_ops);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
		
		$title = $instance['title'];		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Latest blog posts', 'framework') : $instance['title'], $instance, $this->id_base);
		
		echo $before_widget; ?>
        
	  <?php echo $before_title
          . $title
          . $after_title; 
			
		
			if ( !$number = (int) $instance['number'] )
				$number = 3;
			else if ( $number < 1 )
				$number = 1;
			else if ( $number > 9 )
				$number = 9;
			
			
			/* get the current category */
			$gw_all_categ = $instance['all_categ']; 
			
			$gw_all_categ_id = get_cat_id(htmlentities($gw_all_categ)); 
			
			/* get the current translated category id, if WPML is in use  */
			if(function_exists('icl_object_id')) {
				$gw_all_categ_trans = icl_object_id($gw_all_categ_id, 'category', true);
			} else {
				$gw_all_categ_trans = $gw_all_categ_id;
			}
			
			
			/* query arguments for latest posts */
			$args_posts = array(
				"cat" => $gw_all_categ_trans,
				"showposts" => $number
				);
			?>



	        <ul class="ln-list">
                <?php query_posts($args_posts);
                    if (have_posts()) : while (have_posts()) : the_post();
                ?>
                <li>
                	<?php if(has_post_thumbnail()) { /* post image */?>
                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="wpost-image">
                            <?php the_post_thumbnail('post-small'); ?>
                        </a>        
                    <?php } else { ?>
                    	<a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>" class="wpost-image no-img"></a>
                    <?php } ?>
                                 
                                                                
                    <div class="wpost-content">            
                                       
                        <h5><a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
                        <div class="ln-date"><?php the_time('F jS, Y'); ?></div>
                    </div>
                
               
                </li>
    
                <?php endwhile; else: ?>
                <li>
                    <h6><?php __('Nothing Found', 'framework'); ?></h6>
                    <p><?php __('Sorry, no posts matched your criteria.', 'framework'); ?></p>
                </li>

            <!--do not delete-->
            <?php endif; wp_reset_query(); ?>  
            </ul>       
            
            <?php echo $after_widget; ?>
            
        <?php
    }

    /** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
	
		// Strip tags to remove HTML (important for text inputs)
		$instance['title'] = strip_tags( $new_instance['title'] );		
		$instance['all_categ'] = strip_tags($new_instance['all_categ']);
		$instance['latestposts_rss'] = strip_tags($new_instance['latestposts_rss']);
		$instance['number'] = $new_instance['number'];
			
		return $instance;
	}
	
    /** @see WP_Widget::form */
    function form($instance) {				
        
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
				
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 3;		
        ?>		

            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'framework'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:', 'framework') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>        
                        
            <p><label for="<?php echo $this->get_field_id('all_categ'); ?>"><?php _e('Categories:', 'framework') ?></label>
            
            <select class="widefat" name="<?php echo $this->get_field_name('all_categ'); ?>">
				<?php
				$all_categories = get_categories('orderby=name'); 	
                foreach($all_categories as $category)
                {
                    if($instance['all_categ'] == $category->cat_name){		
                        
                        echo "<option value='".$category->cat_name."' selected='selected'>".$category->cat_name."</option>\n";
                    }
                    else {
                        echo "<option value='".$category->cat_name."'>".$category->cat_name."</option>\n";					
                    }
                }
                ?>                 
            </select>
            
            </p>  
                           
        <?php 
    }

} // class BlogWidget

// register BlogWidget
//add_action('widgets_init', create_function('', 'return register_widget("BlogWidget");'));	
?>