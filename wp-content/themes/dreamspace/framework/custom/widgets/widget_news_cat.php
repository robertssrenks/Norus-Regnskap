<?php
/**
 * NewsCategWidget Class
 */
class NewsCategWidget extends WP_Widget {
    /** constructor */
    function NewsCategWidget() {
		$widget_ops = array('classname' => 'widget_gw_categories', 'description' => __('Displays your news categories from a parent category of your choice.','framework') );
		$this->WP_Widget('gw-newscateg', __('GW Custom News Categories', 'framework'), $widget_ops);		
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );

		$title = $instance['title'];
		$title = apply_filters('widget_title', empty($instance['title']) ? __('News categories', 'framework') : $instance['title'], $instance, $this->id_base);
		
		
		$term_parent = $instance['parent_category'];

		/* get the term id if exists */
		$term_parent_id = term_exists( $term_parent );

						
		echo $before_widget; ?>

	    <?php echo $before_title . $title . $after_title; ?>
		
		<?php

			$taxonomy_name = 'news_category';
			$termchildren = get_term_children( $term_parent_id, $taxonomy_name );

			echo '<ul>';
			foreach ( $termchildren as $child ) {
				$term = get_term_by( 'id', $child, $taxonomy_name );
				
				if( $term->name == get_queried_object()->name ) {
				
					echo '<li class="current-cat"><a href="' . get_term_link( $child, $taxonomy_name ) . '">' . $term->name . '</a></li>';
				
				} else {
				
					echo '<li><a href="' . get_term_link( $child, $taxonomy_name ) . '">' . $term->name . '</a></li>';					
				
				}

			}
			echo '</ul>';
			
			
			?>
    
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
            
		<p><label for="<?php echo $this->get_field_id('parent_category'); ?>"><?php _e('Pull your child categories from:', 'framework'); ?></label>
        
        <select class="widefat" name="<?php echo $this->get_field_name('parent_category'); ?>">                       



				<?php
                //$terms = get_the_terms( $post->ID, 'news_category' );
				
				$terms = get_terms("news_category", 'orderby=name&order=ASC&hide_empty=0');
                 
                if ( $terms && ! is_wp_error( $terms ) ) : 
                
                    //$news_links = array();
                
                    foreach ( $terms as $term ) {
						
						if($instance['parent_category'] == $term->name){	
						
                        	//$news_links[] = $term->name;
							echo "<option value='".$term->name."' selected='selected'>".$term->name."</option>\n";	
						}
						else {
							echo "<option value='".$term->name."'>".$term->name."</option>\n";					
						}						
						
                    }

				endif; ?>  
                            
        </select>
        </p>                       
        <?php 
    }

} // class NewsCategWidget

// register NewsCategWidget
//add_action('widgets_init', create_function('', 'return register_widget("NewsCategWidget");'));	
?>