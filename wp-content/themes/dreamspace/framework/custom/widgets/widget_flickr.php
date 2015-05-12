<?php
/**
 * Flickr Widget Class
 */
class FlickrCustomWidget extends WP_Widget {
    /** constructor */
    function FlickrCustomWidget() {
		global $themename;
		$widget_ops = array('classname' => 'flickr-widget', 'description' => __( 'Displays images from your Flickr account.', 'framework') );
		$this->WP_Widget('flickr', __('GW Flickr', 'framework'), $widget_ops);
    }

    function widget($args, $instance) {	
        extract( $args );
		
		$title = $instance['title'];		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Photos on flickr', 'framework') : $instance['title'], $instance, $this->id_base);
		$id = $instance['id'];
		
		if ( !$number = (int) $instance['number'] )
			$number = 8;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 12 )
			$number = 12;
        ?>

			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $after_title; ?>
				<div class="flickr-wrapper">
					<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=m&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script> 
				</div>
			<?php echo $after_widget; ?>

        <?php
    }

    function update($new_instance, $old_instance) {				
        $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['id'] = strip_tags($new_instance['id']);
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
    }

    function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$id = isset($instance['id']) ? esc_attr($instance['id']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 8;
        ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Flickr ID', 'framework') ?>(<a href="http://www.idgettr.com" target="_blank">idGettr</a>):</label>
		<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" /></p>
			
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of photos:', 'framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>

        <?php 
    }

}

//add_action('widgets_init', create_function('', 'return register_widget("FlickrCustomWidget");'));
?>