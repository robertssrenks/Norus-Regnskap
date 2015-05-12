<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'framework') ?></p>
	<?php
		return;
	}
?>

<?php
function gwtheme_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>

<li <?php comment_class('comment-block'); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="comment-border">
		<div class="comment-author vcard">
			<span class="small_frame"><?php echo get_avatar($comment,$size='80'); ?></span>     
            <div class="comment-misc">
                <cite><?php comment_author_link(); ?></cite>
            </div>  
		</div>
        
        <div class="comment-content">             
            <span class="date">
				<?php _e('Posted on ', 'framework'); comment_date('M d, Y'); _e(' at ', 'framework'); comment_date('g:i A'); ?>
            </span> 
            
            <div class="cc-wrapper">
				<?php if ($comment->comment_approved == '0') : ?>
                    <em class="awaiting_moderation"><?php _e('Your comment is awaiting moderation.', 'framework') ?></em>
                    <div class="clearboth"></div>
                <?php endif; ?>            
                <?php comment_text(); ?> 
    
                <?php comment_reply_link(array_merge( $args, array('reply_text' => __('reply', 'framework'), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                <?php edit_comment_link(__('edit', 'framework'),'',''); ?>
            </div>  
        </div>
            
	</div>

<?php } ?>

<?php if ( have_comments() ) : ?>

<h4 class="comment-title" id="comments">
	<?php comments_number(__('no comments', 'framework'), __('One comment', 'framework'), __('% comments', 'framework') ); ?>
</h4>

<ol class="commentlist">
	<?php wp_list_comments('callback=gwtheme_comment'); ?>
</ol>


<div class="comments-navigation">
    <div class="cn-left"><?php previous_comments_link() ?></div>
    <div class="cn-right"><?php next_comments_link() ?></div>
</div>

<?php

else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
<span class="meta" id="comments"><?php comments_number('', __('One Response', 'framework'), __('% Responses', 'framework') );?></span>    
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->

	<?php endif; ?>
<?php endif; 


// Comment Form
if ('open' == $post->comment_status) : ?>

<div class="comments-wrapper">
<!-- start respond form -->
	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	<p><?php _e('You must be ', 'framework') ?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', 'framework') ?></a> 
    <?php _e('to post a comment.', 'framework') ?></p>

    <?php else : 

	comment_form('title_reply='.__('Join the discussion', 'framework'));
	
endif; // If registration required and not logged in ?>

</div>
<!--end of respond form -->

<?php endif; ?>