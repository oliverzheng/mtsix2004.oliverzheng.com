<?php // Do not delete these lines
	if ('wp-comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	$req = get_settings('require_name_email');
	if (($withcomments) or ($single)) {

        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_'.$cookiehash] != $post->post_password) {  // and it doesn't match the cookie
?>
<p><?php _e("Enter your password to view comments."); ?><p>
<?php
				return;
            }
        }

 		$comment_author = (isset($_COOKIE['comment_author_'.$cookiehash])) ? trim($_COOKIE['comment_author_'.$cookiehash]) : '';
        $comment_author_email = (isset($_COOKIE['comment_author_email_'.$cookiehash])) ? trim($_COOKIE['comment_author_email_'.$cookiehash]) : '';
 		$comment_author_url = (isset($_COOKIE['comment_author_url_'.$cookiehash])) ? trim($_COOKIE['comment_author_url_'.$cookiehash]) : '';

        $comments = $wpdb->get_results("SELECT * FROM $tablecomments WHERE comment_post_ID = '$id' AND comment_approved = '1' ORDER BY comment_date");
?>

<?php if ('open' == $post->comment_status) { ?>
<h3 id="comments"><?php comments_number(__("Comments"), __("1 Comment"), __("% Comments")); ?> 
<?php if ('open' == $post->comment_status) { ?>
<a href="#postcomment" title="Leave a comment">&raquo;</a>
<?php } ?>
</h3>
<?php } ?>

<!-- comments -->
<?php if ($comments) { ?>
<ol id="commentlist">
<?php foreach ($comments as $comment) { ?>
	<li id="comment-<?php comment_ID() ?>"><b><?php comment_author_link() ?></b> on <a href="#comment-<?php comment_ID() ?>"><?php comment_date('F j, Y') ?></a>:
	<?php comment_text() ?>
	<p><?php edit_comment_link(__("Edit This"), '&raquo;'); ?></p>
	</li>

<?php } // end for each comment ?>
</ol>
<?php } ?>



<?php if ('open' == $post->comment_status) { ?>
<fieldset id="postcomment"><legend><?php _e("Leave a comment"); ?></legend>
<p>If you would like to comment on this post, please fill in the following form. Line and paragraph breaks are automatic, e-mail address is never displayed.</p>

<form action="<?php echo get_settings('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" onSubmit="return checkContact(this.author, this.email, this.comment, this.submit);">
	<p><label for="author"><?php _e("Name"); ?> (Required)</label><br />
	<input type="text" name="author" id="author" class="text_required" value="<?php echo $comment_author; ?>" size="28" tabindex="1" />
	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
	<input type="hidden" name="redirect_to" value="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" /></p>
	<p><label for="email"><?php _e("E-mail"); ?> (Required, Not Published)</label><br />
	<input type="text" name="email" id="email" class="text_required" value="<?php echo $comment_author_email; ?>" size="28" tabindex="2" /></p>
	<p><label for="url">Website (optional)</label><br />
	<input type="text" name="url" id="url" class="text_optional" value="<?php echo $comment_author_url; ?>" size="28" tabindex="3" /></p>
	<p><label for="comment">Comment (Required):</label><br />
	<textarea name="comment" id="comment" cols="70" class="required" rows="4" tabindex="4"></textarea></p>
	<p>Your IP address is <?=$_SERVER['REMOTE_ADDR']; ?>. So please be nice. :)</p>
	<p><input name="submit" type="submit" id="submit" class="submit" tabindex="5" value="<?php _e("Say it!"); ?>" /></p>
</form>
<p><acronym title="Hypertext Markup Language">HTML</acronym> allowed:</p>
<p><code><?php echo allowed_tags(); ?></code></p>

</fieldset>
<?php } else { // comments are closed ?>
<p>Comments are closed for this entry.</p>
<?php } ?>
<?php // if you delete this the sky will fall on your head
}
?>
