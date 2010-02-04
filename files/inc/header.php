<?
if(!$in_php) {
	die("hacking attempt");
	exit();
}

if(!$core_required) {
	require_once ("core.php");
}

///// SET SESSIONS FOR HSTORY /////

$page_subtitle_original = $page_subtitle;
$page_title = SITE_TITLE_FRONT;
if(!empty($page_subtitle)) {
	$page_title .= $page_subtitle.SITE_TITLE_CONNECTOR;
} else {
  	$page_subtitle = $page_maintitle;
}
$page_title .= $page_maintitle.SITE_TITLE_BACK;
$page_history_count = count($_SESSION['history']);
$_SESSION['history'][$page_history_count+1]['maintitle'] = $page_maintitle;
$_SESSION['history'][$page_history_count+1]['subtitle'] = $page_subtitle;
$_SESSION['history'][$page_history_count+1]['subtitle_original'] = $page_subtitle_original;
$_SESSION['history'][$page_history_count+1]['url'] = $_SERVER['REQUEST_URI'];
$_SESSION['history'][$page_history_count+1]['time'] = date("g:i A");
$_SESSION['history'][$page_history_count+1]['date'] = date("F d");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?= $page_title; ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="mtsix, oliver zheng, mtsoul, shijie zheng, oliver zheng's work, flash games, actionscript, php projects, sound loops, sound effects, oliver's blog, transition program" />
<meta name="description" content="mtsix.com - a collection of a blog entries and online projects of Oliver Zheng, aliased MTsoul." />
<meta name="robots" content="index,follow" />
<link rel="shortcut icon" href="http://mtsix.com/favicon.ico" />
<link rel="stylesheet" type="text/css" media="screen" href="/style.css" />
<?
if($notepad) {
?>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<? wp_get_archives('type=monthly&format=link'); ?>
<? wp_head(); ?>
<?
}
?>
<script type="text/javascript" src="/scripts.js"></script>

</head>

<body>

<div id="wrap">
<div id="header">
	<p><a href="#content">&raquo; Skip To Content</a></p>
	<div id="caption">
	<h1><a href="/index.php" title="mtsix - home">mtsix</a></h1>
	</div>
	<ul>
		<li id="home"><a href="/index.php">Home</a></li>
		<li id="experiments"><a href="/notepad/">Notepad</a></li>
		<li id="projects"><a href="/work/">Work</a></li>
		<li id="about"><a href="/about/">About</a></li>
		<li id="contact"><a href="/contact/">Contact</a></li>
	</ul>
</div>

<div id="main">
<div id="content">
<div id="text">
