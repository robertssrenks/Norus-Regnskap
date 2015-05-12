<?php
/**
 * BrochureWidget Class
 */
class BrochureWidget extends WP_Widget {
    /** constructor */
    function BrochureWidget() {
		$widget_ops = array('classname' => 'widget_gw_brochure', 'description' => __('Brocure','framework') );
		$this->WP_Widget('gw-brochure', __('GW Brochure','framework'), $widget_ops);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );

		$title = $instance['title'];
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );

		$brochure_link = $instance['brochure_link'];
		$brochure_txt = $instance['brochure_txt'];		
					
		echo $before_widget;

		echo $before_title . $title . $after_title; ?>
                
		<div class="brochure-wrapper">
        
            <a href="
				<?php if ($brochure_link) { 
				
					if(function_exists('icl_translate')) {
						//echo icl_translate('wpml_custom', 'brochure_link', $brochure_link); 
						echo icl_translate('wpml_custom', $instance['brochure_link'], $brochure_link); 
					} else {
						echo $brochure_link;
					}					
				
                } else {
                _e('#', 'framework'); } ?>">
                
                <img src="<?php echo get_template_directory_uri(); ?>/images/pdf_icon.png" alt="" class="brochure-img" />
            </a> 

            
            <div class="brochure-content">

                <p class="header-desc">
                
				<?php if ($brochure_txt) {
					
					if(function_exists('icl_translate')) {
						//echo icl_translate('wpml_custom', 'brochure_txt', $brochure_txt); 
						echo icl_translate('wpml_custom', $instance['brochure_txt'], $brochure_txt); 
					} else {
						echo $brochure_txt;
					}					
					
				} else {
					_e( 'Download our PDF brochure', 'framework' );
				} ?>
                
                </p>
            </div>
		</div>

        <?php echo $after_widget; ?>


        <?php
    }

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
	
		// Strip tags to remove HTML (important for text inputs)
		$instance['title'] = strip_tags( $new_instance['title'] );				
		$instance['brochure_link'] = strip_tags($new_instance['brochure_link']);				
		$instance['brochure_txt'] = strip_tags($new_instance['brochure_txt']);	
			
		return $instance;
	}

    /** @see WP_Widget::form */
    function form($instance) {				
		
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		
		$gw_brochure_link = isset( $instance['brochure_link'] ) ?  $instance['brochure_link'] : '';
		$gw_brochure_txt = isset( $instance['brochure_txt'] ) ?  $instance['brochure_txt'] : '';		
		
			
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'framework'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            
		<p><label for="<?php echo $this->get_field_id('brochure_link'); ?>"><?php _e('Brochure link:', 'framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('brochure_link'); ?>" name="<?php echo $this->get_field_name('brochure_link'); ?>" type="text" value="<?php echo $gw_brochure_link; ?>" /></p>                                
        
		<p><label for="<?php echo $this->get_field_id( 'brochure_txt' ); ?>"><?php _e('Brochure text:', 'framework') ?></label>
        <textarea rows="6" cols="46" id="<?php echo $this->get_field_id('brochure_txt'); ?>" name="<?php echo $this->get_field_name('brochure_txt'); ?>"><?php echo $gw_brochure_txt; ?></textarea></p>        
        <?php 
    }

} // class BrochureWidget

// register BrochureWidget
//add_action('widgets_init', create_function('', 'return register_widget("BrochureWidget");'));	