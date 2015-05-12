<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux_Framework_sample_config' ) ) {

        class Redux_Framework_sample_config {

            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {

                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }

                // This is needed. Bah WordPress bugs.  ;)
                if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                    $this->initSettings();
                } else {
                    add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
                }

            }

            public function initSettings() {

                // Just for demo purposes. Not needed per say.
                $this->theme = wp_get_theme();

                // Set the default arguments
                $this->setArguments();

                // Set a few help tabs so you can see how it's done
                $this->setHelpTabs();

                // Create the sections and fields
                $this->setSections();

                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }

                // If Redux is running as a plugin, this will remove the demo notice and links
                //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

                // Function to test the compiler hook and demo CSS output.
                // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
                //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);

                // Change the arguments after they've been declared, but before the panel is created
                //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

                // Change the default value of a field after it's been set, but before it's been useds
                //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

                // Dynamically add a section. Can be also used to modify sections/fields
                //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }

            /**
             * This is a test function that will let you see when the compiler hook occurs.
             * It only runs if a field    set with compiler=>true is changed.
             * */
            function compiler_action( $options, $css, $changed_values ) {
                echo '<h1>The compiler hook has run!</h1>';
                echo "<pre>";
                print_r( $changed_values ); // Values that have changed since the last save
                echo "</pre>";
                //print_r($options); //Option values
                //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

                /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
            }

            /**
             * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
             * Simply include this function in the child themes functions.php file.
             * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
             * so you must use get_template_directory_uri() if you want to use any of the built in icons
             * */
            function dynamic_section( $sections ) {
                //$sections = array();
                $sections[] = array(
                    'title'  => __( 'Section via hook', 'framework' ),
                    'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'framework' ),
                    'icon'   => 'el-icon-paper-clip',
                    // Leave this as a blank section, no options just some intro text set above.
                    'fields' => array()
                );

                return $sections;
            }

            /**
             * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
             * */
            function change_arguments( $args ) {
                //$args['dev_mode'] = true;

                return $args;
            }

            /**
             * Filter hook for filtering the default value of any given field. Very useful in development mode.
             * */
            function change_defaults( $defaults ) {
                $defaults['str_replace'] = 'Testing filter hook!';

                return $defaults;
            }

            // Remove the demo link and the notice of integrated demo from the redux-framework plugin
            function remove_demo() {

                // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    remove_filter( 'plugin_row_meta', array(
                        ReduxFrameworkPlugin::instance(),
                        'plugin_metalinks'
                    ), null, 2 );

                    // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                    remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
                }
            }

            public function setSections() {

                /**
                 * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
                 * */
                // Background Patterns Reader
                $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
                $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
                $sample_patterns      = array();

                if ( is_dir( $sample_patterns_path ) ) :

                    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                        $sample_patterns = array();

                        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                            if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                                $name              = explode( '.', $sample_patterns_file );
                                $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                                $sample_patterns[] = array(
                                    'alt' => $name,
                                    'img' => $sample_patterns_url . $sample_patterns_file
                                );
                            }
                        }
                    endif;
                endif;

                ob_start();

                $ct          = wp_get_theme();
                $this->theme = $ct;
                $item_name   = $this->theme->get( 'Name' );
                $tags        = $this->theme->Tags;
                $screenshot  = $this->theme->get_screenshot();
                $class       = $screenshot ? 'has-screenshot' : '';

                $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'framework' ), $this->theme->display( 'Name' ) );

                ?>
                <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
                    <?php if ( $screenshot ) : ?>
                        <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                            <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                               title="<?php echo esc_attr( $customize_title ); ?>">
                                <img src="<?php echo esc_url( $screenshot ); ?>"
                                     alt="<?php esc_attr_e( 'Current theme preview', 'framework' ); ?>"/>
                            </a>
                        <?php endif; ?>
                        <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview', 'framework' ); ?>"/>
                    <?php endif; ?>

                    <h4><?php echo $this->theme->display( 'Name' ); ?></h4>

                    <div>
                        <ul class="theme-info">
                            <li><?php printf( __( 'By %s', 'framework' ), $this->theme->display( 'Author' ) ); ?></li>
                            <li><?php printf( __( 'Version %s', 'framework' ), $this->theme->display( 'Version' ) ); ?></li>
                            <li><?php echo '<strong>' . __( 'Tags', 'framework' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                        </ul>
                        <p class="theme-description"><?php echo $this->theme->display( 'Description' ); ?></p>
                        <?php
                            if ( $this->theme->parent() ) {
                                printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'framework' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', 'framework' ), $this->theme->parent()->display( 'Name' ) );
                            }
                        ?>

                    </div>
                </div>

                <?php
                $item_info = ob_get_contents();

                ob_end_clean();

                $sampleHTML = '';
                if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
                    Redux_Functions::initWpFilesystem();

                    global $wp_filesystem;

                    $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
                }

                // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'icon' => 'el-icon-asterisk',
                'title' => __('General', 'framework'),
                'fields' => array(
				
	
					array(
						'id'=>'custom_logo',
						'type' => 'media', 
						'url'=> true,
						'title' => __('Logo', 'framework'),
						'compiler' => 'true',
						'desc'=> __('Upload a logo for your theme, or specify the image address of your online logo.', 'framework'),
						),
						
					array(
						'id'=>'custom_favicon',
						'type' => 'media', 
						'url'=> true,
						'title' => __('Favicon', 'framework'),
						'compiler' => 'true',
						'desc'=> __('Upload a 16px x 16px Png/Gif/ico file that will represent your website\'s favicon.', 'framework'),
						),
							
					array(
						'id'=>'sidebar-position',
						'type' => 'image_select',
						'compiler'=>true,
						'title' => __('Sidebar position', 'framework'), 
						'desc' => __('Choose between left or right aligned sidebar.', 'framework'),
						'compiler' => 'true',
						'options' => array(
								'left' => array('alt' => 'Left sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cl.png'),
								'right' => array('alt' => 'Right sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cr.png')				
							),
						'default' => 'right'
						),	
						
					array(
						'id'=>'display-loader',
						'type' => 'switch',
						'title' => __('Theme loader', 'framework'),
						'desc'=> __('Enable or disable the theme loader.', 'framework'),
						"default" 		=> 1,
						),		
						
						
					array(
						'id'=>'display-breadcrumbs',
						'type' => 'switch',
						'title' => __('Theme breadcrumbs', 'framework'),
						'desc'=> __('Enable or disable the theme breadcrumbs.', 'framework'),
						"default" 		=> 1,
						),							
							
					/*
					array(
						'id'=>'tracking-code',
						'type' => 'textarea',
						//'required' => array('layout','equals','1'),	
						'title' => __('Tracking Code', 'framework'), 
						//'subtitle' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'framework'),
						//'validate' => 'js',
						'desc' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'framework'),
						),
					*/
					
					array(
						'id'=>'hlang-switcher',
						'type' => 'switch',
						'title' => __('Language switcher', 'framework'),
						'desc'=> __('Enable or disable the language switcher in the theme\'s header.', 'framework'),
						"default" 		=> 1,
						),						
					
					
                )
            );



            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'title' => __('Styling Options', 'framework'),
                'fields' => array(

				
					array(
						'id'=>'skin_stylesheet',
						'type' => 'select',
						'title' => __('Theme Stylesheet', 'framework'), 
						'options' => array('red_skin.css'=>'red_skin.css', 'blue_skin.css'=>'blue_skin.css', 'green_skin.css'=>'green_skin.css', 'orange_skin.css'=>'orange_skin.css', 
						'creative_red_skin.css'=>'creative_red_skin.css', 'alt_green_skin.css'=>'alt_green_skin.css', 'alt_blue_skin.css'=>'alt_blue_skin.css', 
						'alt_brown_skin.css'=>'alt_brown_skin.css'),
						'desc' => __('Select your themes alternative color scheme.', 'framework'),
						'default' => 'red_skin.css',
						),
						
						
					array(
						'id'=>'custom-css',
						'type' => 'textarea',
						'title' => __('Custom CSS', 'framework'), 
						'desc' => __('Quickly add some CSS to your theme by adding it to this block. This field is CSS validated!', 'framework'),
						'validate' => 'css',
						'compiler'=>true			
						),	

                )
            );
			
						
			
			$this->sections[] = array(
				'title' => __('Header', 'framework'),
				'icon_class' => 'icon-large',
				'icon' => 'el-icon-chevron-up',
				'fields' => array(
					
					
					array(
						'id'=>'hsearch',
						'type' => 'switch', 
						'title' => __('Search input', 'framework'),
						'desc'=> __('Enable or disable the search input in the header.', 'framework'),
						"default" 		=> 1,
						),
			
					array(
						'id'=>'hsocial-icons',
						'type' => 'switch',
						'title' => __('Social media icons', 'framework'),
						'desc'=> __('Enable or disable the social media icons in the header.', 'framework'),
						"default" 		=> 1,
						),			
						
					array(
						'id'=>'header-align',
						'type' => 'button_set',
						'title' => __('Header content align', 'framework'), 
						'desc' => __('Choose how the logo and menu are aligned. Note: for center aligned option the header information is disabled.', 'framework'),
						'options' => array('1' => 'Left aligned','2' => 'Center aligned'),//Must provide key => value pairs for radio options
						'default' => '1'
						),			
						
						
					array(
						'id'=>'sticky-menu',
						'type' => 'switch', 
						'title' => __('Sticky menu', 'framework'),
						'desc'=> __('Choose whether or not you want the menu to stick to the header on scroll', 'framework'),
						"default" 		=> 1,
						),	
						
						
					array(
						'id'=>'menu-type',
						'type' => 'button_set',
						'title' => __('Menu type', 'framework'), 
						'desc' => __('Choose what menu type you want to display.', 'framework'),
						'options' => array('1' => 'Default menu with dropdown','2' => 'Extended menu without dropdown'),//Must provide key => value pairs for radio options
						'default' => 1
						),
						
					array(
						'id'=>'altmenu-columns',
						'type' => 'radio',
						'title' => __('Alternate menu columns', 'framework'), 
						'desc' => __('Choose how many columns you want your alternate menu to have. Default is 5 columns.', 'framework'),
						'options' => array('3' => '3 columns', '4' => '4 Columns', '5' => '5 columns'),//Must provide key => value pairs for radio options
						'default' => '5',
						'compiler'=>true			
						),	
						
						
					array(
						'id'=>'hemail',
						'type' => 'text',
						'title' => __('Top header email', 'framework'),
						'desc' => __('Insert your email that will appear in your header.', 'framework'),
						'validate' => 'email',
						'msg' => __('please insert a valid email address', 'framework'),
						'default' => 'test@test.com'
						),
						
					array(
						'id'=>'hphone',
						'type' => 'text', 
						'url'=> true,
						'title' => __('Phone number', 'framework'),
						'desc'=> __('Insert the phone number that will appear in your theme\'s header.', 'framework'),
						'class' => 'small-text'			
						),				
									
						
					array(
						'id'=>'hicon_twitter',
						'type' => 'text', 
						'url'=> true,
						'title' => __('Twitter profile', 'framework'),
						'desc'=> __('Insert the absolute url to your twitter profile that will appear in your theme\'s header.', 'framework'),
						'class' => 'small-text'			
						),	
			
					array(
						'id'=>'hicon_facebook',
						'type' => 'text', 
						'url'=> true,
						'title' => __('Facebook profile', 'framework'),
						'desc'=> __('Insert the absolute url to your facebook profile that will appear in your theme\'s header.', 'framework'),
						'class' => 'small-text'			
						),				
			
					array(
						'id'=>'hicon_dribbble',
						'type' => 'text', 
						'url'=> true,
						'title' => __('Dribbble profile', 'framework'),
						'desc'=> __('Insert the absolute url to your dribbble profile that will appear in your theme\'s header.', 'framework'),
						'class' => 'small-text'			
						),	
						
					array(
						'id'=>'hicon_linkedin',
						'type' => 'text', 
						'url'=> true,
						'title' => __('Linkedin profile', 'framework'),
						'desc'=> __('Insert the absolute url to your linkedin profile that will appear in your theme\'s header.', 'framework'),
						'class' => 'small-text'			
						),				
						
					array(
						'id'=>'hicon_rss',
						'type' => 'text', 
						'url'=> true,
						'title' => __('Rss feed', 'framework'),
						'desc'=> __('Insert the absolute url to rss feed that will appear in your theme\'s header.', 'framework'),
						'class' => 'small-text'			
						),			
						
					),			
				);			
						
			
			
			$this->sections[] = array(
				'title' => __('Footer', 'framework'),
				'icon_class' => 'icon-large',
				'icon' => 'el-icon-chevron-down',
				// 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
				'fields' => array(
					
					
					array(
						'id'=>'footer-layout',
						'type' => 'image_select',
						'compiler'=>true,
						'title' => __('Main Layout', 'framework'), 
						'desc' => __('Select how many columns you want your footer to have. You can choose between 1, 2, 3, 4 or no column layout.', 'framework'),
						'options' => array(
								'1' => array('alt' => __('1 Column', 'framework'), 'img' => ReduxFramework::$_url.'assets/img/1col.png'),
								'2' => array('alt' => __('2 Columns', 'framework'), 'img' => ReduxFramework::$_url.'assets/img/2-col-footer.png'),					
								'3' => array('alt' => __('3 Columns', 'framework'), 'img' => ReduxFramework::$_url.'assets/img/3-col-footer.png'),
								'4' => array('alt' => __('4 Columns', 'framework'), 'img' => ReduxFramework::$_url.'assets/img/4-col-footer.png'),
								'0' => array('alt' => __('No Columns', 'framework'), 'img' => ReduxFramework::$_url.'assets/img/no-col-footer.png')					
							),
						'default' => '3'
						),
								
					array(
						'id'=>'fdecbg-left',
						'type' => 'color',
						'title' => __('Footer left line decoration color', 'framework'), 
						'desc' => __('Pick a background color for the footer left line top decoration (default: #f82e3c).', 'framework'),
						'default' => '#f82e3c',
						'validate' => 'color',
						'compiler'=>true,
						),	
						
					array(
						'id'=>'fdecbg-center',
						'type' => 'color',
						'title' => __('Footer center line decoration color', 'framework'), 
						'desc' => __('Pick a background color for the footer center line top decoration (default: #34d693).', 'framework'),
						'default' => '#34d693',
						'validate' => 'color',
						'compiler'=>true,
						),	
						
					array(
						'id'=>'fdecbg-right',
						'type' => 'color',
						'title' => __('Footer right line decoration color', 'framework'), 
						'desc' => __('Pick a background color for the footer right line top decoration (default: #00aced).', 'framework'),
						'default' => '#00aced',
						'validate' => 'color',
						'compiler'=>true,
						),	
						
					array(
						'id'=>'fbottom-display',
						'type' => 'button_set',
						'title' => __('Bottom footer appearance', 'framework'), 
						'desc' => __('Choose how the bottom footer area will be displayed: with copyright notice in the left and footer menu in the right or just copyright notice center aligned.', 'framework'),
						'options' => array('1' => 'Copyright &amp; menu','2' => 'Centered copyright'),//Must provide key => value pairs for radio options
						'default' => '1'
						),				
						
					array(
						'id'=>'footer-text',
						'type' => 'editor',
						'title' => __('Footer Copyright Text', 'framework'), 
						'desc' => __('Paste the text that you want to be displayed in the footer bottom bar.', 'framework'),
						//'default' => '&copy; [current-year] Dreamspace. All rights reserved. Created by <a href="http://goldenworks.eu">Goldenworks</a>.',
						),	
						

					),			
				);
	
				
			
			
			$this->sections[] = array(
				'title' => __('Blog', 'framework'),
				'icon_class' => 'icon-large',
				'icon' => 'el-icon-comment-alt',
				'fields' => array(
					
					
					array(
						'id'=>'pag_blog1',
						'type' => 'text',
						'title' => __('Blog template 1 pagination', 'framework'),
						'desc' => __('Insert in this field the number of entries per page for blog template 1. Default is 6.', 'framework'),
						'validate' => 'numeric',
						'default' => '6',
						'class' => 'small-text'
						),	
						
					array(
						'id'=>'pag_blog2',
						'type' => 'text',
						'title' => __('Blog template 2 pagination', 'framework'),
						'desc' => __('Insert in this field the number of entries per page for blog template 2(masonry with 2 columns). Default is 8.', 'framework'),
						'validate' => 'numeric',
						'default' => '8',
						'class' => 'small-text'
						),	
						
					array(
						'id'=>'pag_blog3',
						'type' => 'text',
						'title' => __('Blog template 3 pagination', 'framework'),
						'desc' => __('Insert in this field the number of entries per page for blog template 3(masonry with 3 columns). Default is 12.', 'framework'),
						'validate' => 'numeric',
						'default' => '12',
						'class' => 'small-text'
						),	
						
					array(
						'id'=>'pag_blog4',
						'type' => 'text',
						'title' => __('Blog template 4 pagination', 'framework'),
						'desc' => __('Insert in this field the number of entries per page for blog template 4. Default is 6.', 'framework'),
						'validate' => 'numeric',
						'default' => '6',
						'class' => 'small-text'
						),	
						
					array(
						'id'=>'pag_blog5',
						'type' => 'text',
						'title' => __('Blog template 5 pagination', 'framework'),
						'desc' => __('Insert in this field the number of entries per page for blog template 5. Default is 6.', 'framework'),
						'validate' => 'numeric',
						'default' => '6',
						'class' => 'small-text'
						),	
						
					array(
						'id'=>'pag_blog6',
						'type' => 'text',
						'title' => __('Blog template 6 pagination', 'framework'),
						'desc' => __('Insert in this field the number of entries per page for blog template 6. Default is 4.', 'framework'),
						'validate' => 'numeric',
						'default' => '4',
						'class' => 'small-text'
						),									
						
					array(
						'id'=>'bsocial-icons',
						'type' => 'switch',
						'title' => __('Social media icons on posts', 'framework'),
						'desc'=> __('Enable or disable the social media icons in posts detail.', 'framework'),
						"default" 		=> 1,
						),								
						
					),			
				);			
						
						
						
			
			
			$this->sections[] = array(
				'title' => __('News', 'framework'),
				'icon_class' => 'icon-large',
				'icon' => 'el-icon-list-alt',
				'fields' => array(
					
					
					array(
						'id'=>'pag_news',
						'type' => 'text',
						'title' => __('News pagination', 'framework'),
						'desc' => __('Insert in this field the number of entries per page for news custom posts. Default is 6.', 'framework'),
						'validate' => 'numeric',
						'default' => '6',
						'class' => 'small-text'
						),
						
						
					array(
						'id'=>'fbar-news',
						'type' => 'switch',
						'title' => __('Footer top bar in the news section', 'framework'),
						'desc'=> __('Enable or disable the footer top bar for the news section(post listings and post detail).', 'framework'),
						"default" 		=> 1,
						),	
						
							
					array(
						'id'=>'nsocial-icons',
						'type' => 'switch',
						'title' => __('Social media icons on news posts', 'framework'),
						'desc'=> __('Enable or disable the social media icons in news posts detail.', 'framework'),
						"default" 		=> 1,
						),	
																
						
					),			
				);
				
							
						
			$this->sections[] = array(
				'title' => __('Portfolio', 'framework'),
				'icon_class' => 'icon-large',
				'icon' => 'el-icon-paper-clip',
				'fields' => array(
					
			
					/* 1 column portfolio filters */
					array(
						'id'=>'p1col-filter',
						'type' => 'switch',
						'title' => __('Filter for 1 column portfolio', 'framework'),
						'desc'=> __('Enable or disable the categories filtering option for classic portfolio listing on 1 column.', 'framework'),
						"default" 		=> 1,
						),	
			
					array(
						'id'=>'p1col-filterp',
						'type' => 'button_set',
						'title' => __('1 column portfolio filter position', 'framework'), 
						'desc' => __('Choose the filter position alignment. Default is left aligned.', 'framework'),
						'options' => array('left' => 'left aligned', 'center' => 'center aligned'),//Must provide key => value pairs for radio options
						'default' => 'left',
						'compiler'=>true
						),
						
								
					/* classic 2 columns portfolio filters */
					array(
						'id'=>'p2col-filter',
						'type' => 'switch',
						'title' => __('Filter for 2 columns classic portfolio', 'framework'),
						'desc'=> __('Enable or disable the categories filtering option for classic portfolio listing on 2 columns.', 'framework'),
						"default" 		=> 1,
						),	
			
					array(
						'id'=>'p2col-filterp-classic',
						'type' => 'button_set',
						'title' => __('Classic 2 columns portfolio filter position', 'framework'), 
						'desc' => __('Choose the filter position alignment. Default is left aligned.', 'framework'),
						'options' => array('left' => 'left aligned', 'center' => 'center aligned'),//Must provide key => value pairs for radio options
						'default' => 'left',
						'compiler'=>true
						),
						
								
					/* classic 3 columns portfolio filters */
					array(
						'id'=>'p3col-filter',
						'type' => 'switch',
						'title' => __('Filter for 3 columns classic portfolio', 'framework'),
						'desc'=> __('Enable or disable the categories filtering option for classic portfolio listing on 3 columns.', 'framework'),
						"default" 		=> 1,
						),	
			
					array(
						'id'=>'p3col-filterp-classic',
						'type' => 'button_set',
						'title' => __('Classic 3 columns portfolio filter position', 'framework'), 
						'desc' => __('Choose the filter position alignment. Default is left aligned.', 'framework'),
						'options' => array('left' => 'left aligned', 'center' => 'center aligned'),//Must provide key => value pairs for radio options
						'default' => 'left',
						'compiler'=>true
						),
						
						
					/* classic 4 columns portfolio filters */			
					array(
						'id'=>'p4col-filter',
						'type' => 'switch',
						'title' => __('Filter for 4 columns classic portfolio', 'framework'),
						'desc'=> __('Enable or disable the categories filtering option for classic portfolio listing on 4 columns.', 'framework'),
						"default" 		=> 1,
						),
						
					array(
						'id'=>'p4col-filterp-classic',
						'type' => 'button_set',
						'title' => __('Classic 4 columns portfolio filter position', 'framework'), 
						'desc' => __('Choose the filter position alignment. Default is left aligned.', 'framework'),
						'options' => array('left' => 'left aligned', 'center' => 'center aligned'),//Must provide key => value pairs for radio options
						'default' => 'left',
						'compiler'=>true
						),			
									
									
						
					/* grid 3 columns portfolio filters */			
					array(
						'id'=>'p3colg-filter',
						'type' => 'switch',
						'title' => __('Filter for 3 columns grid portfolio', 'framework'),
						'desc'=> __('Enable or disable the categories filtering option for grid portfolio listing on 3 columns.', 'framework'),
						"default" 		=> 1,
						),
						
					array(
						'id'=>'p3col-filterp-grid',
						'type' => 'button_set',
						'title' => __('Grid 3 columns portfolio filter position', 'framework'), 
						'desc' => __('Choose the filter position alignment. Default is left aligned.', 'framework'),
						'options' => array('left' => 'left aligned', 'center' => 'center aligned'),//Must provide key => value pairs for radio options
						'default' => 'left',
						'compiler'=>true
						),							
								
								
									
					/* grid 4 columns portfolio filters */			
					array(
						'id'=>'p4colg-filter',
						'type' => 'switch',
						'title' => __('Filter for 4 columns grid portfolio', 'framework'),
						'desc'=> __('Enable or disable the categories filtering option for grid portfolio listing on 3 columns.', 'framework'),
						"default" 		=> 1,
						),
						
					array(
						'id'=>'p4col-filterp-grid',
						'type' => 'button_set',
						'title' => __('Grid 4 columns portfolio filter position', 'framework'), 
						'desc' => __('Choose the filter position alignment. Default is left aligned.', 'framework'),
						'options' => array('left' => 'left aligned', 'center' => 'center aligned'),//Must provide key => value pairs for radio options
						'default' => 'left',
						'compiler'=>true
						),						
									
									
									
					/* pagination settings */
					array(
						'id'=>'pag_port1c',
						'type' => 'text',
						'title' => __('Classic portfolio 1 column pagination', 'framework'),
						'desc' => __('Insert in this field the number of entries per page for classic portfolio 1 columns custom posts. Default is 4.', 'framework'),
						'validate' => 'numeric',
						'default' => '4',
						'class' => 'small-text'
						),
						
						
					array(
						'id'=>'pag_port2c',
						'type' => 'text',
						'title' => __('Classic portfolio 2 columns pagination', 'framework'),
						'desc' => __('Insert in this field the number of entries per page for classic portfolio 2 columns custom posts. Default is 6.', 'framework'),
						'validate' => 'numeric',
						'default' => '6',
						'class' => 'small-text'
						),
						
											
					array(
						'id'=>'pag_port3c',
						'type' => 'text',
						'title' => __('Classic portfolio 3 columns pagination', 'framework'),
						'desc' => __('Insert in this field the number of entries per page for classic portfolio 3 columns custom posts. Default is 9.', 'framework'),
						'validate' => 'numeric',
						'default' => '9',
						'class' => 'small-text'
						),
						
					array(
						'id'=>'pag_port3g',
						'type' => 'text',
						'title' => __('Grid portfolio 3 columns pagination', 'framework'),
						'desc' => __('Insert in this field the number of entries per page for grid portfolio 3 columns custom posts. Default is 9.', 'framework'),
						'validate' => 'numeric',
						'default' => '9',
						'class' => 'small-text'
						),
									
					array(
						'id'=>'pag_port4c',
						'type' => 'text',
						'title' => __('Classic portfolio 4 columns pagination', 'framework'),
						'desc' => __('Insert in this field the number of entries per page for classic portfolio 4 columns custom posts. Default is 12.', 'framework'),
						'validate' => 'numeric',
						'default' => '12',
						'class' => 'small-text'
						),
						
					array(
						'id'=>'pag_port4g',
						'type' => 'text',
						'title' => __('Grid portfolio 4 columns pagination', 'framework'),
						'desc' => __('Insert in this field the number of entries per page for grid portfolio 4 columns custom posts. Default is 12.', 'framework'),
						'validate' => 'numeric',
						'default' => '12',
						'class' => 'small-text'
						),			
								
					array(
						'id'=>'pag_port3sb',
						'type' => 'text',
						'title' => __('Portfolio 3 columns with sidebar pagination', 'framework'),
						'desc' => __('Insert in this field the number of entries per page for portfolio 3 columns with sidebar. Default is 9.', 'framework'),
						'validate' => 'numeric',
						'default' => '9',
						'class' => 'small-text'
						),
						
							
					array(
						'id'=>'related-port',
						'type' => 'switch', 
						'title' => __('Related posts', 'framework'),
						'desc'=> __('Enable or disable related posts section on portfolio posts detail.', 'framework'),
						"default" 		=> 1,
						),
			
					),			
				);
							
			
			
			$this->sections[] = array(
				'title' => __('Coming Soon', 'framework'),
				'icon_class' => 'icon-large',
				'icon' => 'el-icon-eye-open',
				'fields' => array(
					
					
					array(
						'id'=>'cs_logo',
						'type' => 'media', 
						'url'=> true,
						'title' => __('Coming Soon Logo', 'framework'),
						'desc'=> __('Upload a logo for your coming soon page template, or specify the image address of your online logo.', 'framework'),
						),
						
					array(
						'id'=>'cs_bg',
						'type' => 'media', 
						'url'=> true,
						'title' => __('Background image', 'framework'),
						'desc'=> __('Upload a background image(1920x850px recommended) that will be displayed on your coming soon page.', 'framework'),
						),	
						
					array(
						'id'=>'cs_timer',
						'type' => 'text', 
						'url'=> true,
						'title' => __('Timer', 'framework'),
						'desc'=> __('Set your launch date. Please use only this format: 17 august 2014 12:00:00', 'framework'),
						'class' => 'small-text'			
						),		
										
					array(
						'id'=>'cs_content',
						'type' => 'editor',
						'title' => __('Message', 'framework'), 
						'desc' => __('Insert the content that will be displayed under the logo.', 'framework'),
						),	
						
					array(
						'id'=>'cs_form',
						'type' => 'editor',
						'title' => __('Subscription form', 'framework'), 
						'desc' => __('Insert the code(or the shortcode) that will generate your subscription form.', 'framework'),
						),							
						
					array(
						'id'=>'cs_desc',
						'type' => 'editor',
						'title' => __('Description', 'framework'), 
						'desc' => __('Insert the content that will be displayed under the sign up form.', 'framework'),
						),	
						
						
					),			
				);			
			
			
			
			$this->sections[] = array(
				'title' => __('Typography', 'framework'),
				//'icon_class' => 'icon-large',
				'icon' => 'el-icon-font',
				'fields' => array(

						
						array(
							'id'=>'typography_body',
							'type' => 'typography', 
							'title' => __('Body typography', 'framework'),
							//'compiler'=>true, // Use if you want to hook in your own CSS compiler
							'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
							'font-backup'=>true, // Select a backup non-google font in addition to a google font
							//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
							//'subsets'=>false, // Only appears if google is true and subsets not set to false
							//'font-size'=>false,
							//'line-height'=>false,
							//'word-spacing'=>true, // Defaults to false
							//'letter-spacing'=>true, // Defaults to false
							'color'=>false,
							'preview'=>true, // Disable the previewer
							'output' => array('body, input, textarea, #sidebar'), // An array of CSS selectors to apply this font style to dynamically
							'units'=>'px', // Defaults to px
							//'subtitle'=> __('Typography option with each property can be called individually.', 'framework'),
							'default'=> array(
								//'color'=>"#6d6d6d", 
								'font-style'=>'400', 
								'font-family'=>'Arial, Helvetica, sans-serif', 
								'font-size'=>'14px', 
								'line-height'=>'22px'),
							),	
							
						
							
						array(
							'id'=>'typography_headers',
							'type' => 'typography', 
							'title' => __('Headers typography', 'framework'),
							//'compiler'=>true, // Use if you want to hook in your own CSS compiler
							'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
							'font-backup'=>true, // Select a backup non-google font in addition to a google font
							//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
							//'subsets'=>false, // Only appears if google is true and subsets not set to false
							'font-size'=>false,
							'line-height'=>false,
							//'word-spacing'=>true, // Defaults to false
							//'letter-spacing'=>true, // Defaults to false
							'color'=>false,
							'preview'=>true, // Disable the previewer
							'output' => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
							'units'=>'px', // Defaults to px
							//'subtitle'=> __('Typography option with each property can be called individually.', 'framework'),
							'default'=> array(
								//'color'=>"#6d6d6d", 
								'font-style'=>'400', 

								'font-family'=>'Arial, Helvetica, sans-serif', 
								//'font-size'=>'14px', 
								/*'line-height'=>'22px'*/),
							),	
														
							
						array(
							'id'=>'typography_blockquote',
							'type' => 'typography', 
							'title' => __('Blockquote typography', 'framework'),
							//'compiler'=>true, // Use if you want to hook in your own CSS compiler
							'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
							'font-backup'=>true, // Select a backup non-google font in addition to a google font
							//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
							//'subsets'=>false, // Only appears if google is true and subsets not set to false
							//'font-size'=>false,
							//'line-height'=>false,
							//'word-spacing'=>true, // Defaults to false
							//'letter-spacing'=>true, // Defaults to false
							'color'=>false,
							//'preview'=>false, // Disable the previewer
							'output' => array('blockquote p, .pullquote-left, .pullquote-right'), // An array of CSS selectors to apply this font style to dynamically
							'units'=>'px', // Defaults to px
							'subtitle'=> __('Select font family and font type for blockquotes and pullquotes.', 'framework'),
							'default'=> array(
								//'color'=>"#6d6d6d", 
								'font-style'=>'400', 
								'font-family'=>'Arial, Helvetica, sans-serif', 
								'font-size'=>'16px', 
								'line-height'=>'26px'),
							),
							
				
						array(
							'id'=>'typography_bold',
							'type' => 'typography', 
							'title' => __('Strong(bold) text typography', 'framework'),
							//'compiler'=>true, // Use if you want to hook in your own CSS compiler
							'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
							'font-backup'=>true, // Select a backup non-google font in addition to a google font
							//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
							//'subsets'=>false, // Only appears if google is true and subsets not set to false
							'font-size'=>false,
							'line-height'=>false,
							//'word-spacing'=>true, // Defaults to false
							//'letter-spacing'=>true, // Defaults to false
							'color'=>false,
							//'preview'=>false, // Disable the previewer
							'output' => array('strong'), // An array of CSS selectors to apply this font style to dynamically
							'units'=>'px', // Defaults to px
							'subtitle'=> __('Select font family and font type for strong(bold text).', 'framework'),
							'default'=> array(
								'color'=>"inherit", 
								'font-style'=>'400', 
								'font-family'=>'Arial, Helvetica, sans-serif', 
								'font-size'=>'14px', 
								'line-height'=>'22px'),
							),											
						
						
					),			
				);			
			
			
			
			
				$this->sections[] = array(
					'title' => __('Colors', 'framework'),
					'icon' => 'el-icon-tint',
					'fields' => array(
								
						array(
							'id' => 'body-background',
							'type' => 'color',
							//'output' => array('body'),
							'title' => __('Body background color', 'framework'),
							'desc' => __('Pick a background color.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),
						
						array(
							'id' => 'body-color',
							'type' => 'color',
							'title' => __('Body text color', 'framework'),
							'desc' => __('Pick the text color.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),
						
						array(
							'id' => 'link-color',
							'type' => 'color',
							'title' => __('Link color', 'framework'),
							'desc' => __('Pick the link text color and hover state color for different other elements such as portfolio, news, blog titles or widget lists.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),							
						
						array(
							'id' => 'header-color',
							'type' => 'color',
							'title' => __('Headers h1-h6 text color', 'framework'),
							'desc' => __('Pick the headers text color.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),
						
						/* top menu styling */
						array(
							'id' => 'topmenu-bg',
							'type' => 'color',
							'title' => __('Top menu background color', 'framework'),
							'desc' => __('Pick the top menu background color.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),						
						
						array(
							'id' => 'topmenu-textcolor',
							'type' => 'color',
							'title' => __('Top menu text color', 'framework'),
							'desc' => __('Pick the top menu text color(it won\'t have any effect if you are not using uber menu since all menu items are links).', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),							
						
						array(
							'id' => 'topmenu-linkcolor',
							'type' => 'color',
							'title' => __('Top menu link color', 'framework'),
							'desc' => __('Pick the top menu link color.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),	
						
						array(
							'id' => 'topmenu-linkhover',
							'type' => 'color',
							'title' => __('Top menu link hover color', 'framework'),
							'desc' => __('Pick the top menu link color on hover.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),												
						
						
						array(
							'id' => 'topmenu-leftborder',
							'type' => 'color',
							'title' => __('Top menu left border color', 'framework'),
							'desc' => __('Pick the menu item left border color on hover.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),							
						
						
						/* footer styling */						
						array(
							'id' => 'footer-bg',
							'type' => 'color',
							'title' => __('Footer background color', 'framework'),
							'desc' => __('Pick the footer background color.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),	
						
						array(
							'id' => 'footer-bottombg',
							'type' => 'color',
							'title' => __('Footer bottom bar background color', 'framework'),
							'desc' => __('Pick the footer bottom bar background color.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),												
						
						array(
							'id' => 'footer-textcolor',
							'type' => 'color',
							'title' => __('Footer text color', 'framework'),
							'desc' => __('Pick the footer text color.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),							
						
						array(
							'id' => 'footer-linkcolor',
							'type' => 'color',
							'title' => __('Footer link color', 'framework'),
							'desc' => __('Pick the footer link color.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),								
						
						array(
							'id' => 'footer-linkhover',
							'type' => 'color',
							'title' => __('Footer link hover color', 'framework'),
							'desc' => __('Pick the footer link color on hover.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),						
						
						array(
							'id' => 'footer-headercolor',
							'type' => 'color',
							'title' => __('Footer h1-h6 color', 'framework'),
							'desc' => __('Pick the footer header tags color.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),						
						
						
						
						/* sidebar styling */
						array(
							'id' => 'sidebar-border',
							'type' => 'color',
							'title' => __('Sidebar listings border color', 'framework'),
							'desc' => __('Pick the sidebar listings border color.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),						
						
						array(
							'id' => 'sidebar-linkcolor',
							'type' => 'color',
							'title' => __('Sidebar listings link color', 'framework'),
							'desc' => __('Pick the sidebar listings link color.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),						
						
						array(
							'id' => 'sidebar-linkhover',
							'type' => 'color',
							'title' => __('Sidebar listings link hover color', 'framework'),
							'desc' => __('Pick the sidebar listings link color on hover.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),							

						array(
							'id' => 'sidebar-linkhoverbg',
							'type' => 'color',
							'title' => __('Sidebar listings hover background color', 'framework'),
							'desc' => __('Pick the sidebar listings background color on hover.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),	


						/*------------------*/											
										
						array(
							'id' => 'header-bloglinkcolor',
							'type' => 'color',
							'title' => __('Blog link titles text color', 'framework'),
							'desc' => __('Pick the headers h1 - h6 text color.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),		
						
						array(
							'id' => 'port-overlayicons',
							'type' => 'color',
							'title' => __('Portfolio overlay icon color', 'framework'),
							'desc' => __('Pick the portfolio icon color that appears when you hover your mouse over a portfolio entry.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),	
						
						array(
							'id' => 'port-filtercolor',
							'type' => 'color',
							'title' => __('Portfolio filter button color', 'framework'),
							'desc' => __('Pick the portfolio filter button color for hover / active state.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),	
						
						
						array(
							'id' => 'news-datebg',
							'type' => 'color',
							'title' => __('News date background color', 'framework'),
							'desc' => __('Pick the news  date background color.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),							
						
						
						array(
							'id' => 'news-datetext',
							'type' => 'color',
							'title' => __('News date text color', 'framework'),
							'desc' => __('Pick the news date text color.', 'framework'),
							'validate' => 'color',
							'compiler'=>true,
						),						
																											
						
					),			
				);	

                $theme_info = '<div class="redux-framework-section-desc">';
                $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __( '<strong>Theme URL:</strong> ', 'framework' ) . '<a href="' . $this->theme->get( 'ThemeURI' ) . '" target="_blank">' . $this->theme->get( 'ThemeURI' ) . '</a></p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __( '<strong>Author:</strong> ', 'framework' ) . $this->theme->get( 'Author' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __( '<strong>Version:</strong> ', 'framework' ) . $this->theme->get( 'Version' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get( 'Description' ) . '</p>';
                $tabs = $this->theme->get( 'Tags' );
                if ( ! empty( $tabs ) ) {
                    $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __( '<strong>Tags:</strong> ', 'framework' ) . implode( ', ', $tabs ) . '</p>';
                }
                $theme_info .= '</div>';

                if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
                    $this->sections['theme_docs'] = array(
                        'icon'   => 'el-icon-list-alt',
                        'title'  => __( 'Documentation', 'framework' ),
                        'fields' => array(
                            array(
                                'id'       => '17',
                                'type'     => 'raw',
                                'markdown' => true,
                                'content'  => file_get_contents( dirname( __FILE__ ) . '/../README.md' )
                            ),
                        ),
                    );
                }

                $this->sections[] = array(
                    'title'  => __( 'Import / Export', 'framework' ),
                    'desc'   => __( 'Import and Export your Redux Framework settings from file, text or URL.', 'framework' ),
                    'icon'   => 'el-icon-refresh',
                    'fields' => array(
                        array(
                            'id'         => 'opt-import-export',
                            'type'       => 'import_export',
                            'title'      => 'Import Export',
                            'subtitle'   => 'Save and restore your Redux options',
                            'full_width' => false,
                        ),
                    ),
                );

                $this->sections[] = array(
                    'type' => 'divide',
                );

                $this->sections[] = array(
                    'icon'   => 'el-icon-info-sign',
                    'title'  => __( 'Theme Information', 'framework' ),
                    'desc'   => __( '<p class="description">This is the Description. Again HTML is allowed</p>', 'framework' ),
                    'fields' => array(
                        array(
                            'id'      => 'opt-raw-info',
                            'type'    => 'raw',
                            'content' => $item_info,
                        )
                    ),
                );

                if ( file_exists( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) ) {
                    $tabs['docs'] = array(
                        'icon'    => 'el-icon-book',
                        'title'   => __( 'Documentation', 'framework' ),
                        'content' => nl2br( file_get_contents( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) )
                    );
                }
            }

            public function setHelpTabs() {

                // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-1',
                    'title'   => __( 'Theme Information 1', 'framework' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'framework' )
                );

                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-2',
                    'title'   => __( 'Theme Information 2', 'framework' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'framework' )
                );

                // Set the help sidebar
                $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'framework' );
            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'goldenworks',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'menu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'Options', 'framework' ),
                    'page_title'           => __( 'Options', 'framework' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => '',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-portfolio',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => false,
                    // Show the time the page took to load, etc
                    'update_notice'        => true,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => true,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => null,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'themes.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'            => '',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => '_options',
                    // Page slug used to denote the panel
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => true,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE

                    // HINTS
                    'hints'                => array(
                        'icon'          => 'icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );

                // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
                $this->args['admin_bar_links'][] = array(
                    'id'    => 'redux-docs',
                    'href'   => 'http://docs.reduxframework.com/',
                    'title' => __( 'Documentation', 'framework' ),
                );

                $this->args['admin_bar_links'][] = array(
                    //'id'    => 'redux-support',
                    'href'   => 'https://github.com/ReduxFramework/redux-framework/issues',
                    'title' => __( 'Support', 'framework' ),
                );

                $this->args['admin_bar_links'][] = array(
                    'id'    => 'redux-extensions',
                    'href'   => 'reduxframework.com/extensions',
                    'title' => __( 'Extensions', 'framework' ),
                );

                // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
                $this->args['share_icons'][] = array(
                    'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                    'title' => 'Visit us on GitHub',
                    'icon'  => 'el-icon-github'
                    //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                    'title' => 'Like us on Facebook',
                    'icon'  => 'el-icon-facebook'
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'http://twitter.com/reduxframework',
                    'title' => 'Follow us on Twitter',
                    'icon'  => 'el-icon-twitter'
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'http://www.linkedin.com/company/redux-framework',
                    'title' => 'Find us on LinkedIn',
                    'icon'  => 'el-icon-linkedin'
                );

                // Panel Intro text -> before the form
                if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                    if ( ! empty( $this->args['global_variable'] ) ) {
                        $v = $this->args['global_variable'];
                    } else {
                        $v = str_replace( '-', '_', $this->args['opt_name'] );
                    }
                    //$this->args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'framework' ), $v );
                } else {
                    //$this->args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'framework' );
                }

                // Add content after the form.
                //$this->args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'framework' );
            }

            public function validate_callback_function( $field, $value, $existing_value ) {
                $error = true;
                $value = 'just testing';

                /*
              do your validation

              if(something) {
                $value = $value;
              } elseif(something else) {
                $error = true;
                $value = $existing_value;
                
              }
             */

                $return['value'] = $value;
                $field['msg']    = 'your custom error message';
                if ( $error == true ) {
                    $return['error'] = $field;
                }

                return $return;
            }

            public function class_field_callback( $field, $value ) {
                print_r( $field );
                echo '<br/>CLASS CALLBACK';
                print_r( $value );
            }

        }

        global $reduxConfig;
        $reduxConfig = new Redux_Framework_sample_config();
    } else {
        echo "The class named Redux_Framework_sample_config has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ):
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    endif;

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ):
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error = true;
            $value = 'just testing';

            /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            
          }
         */

            $return['value'] = $value;
            $field['msg']    = 'your custom error message';
            if ( $error == true ) {
                $return['error'] = $field;
            }

            return $return;
        }
    endif;



if (!function_exists('optionsCompiler')):

	function optionsCompiler() {
		generate_options_css();
	}
	add_action('redux-compiler-goldenworks', 'optionsCompiler');

endif;