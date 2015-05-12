<?php 

/*----------------------------------
	load Redux Framework
-------------------------------------*/


/* 1. load the theme's framework */
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/framework/ReduxCore/framework.php' ) ) {
	require_once( dirname( __FILE__ ) . '/framework/ReduxCore/framework.php' );
}

/* 2. load the theme's options */
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/framework/options/options-config.php' ) ) {
	require_once( dirname( __FILE__ ) . '/framework/options/options-config.php' );
}



/*----------------------------------
	load TGM Plugin Activation
-------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/framework/tgm-plugin-load.php' ) ) {
	require_once( dirname( __FILE__ ) . '/framework/tgm-plugin-load.php' );
}



/*----------------------------------
	load theme css
-------------------------------------*/
function goldenworks_load_styles() {
	if(!is_admin()){

		global $goldenworks;


		wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '', 'all' );
		wp_enqueue_style( 'bootstrap' );
		
		/* fontAwesome font library */
		wp_register_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', array(), '', 'all' );
		wp_enqueue_style( 'font-awesome' );
		
		/* iconMoon font library */
		wp_register_style( 'icon-moon', get_template_directory_uri() . '/css/icons/icon-font-style.css', array(), '', 'all' );
		wp_enqueue_style( 'icon-moon' );		
		
		/* theme main css file( style.css ) */
		wp_enqueue_style( 'dreamspace-style', get_bloginfo( 'stylesheet_url' ), array(), '1.2.6' );
				
		/* responsive menu css */
		wp_register_style( 'slicknav', get_template_directory_uri() . '/css/slicknav.css', array(), '', 'all' );
		wp_enqueue_style( 'slicknav' );		
			
		/* magnific popup(lightbox) css */
		wp_register_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css', array(), '', 'all' );
		wp_enqueue_style( 'magnific-popup' );	


		/* loading custom css for wysija newsletters if the plugin is active */
		if ( class_exists( 'WYSIJA_object' ) ) {			
			wp_register_style( 'wysija-newsletters', get_template_directory_uri() . '/css/wysija-newsletters.css', array(), '', 'all' );
			wp_enqueue_style( 'wysija-newsletters' );
		} 

			
		/* set default skin */
		$current_skin = 'red_skin.css';
		
		if (isset($goldenworks['skin_stylesheet'])) {
			$current_skin = $goldenworks['skin_stylesheet'];
		}
				
		/* include the current active skin */
		wp_register_style( 'current-skin', get_template_directory_uri() . '/css/skins/' . $current_skin , array(), '', 'all' );		
		wp_enqueue_style( 'current-skin' );


		/* custom styling applied via option in the redux panel */
		wp_register_style('options', get_template_directory_uri() . '/css/options.css', 'style');
		wp_enqueue_style( 'options');

	}
}		
add_action('wp_enqueue_scripts', 'goldenworks_load_styles');



