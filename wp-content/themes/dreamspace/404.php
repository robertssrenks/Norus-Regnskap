<?php 

get_header(); 

global $goldenworks;

?>

<section>

    <div class="content-wrapper">

        <div class="container">
			
            <!-- breadcrumbs placeholder -->
			<div class="bc-space"></div>
            
            <div class="content">
				<div class="row">
                
		            <div class="col-md-2">
                    	<img src="<?php echo get_template_directory_uri() . '/images/bullet_deny.png'; ?>" alt="<?php _e('Page Not Found', 'framework'); ?>" class="pnf-img" />
                    </div>      
                    
		            <div class="col-md-10 pnf-content">
                    
                    	<h1><?php _e('404 Page Not Found', 'framework'); ?></h1>
                        
                        <h3><?php _e('Oops! The page your were looking for was not found on the server!', 'framework'); ?></h3>
                        
                        <form role="search" method="get" class="search-form-pnf" action="<?php echo home_url( '/' ); ?>">
                            <label>
                                <span class="screen-reader-text"><?php _e('Maybe try to use a search ?', 'framework'); ?></span>
                                <input type="search" class="search-field" value="" name="s" title="Search for:" />
                            </label>
                            <input type="submit" class="search-submit" value="Submit" />
                        </form>                        

                    </div>                                    

            	</div>
            
   
            </div><!-- end of content -->
            
        </div><!-- end of .container -->
        
    </div><!-- end of .content-wrapper -->
    
</section>

<?php get_footer(); ?>