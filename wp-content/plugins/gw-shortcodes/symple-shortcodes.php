<?php
/*
Plugin Name: GW Shortcodes
Plugin URI: http://www.goldenworks.eu
Description: Goldenworks shortcodes plugin
Author: Goldenworks
Author URI: http://www.goldenworks.eu
Version: 1.1
License: GNU General Public License version 2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Adds plugin JS and CSS
require_once( dirname(__FILE__) . '/includes/scripts.php' );

// Main shortcode functions
require_once( dirname(__FILE__) . '/includes/shortcode-functions.php');

// Adds mce buttons to post editor
require_once( dirname(__FILE__) . '/includes/mce/symple_shortcodes_tinymce.php');