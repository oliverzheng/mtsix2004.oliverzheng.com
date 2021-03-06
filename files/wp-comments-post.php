<?php

require( dirname(__FILE__) . '/wp-config.php' );

function add_magic_quotes($array) {
	foreach ($array as $k => $v) {
		if (is_array($v)) {
			$array[$k] = add_magic_quotes($v);
		} else {
			$array[$k] = addslashes($v);
		}
	}
	return $array;
} 

if (!get_magic_quotes_gpc()) {
	$_POST   = add_magic_quotes($_POST);
	$_COOKIE = add_magic_quotes($_COOKIE);
}

$author = trim(strip_tags($_POST['author']));
if ( preg_match('/&#[0-9]{3};/i', $author) )
	die();

$email = trim(strip_tags($_POST['email']));
if (strlen($email) < 6)
	$email = '';

$url = trim(strip_tags($_POST['url']));
$url = ((!stristr($url, '://')) && ($url != '')) ? 'http://'.$url : $url;
if (strlen($url) < 7)
	$url = '';

$comment = trim($_POST['comment']);

if ( preg_match('/&#[0-9]{3};/i', $comment) )
	die();

$comment_post_ID = intval($_POST['comment_post_ID']);
$user_ip = $_SERVER['REMOTE_ADDR'];


$post_status = $wpdb->get_var("SELECT comment_status FROM $tableposts WHERE ID = '$comment_post_ID'");

if ( empty($post_status) ) {
	// Post does not exist.  Someone is trolling.  Die silently.
	die();
} else if ( 'closed' ==  $post_status ) {
	die( __('Sorry, comments are closed for this item.') );
}

if ( get_settings('require_name_email') && ('' == $email || '' == $author) )
	die( __('Error: please fill the required fields (name, email).') );

if ( '' == $comment )
	die( __('Error: please type a comment.') );
$_tg_postID = 0;
$_tg_postID = $wpdb->get_var("SELECT ID FROM $tableposts WHERE ID = '$comment_post_ID'");
if ( $_tg_postID == 0 )
die( __('Hey now! There is not any post by that id. What do you think you are trying to pull here? If it quacks like a duck, smells like a duck and looks like a duck, then it must be a duck. If it spams like a spammer, smells like a spammer, and looks like spam, then it must be spam! Now beat it before I rat you out') );

$now = current_time('mysql');
$now_gmt = current_time('mysql', 1);


$comment = balanceTags($comment, 1);
$comment = format_to_post($comment);
$comment = apply_filters('post_comment_text', $comment);

// Simple flood-protection
$lasttime = $wpdb->get_var("SELECT comment_date FROM $tablecomments WHERE comment_author_IP = '$user_ip' ORDER BY comment_date DESC LIMIT 1");
if (!empty($lasttime)) {
	$time_lastcomment= mysql2date('U', $lasttime);
	$time_newcomment= mysql2date('U', $now);
	if (($time_newcomment - $time_lastcomment) < 10)
		die( __('Sorry, you can only post a new comment once every 10 seconds. Slow down cowboy.') );
}


// If we've made it this far, let's post.

if(check_comment($author, $email, $url, $comment, $user_ip)) {
	$approved = 1;
} else {
	$approved = 0;
}

$wpdb->query("INSERT INTO $tablecomments 
(comment_post_ID, comment_author, comment_author_email, comment_author_url, comment_author_IP, comment_date, comment_date_gmt, comment_content, comment_approved) 
VALUES 
('$comment_post_ID', '$author', '$email', '$url', '$user_ip', '$now', '$now_gmt', '$comment', '$approved')
");

$comment_ID = $wpdb->get_var('SELECT last_insert_id()');

if (!$approved) {
	wp_notify_moderator($comment_ID);
}

if ((get_settings('comments_notify')) && ($approved)) {
	wp_notify_postauthor($comment_ID, 'comment');
}

do_action('comment_post', $comment_ID);

setcookie('comment_author_' . $cookiehash, $author, time() + 30000000, COOKIEPATH);
setcookie('comment_author_email_' . $cookiehash, $email, time() + 30000000, COOKIEPATH);
setcookie('comment_author_url_' . $cookiehash, $url, time() + 30000000, COOKIEPATH);

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
$location = get_permalink($comment_post_ID);
if ($is_IIS) {
	header("Refresh: 0;url=$location");
} else {
	header("Location: $location");
}

?>