/*----------------------------------
	load javascript files in theme's footer / header where needed
-------------------------------------*/
function goldenworks_load_scripts() {
	if(!is_admin()){

		global $goldenworks;
		
		/* include modernizr */
		wp_enqueue_script( 'modernizr', get_template_directory_uri() .'/js/modernizr.custom.js', array('jquery'));				

		
		/* loading bootstrap js */
		wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() .'/js/bootstrap.min.js', array('jquery'), false, true);
				
					
		/* load fitvids for video resize */
		wp_enqueue_script( 'fitvids', get_template_directory_uri() .'/js/jquery.fitvids.js', array('jquery'), false, true);									
				
		/* include jquery easing */
		wp_enqueue_script( 'easing-js', get_template_directory_uri() .'/js/jquery.easing.1.3.js', array('jquery'), false, true);	
		
		
		if(!is_page_template('template-comingsoon.php')) {
			/* load superfish menu */
			wp_enqueue_script( 'superfish', get_template_directory_uri() .'/js/superfish.min.js', array('jquery'), false, true);
		
			/* include mobile menu script */
			wp_enqueue_script( 'slicknav-js', get_template_directory_uri() .'/js/jquery.slicknav.min.js', array('jquery'), false, true);	
			
			/* menu calls */
			wp_enqueue_script( 'menu-calls', get_template_directory_uri() .'/js/menu.calls.js', array('jquery'), false, true);				
		}
				
		
		/* include images loaded script*/
		wp_enqueue_script( 'imagesloaded-js', get_template_directory_uri() .'/js/imagesloaded.js', array('jquery'), false, true);		
		

		/* include masonry only on certain blog templates */		
		if ( is_page_template('template-blog2.php') || is_page_template('template-blog3.php') || is_page_template('template-blog4.php') ) {
			wp_enqueue_script( 'masonry-js', get_template_directory_uri() .'/js/masonry.pkgd.min.js', array('jquery'), false, true);		
			wp_enqueue_script( 'masonry-call-js', get_template_directory_uri() .'/js/masonry.call.js', array('jquery'), false, true);				
		}
		

		/* magnific popup script */
		wp_enqueue_script( 'magnific-popup-js', get_template_directory_uri() .'/js/jquery.magnific-popup.min.js', array('jquery'), false, true);
		wp_enqueue_script( 'magnific-popup-call', get_template_directory_uri() . '/js/magnific.popup.call.js', array('jquery'), false, true);
		

		/* scrollUp script */
		wp_enqueue_script( 'scrollUp-js', get_template_directory_uri() .'/js/jquery.scrollUp.min.js', array('jquery'), false, true);
		wp_enqueue_script( 'scrollUp-call', get_template_directory_uri() . '/js/jquery.scrollUp.call.js', array('jquery'), false, true);
	
	
		/* scripts used only on knowledge base page template */
		if ( is_page_template('template-knowledgebase.php')) {
	
			wp_enqueue_script( 'scrollto-js', get_template_directory_uri() . '/js/jquery.scrollTo.js', array('jquery'), false, true);
			wp_enqueue_script( 'nav-js', get_template_directory_uri() . '/js/jquery.nav.min.js', array('jquery'), false, true);	
			wp_enqueue_script( 'nav-call', get_template_directory_uri() . '/js/jquery.nav.call.js', array('jquery'), false, true);				
			wp_enqueue_script( 'scroller-js', get_template_directory_uri() . '/js/jquery.scroller.js', array('jquery'), false, true);		
		
		}
		
		
		/* scripts used only on coming soon page template */		
		if ( is_page_template('template-comingsoon.php')) {
			wp_enqueue_script( 'countdown-js', get_template_directory_uri() . '/js/countdown.js', array('jquery'), false, true);				
			wp_enqueue_script( 'countdown-call', get_template_directory_uri() . '/js/countdown.call.js', array('jquery'), false, true);				
		}
		
		
		/* include sticky menu */
		if( ($goldenworks['menu-type'] == 1) && !is_page_template('template-comingsoon.php') ) {  
		
			if( ($goldenworks['sticky-menu'] == 1) ) {
				wp_enqueue_script( 'stickymenu-js', get_template_directory_uri() .'/js/jquery.stickymenu.js', array('jquery'), false, true);
			}
			
		}
		
		
		/* include the custom js scripts */
		wp_enqueue_script( 'custom-js', get_template_directory_uri() .'/js/custom.js', array('jquery'), false, true);			


		
		/* isotope script is loaded only on portfolio and works post types */
		if ( is_page_template('template-portfolio_3col.php') || is_page_template('template-portfolio_4col.php') || is_page_template('template-portfolio_1col.php') 
		|| is_page_template('template-portfolio_2col.php') || is_page_template('template-portfolio_3col_sidebar.php') || is_page_template('template-portfolio_3col_grid.php')
		|| is_page_template('template-portfolio_4col_grid.php') ) {
			wp_enqueue_script( 'isotope', get_template_directory_uri() .'/js/jquery.isotope.min.js', array('jquery'), false, true);
			wp_enqueue_script( 'isotope-call', get_template_directory_uri() .'/js/jquery.isotope.call.js', array('jquery'), false, true);	
			
			wp_enqueue_script( 'equalheight', get_template_directory_uri() .'/js/jquery.equalheight.js', array('jquery'), false, true);
			wp_enqueue_script( 'equalheight-call', get_template_directory_uri() .'/js/jquery.equalheight.call.js', array('jquery'), false, true);					
		}
				
		
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
		
		
	} /* end of is admin */
	
}

