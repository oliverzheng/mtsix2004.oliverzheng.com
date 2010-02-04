<?
$in_php = true;

if($_GET['section'] == 'history') {
	$page_maintitle = "Click History";
} else if ($_GET['section'] == 'links') {
	$page_maintitle = "Links";
}
$page_subtitle = '';

require_once("./inc/core.php");

if ($_GET['section'] == 'history') {
///// CLICK HISTORY /////

	if ($_POST['submit'] == 'Clear the List') {
		unset($_SESSION['history']);
		header ("Location: /history/");
		exit();
	}

require_once("./inc/header.php");
?>
<h2>Click History</h2>
<p>You've visited many pages on this site. Don't know where you've been? Here's a list of links that has been stored in your session of visit. Click Clear the List to clear all session cookies.</p>
<ol>
<?
for ($i=count($_SESSION['history']);$i>0;$i--) {
?>
	<li><?
	if($_SESSION['history'][$i]['date'] == date("F d")) {
		echo "<b>Today</b>";
	} else {
		echo $_SESSION['history'][$i]['date'];
	}
	?> <?=$_SESSION['history'][$i]['time']; ?> &raquo; <a href="<?=$_SESSION['history'][$i]['url']; ?>"><?
	if(!empty($_SESSION['history'][$i]['subtitle_original'])) {
		echo $_SESSION['history'][$i]['subtitle_original']." - ";
	}
	?><?=$_SESSION['history'][$i]['maintitle']; ?></a></li>
<?
}
?>
</ol>
<form action="/history/" method="post"><input type="submit" value="Clear the List" name="submit" id="submit" class="submit" /></form>
<?
} else if ($_GET['section'] == 'links') {
require_once("./inc/header.php");
///// LINKS /////
?>
<h2>Links</h2>
<p>There are many resourceful and flashy sites out there. I've bookmarked a few here. If you come across a great site, please email me and I'll gladly add it.</p>
<?
	$link_categories = mysql_query("SELECT * FROM notepad_linkcategories ORDER BY cat_id ASC") or die(mysql_error());
	while ($link_cat = mysql_fetch_array($link_categories)) {
		echo "<h3>".$link_cat['cat_name']."</h3>\n<dl class=\"links\">\n";
		$links = mysql_query("SELECT * FROM notepad_links WHERE link_category='".$link_cat['cat_id']."' ORDER BY link_name ASC") or die(mysql_error());
		while ($link = mysql_fetch_array($links)) {
			$link['link_description'] = str_replace("\'", "'", $link['link_description']);
			echo "<dt><a href=\"".$link['link_url']."\" title=\"".$link['link_description']."\" target=\"_blank\">".$link['link_name']."</a></dt><dd>".$link['link_description']."</dd>\n";
		}
		echo "</dl>";
	}
}


$sidebar_html =<<<END_HTML
<p>Misc.</p>
<ul>
	<li><a href="/history/">Click History</a></li>
	<li><a href="/links/">Links</a></li>
</ul>
END_HTML;

require_once ("./inc/footer.php");

?>