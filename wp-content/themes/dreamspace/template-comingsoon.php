<?php 
/*
Template Name: Coming Soon
*/

get_header();

$countdown_data = array('cs_timer' => $goldenworks['cs_timer']); 
wp_localize_script('countdown-call', 'countdown_data', $countdown_data);	

?>


<header class="comingsoon-wrapper">
	

    <div class="content-wrapper">
     	
		<?php if ($goldenworks['cs_bg']) { ?>    	
        
        <img src="<?php echo $goldenworks['cs_bg']['url']; ?>" alt="" class="cs-bg" />
        
		<?php } ?>
        
        <div class="container">
    		
            <!-- start logo section -->
            <section class="cs-logo-wrapper">
            	<?php if ($goldenworks['cs_logo']) { ?>
			        <img src="<?php echo $goldenworks['cs_logo']['url']; ?>" alt="" class="cs-logo" />					
				<?php } ?>
            </section>
            <!-- end logo section -->            
            
            <!-- start content title section -->
            <section class="cs-content">
            	<?php if ($goldenworks['cs_content']) {
			        echo do_shortcode($goldenworks['cs_content']);		
				} ?>            
            </section>
            <!-- end content title section -->            
            
            
	        <!-- start countdown timer section -->               
            <section class="cs-timer">
                     
                <ul id="countdown">
                    <li>
                        <span class="days">00</span>
                        <div class="clearboth"></div>
                        <p class="timeRefDays capitalization"><?php _e('days', 'framework'); ?></p>
                    </li>
                    <li>
                        <span class="hours">00</span>
                        <div class="clearboth"></div>
                        <p class="timeRefHours capitalization"><?php _e('hours', 'framework'); ?></p>
                    </li>
                    <li>
                        <span class="minutes">00</span>                    
                        <div class="clearboth"></div>
                        <p class="timeRefMinutes capitalization"><?php _e('minutes', 'framework'); ?></p>
                    </li>
                    <li>
                        <span class="seconds">00</span>
                        <div class="clearboth"></div>
                        <p class="timeRefSeconds capitalization"><?php _e('seconds', 'framework'); ?></p>
                    </li>
                </ul>
       
            </section>
        	<!-- end countdown timer section -->         
            
                        
            <section class="cs-form">
            
            <?php //echo do_shortcode('[wysija_form id="1"]'); ?>
            
            	<?php if (isset($goldenworks['cs_form']) && $goldenworks['cs_form']) {
			        echo do_shortcode($goldenworks['cs_form']);		
				} ?>               
            
            </section>
            
            <!-- start description section -->
            <section class="cs-misc">
            
            	<?php if ($goldenworks['cs_desc']) {
			        echo do_shortcode($goldenworks['cs_desc']);		
				} ?>             
            
            </section>            
            <!-- end description section -->            
                
        </div>
        
	</div>

</header>



<?php get_footer(); ?>