add_action('wp_enqueue_scripts', 'goldenworks_load_scripts');



/*----------------------------------
	generate a custom css file that contains only custom css generated by user via Redux Options Panel
-------------------------------------*/
function generate_options_css() {

	$css_dir = get_stylesheet_directory() . '/css/'; // Shorten code, save 1 call
	ob_start(); // Capture all output (output buffering)

	require($css_dir . 'styles.php'); // Generate CSS

	$css = ob_get_clean(); // Get generated CSS (output buffering)
	file_put_contents($css_dir . 'options.css', $css, LOCK_EX); // Save it
}



/*----------------------------------
	Add functionalities on theme setup
-------------------------------------*/
if ( !function_exists('gw_theme_setup') ) {

	function gw_theme_setup() {
	
	
		// Add localization
		load_theme_textdomain( 'framework', get_template_directory() . '/languages' );
		
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";

		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
	
	
		// Enable post formats
		$pformat = array('link', 'quote', 'image', 'video', 'aside', 'audio');
		add_theme_support( 'post-formats', $pformat );
		add_post_type_support( 'post', 'post-formats' );
	
	

		// we are registering 3 menus for this theme
		register_nav_menus(
			array(
			'header-menu' => __('Header Menu', 'framework'),
			'alternate-menu' => __('Alternate Menu', 'framework'),			
			'footer-menu' => __('Footer Menu', 'framework')
			)
		);
		


		// we set the default content width
		if ( !isset( $content_width ) ) {
			$content_width = 1140;
		}

		// Enable shortcodes inside wordpress excerpts
		add_filter('the_excerpt', 'do_shortcode');


		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );


		// Enable plugins and themes to manage the document title		
		add_theme_support( 'title-tag' );
		

		// Enable html5 search form
		add_theme_support('html5', array('search-form'));
		

		
		// Enable woosidebars functionality for custom posts
		add_post_type_support( 'news', 'woosidebars' );
		add_post_type_support( 'portfolio', 'woosidebars' );



	
		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );
		
		set_post_thumbnail_size( 60, 60, true ); // Normal post thumbnails
	
		add_image_size( 'thumb-admin', 100, 100, true ); // Admin thumbnails
		
		add_image_size( 'post-small', 76, 76, true ); // blog widget thumbnails	
		
		add_image_size( 'post-columns', 362, 200, true ); // 2 columns blog posts( blog template 5)
		
		add_image_size( 'post-portrait', 274, 304, true ); // portrait blog posts( blog template 6)
		
		add_image_size( 'port-thumb-widget', 71, 71, true ); // latest portfolio widget
		
		
		
		// Add sidebars function to the 'widgets_init' action hook.
		add_action( 'widgets_init', 'gw_register_sidebars' );	


	} // end of function gw_theme_setup();

}

add_action( 'after_setup_theme', 'gw_theme_setup' );




