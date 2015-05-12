    <div class="footer-wrapper">  
		<div class="container">

            <div class="row">
            
            	<!-- widget 1 --> 
                <div class="col-md-4 fbox">
					<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('fsidebar-1') ) : else : ?>

                        <h4><?php _e('footer sidebar 1', 'framework'); ?></h4>
                        <div class="textwidget">
                            <p><?php _e('Currently there are no widgets in Footer Sidebar 1 area. To insert your content here, please drag and drop widgets to this area.', 'framework'); ?></p> 
                        </div>          
            
                    <?php endif; ?>              
                </div>
                
            	<!-- widget 2 -->                
                <div class="col-md-4 fbox">
					<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('fsidebar-2') ) : else : ?>

                        <h4><?php _e('footer sidebar 2', 'framework'); ?></h4>
                        <div class="textwidget">
                            <p><?php _e('Currently there are no widgets in Footer Sidebar 2 area. To insert your content here, please drag and drop widgets to this area.', 'framework'); ?></p> 
                        </div>          
            
                    <?php endif; ?>
                </div>  

                <!-- widget 3 -->  
                <div class="col-md-4 fbox">
					<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('fsidebar-3') ) : else : ?>

                        <h4><?php _e('footer sidebar 3', 'framework'); ?></h4>
                        <div class="textwidget">
                            <p><?php _e('Currently there are no widgets in Footer Sidebar 3 area. To insert your content here, please drag and drop widgets to this area.', 'framework'); ?></p> 
                        </div>          
            
                    <?php endif; ?>                    
                    
                </div>                        
            </div><!-- end of .row -->
            
        </div><!-- end of .container -->
	
    </div><!-- end of .footer-wrapper -->