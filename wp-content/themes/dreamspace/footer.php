<?php global $goldenworks; ?>


<footer class="footer-parent">

	<!-- footer lines decoration -->
	<div class="footer-decoration">
		<div class="fd1"></div>
		<div class="fd2"></div>
		<div class="fd3"></div>
    </div>
    
    
    <?php if(is_page_template('template-comingsoon.php')) { ?>
		
        <?php get_template_part('includes/footer/comingsoon'); ?>
        
	<!-- footer botom --> 
    <div class="fbottom-wrapper">
	    <div class="container">
	        <div class="row">
                    
                <!-- copyright notice -->
                <div class="col-md-12 fcenter-aligned">
                    <?php if( isset($goldenworks['footer-text']) && $goldenworks['footer-text'] ) {
						
						if(function_exists('icl_translate')) {
							echo icl_translate('wpml_custom', 'footer-text', $goldenworks['footer-text']); 
						} else {
							echo $goldenworks['footer-text']; 
						} 
						
                    } else { 
						_e( '&copy; 2014 Dreamspace. All rights reserved. Created by <a href="http://goldenworks.eu">Golden Works</a>.', 'framework' );					
                    } ?>
                </div>   	
                
			</div><!-- end of .row -->                  	
        </div><!-- end of .container -->
    </div><!-- end of .fbottom-wrapper -->

    <?php } else { ?>
    
    
	<!-- footer section -->
	<?php 
	
	if($goldenworks['footer-layout'] == '1') {
		
		get_template_part('includes/footer/1columns'); 
		
	} elseif($goldenworks['footer-layout'] == '2') {
		
		get_template_part('includes/footer/2columns'); 
		
	} elseif($goldenworks['footer-layout'] == '3') {
		
		get_template_part('includes/footer/3columns');
	
	} 
	elseif($goldenworks['footer-layout'] == '4') {
		
		get_template_part('includes/footer/4columns');
		
	}
	?>
    
	<!-- footer botom --> 
    <div class="fbottom-wrapper">
	    <div class="container">
	        <div class="row">
            
	            <?php if($goldenworks['fbottom-display'] == '1') { ?> 
            
                    <!-- copyright notice -->
                    <div class="col-md-6">
                    	<?php if( isset($goldenworks['footer-text']) && $goldenworks['footer-text'] ) { 
							echo $goldenworks['footer-text']; 
						} else {
                            _e( '&copy; 2014 Dreamspace. All rights reserved. Created by <a href="http://goldenworks.eu">Golden Works</a>.', 'framework' );
                        } ?>
                    </div> 
                    
                    <!-- footer menu -->                
                    <div class="col-md-6">
                        <?php wp_nav_menu(array('theme_location' => 'footer-menu', 'depth' => '1', 'menu_class' => 'f-menu', 'container_class' => 'f-menu')); ?>
                    </div>
                
                <?php } else { ?>
                
            		<!-- copyright notice -->
                    <div class="col-md-12 fcenter-aligned">
                    	<?php if( isset($goldenworks['footer-text']) && $goldenworks['footer-text'] ) {
                        	echo $goldenworks['footer-text'];
                        } else {
							_e( '&copy; 2014 Dreamspace. All rights reserved. Created by <a href="http://goldenworks.eu">Golden Works</a>.', 'framework' );					
						} ?>
                    </div>                
                    
                <?php } ?>
                
			</div><!-- end of .row -->                  	
        </div><!-- end of .container -->
    </div><!-- end of .fbottom-wrapper -->
    
	<?php } ?>
    
    <!-- the overlay element for modal windows -->
	<div class="md-overlay"></div>
    
</footer>

<?php wp_footer(); ?>
</body>
</html>