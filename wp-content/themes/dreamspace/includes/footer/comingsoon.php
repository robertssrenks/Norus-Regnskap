    <div class="footer-wrapper">  
		<div class="container">

            <div class="row">
            
            	<!-- widget 1 --> 
                <div class="col-md-12 fbox fcenter-aligned">
					<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('cssidebar') ) : else : ?>

                        <h4><?php _e('Coming Soon Footer sidebar', 'framework'); ?></h4>
                        <div class="textwidget">
                            <p><?php _e('Currently there are no widgets in Coming Soon Footer Sidebar area. To insert your content here, please drag and drop widgets to this area.', 'framework'); ?></p> 
                        </div>     
            
                    <?php endif; ?>              
                </div>
                                     
            </div><!-- end of .row -->
            
        </div><!-- end of .container -->
	
    </div><!-- end of .footer-wrapper -->