<?php
/**
 * This file loads the CSS and JS necessary for your shortcodes display
 * @package GW Shortcodes Plugin
 * @since 1.0
 * @author Goldenworks : http://goldenworks.eu
 * @copyright Copyright (c) 2013, Goldenworks
 * @link http://goldenworks.eu
 * @License: GNU General Public License version 2.0
 * @License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
if( !function_exists ('gw_shortcodes_scripts') ) :
	function gw_shortcodes_scripts() {
		wp_enqueue_script('jquery');
		wp_register_script( 'gw_tabs', plugin_dir_url( __FILE__ ) . 'js/gw_tabs.js', array ( 'jquery', 'jquery-ui-tabs'), '1.0', true );
		wp_register_script( 'gw_toggle', plugin_dir_url( __FILE__ ) . 'js/gw_toggle.js', 'jquery', '1.0', true );
		wp_register_script( 'gw_accordion', plugin_dir_url( __FILE__ ) . 'js/gw_accordion.js', array ( 'jquery', 'jquery-ui-accordion' ), '1.0', true );
		
		/* register skillbars */
		wp_register_script( 'gw_skillbar', plugin_dir_url( __FILE__ ) . '/js/gw_skillbar.js', array ( 'jquery' ), '1.0', true );		
		
		wp_register_script( 'gw_flexslider', plugin_dir_url( __FILE__ ) . 'js/jquery.flexslider-min.js', array ( 'jquery' ), '1.0', true );
		wp_register_script( 'gw_testimonial_call', plugin_dir_url( __FILE__ ) . 'js/testimonial_call.js', array ( 'jquery', 'gw_flexslider' ), '1.0', true );
		wp_register_script( 'gw_contentslider_call', plugin_dir_url( __FILE__ ) . 'js/contentslider_call.js', array ( 'jquery', 'gw_flexslider' ), '1.0', true );		
		
		
		/* register classie js library */
		wp_register_script( 'classie-js', plugin_dir_url( __FILE__ ) .'js/classie.js', array('jquery'), false, true);	
				
		/* modal effects script */
		wp_register_script( 'modalEffects-js', plugin_dir_url( __FILE__ ) .'js/modalEffects.js', array('jquery'), false, true);			
		
		/* easypiechart */
		wp_register_script( 'easypiechart-js', plugin_dir_url( __FILE__ ) .'js/easypiechart.min.js', array('jquery'), false, true);	
		wp_register_script( 'easypiechart-call', plugin_dir_url( __FILE__ ) .'js/easypiechart_call.js', array('jquery'), false, true);
		
		
		/* google maps */
		wp_register_script('gw_googlemap',  plugin_dir_url( __FILE__ ) . 'js/gw_googlemap.js', array('jquery'), '1.0', true);
		wp_register_script('gw_googlemap_api', 'https://maps.googleapis.com/maps/api/js?sensor=false', array('jquery'), '1.0', true);
		
		
		/* masonry for blog posts shortcode */
		wp_register_script( 'masonry-js', plugin_dir_url( __FILE__ ) .'js/masonry.pkgd.min.js', array('jquery'), false, true);	
		wp_register_script( 'masonry-call-js', plugin_dir_url( __FILE__ ) .'js/masonry.call.js', array('jquery'), false, true);				
		

		
		wp_register_style( 'modalc', plugin_dir_url( __FILE__ ) . 'css/modal_component.css', array(), '', 'all' );
		wp_enqueue_style( 'modalc' );
		
		wp_register_style( 'flexsliderc', plugin_dir_url( __FILE__ ) . 'css/flexslider.css', array(), '', 'all' );		
		wp_enqueue_style('flexsliderc');
		
	}
	add_action('wp_enqueue_scripts', 'gw_shortcodes_scripts');
endif;