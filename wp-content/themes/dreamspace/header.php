<?php global $goldenworks; ?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="robots" content="index, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    
    <?php if (isset($goldenworks['custom_favicon']['url'])) { echo '<link rel="icon" href=" '. $goldenworks['custom_favicon']['url'] .' " />'; } ?>
    
    <?php wp_head(); ?>
</head>


<body <?php body_class(); ?> id="top">

<?php if($goldenworks['display-loader'] == 1) { ?>
<!-- Preloader -->
<div id="spinner"></div>
<?php } ?>


<?php if( !is_page_template('template-comingsoon.php') ) { ?>

<header>

	<?php /* header alignment */
		$halign	= '';
		$logo_col = 4;
		if ($goldenworks['header-align'] == '2') {
			$logo_col = 12;
			$halign = 'hcenter-aligned';
		}
	?>
	    
    <div class="header-wrapper <?php echo $halign; ?>">
        
        <div class="container">
            <div class="row">
                
                <!-- logo -->
                <div class="col-md-<?php echo $logo_col; ?>" id="logo">
                    
                <?php if (isset($goldenworks['custom_logo']['url']) && $goldenworks['custom_logo']['url']) { ?>
                     <a href="<?php echo home_url(); ?>"><img src="<?php echo $goldenworks['custom_logo']['url'] ?>" alt="<?php bloginfo('name'); ?>" /></a>
                <?php } else { ?>
                    <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" /></a>					
                <?php } ?>                  
                    
                </div>
                
                <!-- header info: search + social media + email + phone -->
                <div class="col-md-8 hcenter-hide">
                    <div class="header-info">

						<?php
						if($goldenworks['hsocial-icons'] == 1 ) { 
							get_template_part('includes/socialmedia_top');
						}
						?>
						
						<?php if($goldenworks['hsearch'] == 1 ) { ?>
                        
                        <div class="tsearch-wrapper">
                        	<?php get_search_form(); ?>
                        </div> 
                                               
                        <?php } ?>
                        
                        
                    	<div class="clearboth"></div>
                        
                        <?php if ( isset($goldenworks['hemail']) || isset($goldenworks['hphone'] )  || $goldenworks['hlang-switcher'] == 1 ) { ?>
                        <div class="hmisc-wrapper">
                        
							<?php if( $goldenworks['hlang-switcher'] == '1' ) { ?>
                                <div class="lang-wrapper">
                                    <?php do_action('icl_language_selector'); ?>
                                </div>
                            <?php }	?>                      
                        
    	                    <?php if ( isset($goldenworks['hemail']) && $goldenworks['hemail'] ) { ?>
                            	<div class="hemail"><i class="fa fa-envelope"></i><a href="mailto:<?php echo $goldenworks['hemail']; ?>"><?php echo $goldenworks['hemail']; ?></a></div>
                            <?php } ?>
                            
                            <?php if ( isset($goldenworks['hphone']) && $goldenworks['hphone']) { ?>
		                        <div class="hphone"><i class="fa fa-phone"></i><?php echo esc_html($goldenworks['hphone']); ?></div>
                            <?php } ?>
                            
                        </div>
                        <?php } ?>
                        
                    </div><!-- end of .header-info -->
                </div>
                
            </div><!-- end of .row -->
            
        </div><!-- end of .container -->
                
    </div><!-- end of .header-wrapper -->
    
    
	<div class="menu-parent">
		<?php include(locate_template('includes/menu_section.php')); ?>
	</div>
    

</header>

<?php } ?>