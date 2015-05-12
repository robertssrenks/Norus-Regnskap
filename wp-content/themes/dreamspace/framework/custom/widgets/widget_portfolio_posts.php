<?php
/**
 * PortfolioWidget Class
 */
class PortfolioWidget extends WP_Widget {
    /** constructor */
    function PortfolioWidget() {
		$widget_ops = array('classname' => 'widget_gw_port', 'description' => __('Displays your latest portfolio entries from the portfolio section of your choice','framework') );
		$this->WP_Widget('gw-portfolio-widget', __('GW Portfolio', 'framework'), $widget_ops);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
		
		$title = $instance['title'];		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Latest from portfolio', 'framework') : $instance['title'], $instance, $this->id_base);
		
		if ( !$number = (int) $instance['number'] )
			$number = 8;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 16 )
			$number = 16;
					
		$port_link = $instance['port_link'];
							
		echo $before_widget; ?>
        
	  <?php echo $before_title
          . $instance['title']
          . $after_title; 

			
			$args_port = array(
					"post_type" => "portfolio",
					"showposts" => $number,					
					"post_status" => "publish"
					);
			?>
                <ul class="wgport-list"> 
				<?php query_posts($args_port);
                    if (have_posts()) : while (have_posts()) : the_post(); ?>
                    
                    <li>    
						<?php if(has_post_thumbnail()) { /* post image */?>
                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('port-thumb-widget'); ?>
                        </a>
                    	<?php } ?>   
                    </li>
        
                    <?php endwhile; else: ?>
                    <li>
                        <p class="textwidget"><?php _e('Sorry, no posts matched your criteria.', 'framework') ?></p>
                    </li>
    
                <!--do not delete-->
                <?php endif; wp_reset_query(); ?>
                
                </ul>  
                
                <?php if ($port_link) { ?>
                	<a href="<?php echo $port_link; ?>" title="<?php _e('view more works', 'framework'); ?>" class="gw-btn gwb-skin gwb-noshadow">
						<?php _e('view more works', 'framework'); ?><i class="fa fa-arrow-circle-right"></i>
                    </a>              
                <?php } ?>
                                        
            	
            <?php echo $after_widget; ?>
            
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {		
        $instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['port_link'] = strip_tags($new_instance['port_link']);					
					
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {		
        
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
				
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 8;		
		
		$port_link = isset($instance['port_link']) ? esc_attr($instance['port_link']) : '';
				
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'framework'); ?> 
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of entries:', 'framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>        
        
        <p><label for="<?php echo $this->get_field_id('port_link'); ?>"><?php _e('More button links to:', 'framework'); ?> 
        <input class="widefat" id="<?php echo $this->get_field_id('port_link'); ?>" name="<?php echo $this->get_field_name('port_link'); ?>" type="text" value="<?php echo $port_link; ?>" /></label></p>                   
        <?php 
		
    }

} // class PortfolioWidget

// register PortfolioWidget
//add_action('widgets_init', create_function('', 'return register_widget("PortfolioWidget");'));	