
	<?php if($goldenworks['menu-type'] == 2) { ?>
        <!-- header lines decoration -->
        <div class="footer-decoration">
            <div class="fd1"></div>
            <div class="fd2"></div>
            <div class="fd3"></div>
        </div>
    <?php } ?>

    <div class="menu-wrapper gw-mainmenu <?php echo $halign; ?>">
        <nav class="container">
    
			<?php if( $goldenworks['menu-type'] == 2 ) { ?>


                <!-- desktop alternate menu -->
                <?php wp_nav_menu( array(
                     'theme_location' => 'alternate-menu',
                     'container' =>false,
                     'menu_class' => 'alt-menu',
                     'menu_id' => '',
                     'echo' => true,
                     'before' => '',
                     'after' => '',
                     'link_before' => '',
                     'link_after' => '',
                     'fallback_cb'     => 'wp_page_menu',
                     'depth' => 0)
                ); ?>                 
                    

            <?php } else { ?>
				

                <!-- desktop main menu -->
                <?php wp_nav_menu( array(
                     'theme_location' => 'header-menu',
                     'container' =>false,
                     'menu_class' => 'sf-menu',
                     'menu_id' => '',
                     'echo' => true,
                     'before' => '',
                     'after' => '',
                     'link_before' => '',
                     'link_after' => '',
                     'fallback_cb'     => 'wp_page_menu',
                     'depth' => 0)
                ); ?> 
                             
            <?php } ?>
            
            
        </nav>
    </div>