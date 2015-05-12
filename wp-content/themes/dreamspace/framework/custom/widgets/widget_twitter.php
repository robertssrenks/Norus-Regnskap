<?php
/**
 * Twitter Widget Class
 */
class TwitterCustomWidget extends WP_Widget {
    /** constructor */
    function TwitterCustomWidget() {
		global $themename;
		$widget_ops = array('classname' => 'twitter-widget', 'description' => __( 'Displays latest tweets from your twitter account.', 'framework') );
		$this->WP_Widget('twitter', __('GW Twitter', 'framework'), $widget_ops);
    }

    function widget($args, $instance) {	
        extract( $args );
		
		$title = $instance['title'];		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Latest tweets', 'framework') : $instance['title'], $instance, $this->id_base);
		$twitter_name = $instance['twitter_name'];
		
		if ( !$number = (int) $instance['number'] )
			$number = 3;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 12 )
			$number = 12;
        ?>

			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $after_title; 
				

				if(function_exists('getTweets')) {
				
				$tweets = getTweets($number, $twitter_name); 
				?>

				<ul class="twitter-content">

				<?php 
                if(is_array($tweets)){
					
					// to use with intents
					wp_enqueue_script( 'twitter-widget', 'http://platform.twitter.com/widgets.js', array('jquery'), false, true);			
                
					foreach($tweets as $tweet){ ?>
						<li>
	                        <div class="gw-tweet-icon">
                            	<i class="fa fa-twitter"></i>
                            </div>
                            <div class="gw-tweet">
							<?php
						if($tweet['text']){
							$the_tweet = $tweet['text'];
					
					
							// i. User_mentions must link to the mentioned user's profile.
							if(is_array($tweet['entities']['user_mentions'])){
								foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
									$the_tweet = preg_replace(
										'/@'.$user_mention['screen_name'].'/i',
										'<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
										$the_tweet);
								}
							}
					
							// ii. Hashtags must link to a twitter.com search with the hashtag as the query.
							if(is_array($tweet['entities']['hashtags'])){
								foreach($tweet['entities']['hashtags'] as $key => $hashtag){
									$the_tweet = preg_replace(
										'/#'.$hashtag['text'].'/i',
										'<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
										$the_tweet);
								}
							}
					
							// iii. Links in Tweet text must be displayed using the display_url field in the URL entities API response, and link to the original t.co url field.
							if(is_array($tweet['entities']['urls'])){
								foreach($tweet['entities']['urls'] as $key => $link){
									$the_tweet = preg_replace(
										'`'.$link['url'].'`',
										'<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
										$the_tweet);
								}
							}
					
							echo $the_tweet;
					
							// 3. Tweet Timestamp
							//    The Tweet timestamp must always be visible and include the time and date. e.g., “3:00 PM - 31 May 12”.
							// 4. Tweet Permalink
							//    The Tweet timestamp must always be linked to the Tweet permalink.
							echo '
							<p class="tw-timestamp">
								<a href="https://twitter.com/'.$twitter_name.'/status/'.$tweet['id_str'].'" target="_blank">'.date('M d Y h:i A',strtotime($tweet['created_at'])).'</a>
							</p>';
							
							
							// 5. Tweet Actions
							echo '
							<div class="twitter_intents">
								<p><a title="reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'"><i class="icon-reply"></i></a></p>
								<p><a title="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'"><i class="icon-retweet"></i></a></p>
								<p><a title="favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'"><i class="icon-star"></i></a></p>

							</div>';							
							
						} else { ?>
							<a href="http://twitter.com/<?php echo $twitter_name; ?>"><?php _e('Click here to read the twitter feed', 'framework'); ?></a>
							<?php
						} ?>
                        
                        </div><!-- end of .gw-tweet -->
					</li><?php
					}// end of foreach
					
                }// end of is_array
                ?>
                
				</ul>

                
				<?php } else { ?>
	                <ul class="twitter-content">
					<li><?php _e('Please install the oAuth Twitter Feed for Developers plugin to have a working twitter widget.', 'framework'); ?></li>
                    </ul>
				<?php } ?>                
                
			<?php echo $after_widget; ?>

        <?php
    }

    function update($new_instance, $old_instance) {				
        $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter_name'] = strip_tags($new_instance['twitter_name']);
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
    }

    function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$twitter_name = isset($instance['twitter_name']) ? esc_attr($instance['twitter_name']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 3;
        ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('twitter_name'); ?>"><?php _e('Twitter username:', 'framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('twitter_name'); ?>" name="<?php echo $this->get_field_name('twitter_name'); ?>" type="text" value="<?php echo $twitter_name; ?>" /></p>
			
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of tweets:', 'framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>

        <?php 
    }

}

//add_action('widgets_init', create_function('', 'return register_widget("TwitterCustomWidget");'));
?>