/*----------------------------------
	Register dynamic sidebars and load custom widgets
-------------------------------------*/
function gw_register_sidebars() {
	
	
	/* load & register custom widgets */
	require_once (get_template_directory() . '/framework/custom/widgets/widget_blog_posts.php');  	// include latest blog posts widget
	register_widget( 'BlogWidget' );
	
	
	require_once (get_template_directory() . '/framework/custom/widgets/widget_blog_cat.php');  	// include blog categories widget
	register_widget( 'BlogCategWidget' );
	
	
	require_once ( get_template_directory() . '/framework/custom/widgets/widget_twitter.php' );  		// include twitter widget
	register_widget( 'TwitterCustomWidget' );
	
	
	require_once ( get_template_directory() . '/framework/custom/widgets/widget_flickr.php' );  		// include flickr widget
	register_widget( 'FlickrCustomWidget' );	
	
	
	require_once ( get_template_directory() . '/framework/custom/widgets/widget_brochure.php' );  	// include brochure widget
	register_widget( 'BrochureWidget' );
	
	
	require_once ( get_template_directory() . '/framework/custom/widgets/widget_news_cat.php' );  	// include news categories widget
	register_widget( 'NewsCategWidget' );
	
	
	require_once ( get_template_directory() . '/framework/custom/widgets/widget_portfolio_posts.php' );  	// include latest portfolio posts widget
	register_widget( 'PortfolioWidget' );
	
	
	/* default sidebar that gets replaced by the custom sidebars created by end user */
	register_sidebar(array(
		'name' => __('Default Sidebar', 'framework'),
		'id'        	 => 'dsidebar',		
		'description'   => __( 'Main sidebar that appears on the left or right of the theme body content.', 'framework' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<h4 class="widgettitle">', 
		'after_title' => '</h4>', 
	));


	/* footer widgets */
	register_sidebar(array(
		'name' 			 => __('Footer Sidebar 1', 'framework'),
		'id'        	 => 'fsidebar-1',		
		'description'    => __( 'First footer sidebar(from left to right) that appears in the footer section of the site.', 'framework' ),
		'before_widget'  => '<div id="%1$s" class="fwidget %2$s">', 
		'after_widget'   => '</div>', 
		'before_title'   => '<h4>', 
		'after_title'    => '</h4>', 
	));
	
	register_sidebar(array(
		'name' 			 => __('Footer Sidebar 2', 'framework'),
		'id'        	 => 'fsidebar-2',			
		'description'    => __( 'Second footer sidebar(from left to right) that appears in the footer section of the site.', 'framework' ),		
		'before_widget'  => '<div id="%1$s" class="fwidget %2$s">', 
		'after_widget'   => '</div>', 
		'before_title'   => '<h4>', 
		'after_title'    => '</h4>', 
	));
	
	register_sidebar(array(
		'name' 			 => __('Footer Sidebar 3', 'framework'),
		'id'        	 => 'fsidebar-3',			
		'description'    => __( 'Third footer sidebar(from left to right) that appears in the footer section of the site.', 'framework' ),		
		'before_widget'  => '<div id="%1$s" class="fwidget %2$s">', 
		'after_widget'   => '</div>', 
		'before_title'   => '<h4>', 
		'after_title'    => '</h4>', 
	));
	
	register_sidebar(array(
		'name' 			 => __('Footer Sidebar 4', 'framework'),
		'id'        	 => 'fsidebar-4',			
		'description'    => __( 'Fourth footer sidebar(from left to right) that appears in the footer section of the site.', 'framework' ),		
		'before_widget'  => '<div id="%1$s" class="fwidget %2$s">', 
		'after_widget'   => '</div>', 
		'before_title'   => '<h4>', 
		'after_title'    => '</h4>', 
	));	
	
	register_sidebar(array(
		'name' 			 => __('Coming Soon Footer Sidebar', 'framework'),
		'id'        	 => 'cssidebar',			
		'description'    => __( 'Footer sidebar that appears only in the Coming Soon page template.', 'framework' ),		
		'before_widget'  => '<div id="%1$s" class="fwidget %2$s">', 
		'after_widget'   => '</div>', 
		'before_title'   => '<h4>', 
		'after_title'    => '</h4>', 
	));		

}



/*----------------------------------
	Load other theme functions
-------------------------------------*/
require_once (get_template_directory() . '/framework/custom/theme-functions.php');  	// include the custom functions / classes
require_once (get_template_directory() . '/framework/custom/breadcrumb.php');  			// include breadcrumbs



/*----------------------------------
	Load custom posts
-------------------------------------*/
require_once (get_template_directory() . '/framework/custom/custom_posts/custom-news.php');  	// include news custom post functionality
require_once (get_template_directory() . '/framework/custom/custom_posts/custom-portfolio.php');  	// include portfolio custom post functionality




?>