</div>
</div>
<hr class="hide" />
<div id="right">
<div id="sidebar">
<div id="sidebar_menu"><?
if($sidebar == 'notepad') {
	echo $sidebar_html1;
	list_cats(0, '', 'name', 'asc', 'index.php', 1, 0, 0, 1, 0, false);
	echo $sidebar_html2;
	wp_get_archives('type=monthly');
	echo $sidebar_html3;
} else {
	echo $sidebar_html;
}
?></div>
</div>
<div id="extra">
<div id="extra_menu">
<a href="/history/" class="subtitle">Click History</a>
<ul>
<?
if ($page_history_count >= PAGE_HISTORY_NUMBER) {
	$counter = PAGE_HISTORY_NUMBER;
} else {
	$counter = $page_history_count;
}

if($counter!=0) {
	$new_counter = 0;
	while ($new_counter < $counter ) {
		$number = $page_history_count-$new_counter;
		?>
		<li><a href="<?=$_SESSION['history'][$number]['url']; ?>" title="Link visited at <?=$_SESSION['history'][$number]['time'];?>">
		<?=substr($_SESSION['history'][$number]['subtitle'], 0, 15); ?></a></li>
		<?
		$new_counter++;
	}
} else {
	?>
	<li><a>None</a></li>
	<?
}
?>
</ul>
<a href="/links/" class="subtitle">Friends</a>
<ul>
<?
	$links = mysql_query("SELECT * FROM notepad_links WHERE link_category=4 ORDER BY link_name ASC") or die(mysql_error());
	while ($link = mysql_fetch_array($links)) {
?>
	<li><a href="<?=$link['link_url']; ?>" title="<?=$link['link_description']; ?>" target="_blank"><?=$link['link_name']; ?></a></li>
<?
	}
?>
</ul>
</div>
</div>
<p class="powered_wordpress">Proudly powered by <a href="http://wordpress.org/">WordPress</a><br /><a href="http://livejournal.com/users/deadlymt/">LiveJournal Feed - DeadlyMT</a></p>
</div>
</div>

<div id="main_copyright">
<p>&copy; Copyright 2004 - <?=date("Y"); ?> <a href="http://oliverzheng.com/">Oliver Zheng</a>. All rights reserved.</p>
</div>

</div>
</body>
</html>
<?
//@include_once($_SERVER["DOCUMENT_ROOT"]."/stats/phpcounter.php");
//@include_once($_SERVER["DOCUMENT_ROOT"]."/shortstat/inc.stats.php");
?>
