<?php
/**
 * BlogCategWidget Class
 */
class BlogCategWidget extends WP_Widget {
    /** constructor */
    function BlogCategWidget() {
		$widget_ops = array('classname' => 'widget_gw_categories', 'description' => __('Displays your categories from a parent category of your choice.','framework') );
		$this->WP_Widget('gw-blogcateg', __('GW Custom Categories', 'framework'), $widget_ops);		
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );

		$title = $instance['title'];
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Latest tweets', 'framework') : $instance['title'], $instance, $this->id_base);
		
		$categ_parent = $instance['parent_category'];
		
		$categ_parent_id = get_cat_id(htmlentities($categ_parent));  
				
		echo $before_widget; ?>

	    <?php echo $before_title . $title . $after_title; ?>

		<?php
		$categ_args = array(
			'child_of'           => $categ_parent_id,
			'title_li'			=> '',
			'show_option_none'   => __('<p class="textwidget">No child categories that belong to the parent category you\'ve selected were found.</p>', 'framework')
		); ?>
    
    
		<ul>
			<?php wp_list_categories($categ_args); ?>
        </ul>
    
            <?php echo $after_widget; ?>
            
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {		
        $instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);		
		$instance['parent_category'] = strip_tags($new_instance['parent_category']);	
						
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
	
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'framework'); ?> 
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            
		<p><label for="<?php echo $this->get_field_id('parent_category'); ?>"><?php _e('Pull your child categories from:', 'framework') ?></label>
        
        <select class="widefat" name="<?php echo $this->get_field_name('parent_category'); ?>">                       

				<?php
				$all_categories = get_categories('orderby=name'); 	
                foreach($all_categories as $category)
                {
                    if($instance['parent_category'] == $category->cat_name){		
                        
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

} // class BlogCategWidget

// register BlogCategWidget
//add_action('widgets_init', create_function('', 'return register_widget("BlogCategWidget");'));	
?>