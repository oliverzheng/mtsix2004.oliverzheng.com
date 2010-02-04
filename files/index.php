<?

require('./wp-blog-header.php');
$notepad = true;
$in_php = true;


if(isset($_GET['m']) || isset($_GET['w']) || isset($_GET['p']) || isset($_GET['s']) || isset($_GET['cat']) || isset($_GET['author']) || isset($_GET['page']) || isset($_GET['category_name']) || isset($_GET['feed']) || isset($_GET['author_name']) || isset($_GET['year']) || isset($_GET['monthnum']) || isset($_GET['day']) || isset($_GET['name'])) {
	$sidebar = 'notepad';
	$sidebar_html1 =<<<END_HTML
<p>Notepad</p>
<ul>
	<li><a href="/notepad/">Recent Posts</a></li>
	<li><a href="/feed/rss2/" title="Syndicate this site using RSS"><abbr title="Really Simple Syndication">RSS</abbr> 2.0</a></li>
</ul>
<p>Search</p>
<ul><li>
<form id="searchform" method="get" action="/notepad/">
<input type="text" name="s" id="s" size="15" /></form>
</li></ul>
<p>Categories</p>
<ul>
END_HTML;
	$sidebar_html2 =<<<END_HTML
</ul>
<p>Archive</p>
<ul>
END_HTML;
	$sidebar_html3 =<<<END_HTML
</ul>
END_HTML;
$page_maintitle = "Notepad";
} else {
	$sidebar_html =<<<END_RIGHT_HTML
<p>MTsix</p>
<ul>
	<li><a href="/index.php">Home</a></li>
	<li><a href="/notepad/">Notepad</a></li>
	<li><a href="/work/">Work</a></li>
	<li><a href="/about/">About</a></li>
	<li><a href="/contact/">Contact</a></li>
</ul>
END_RIGHT_HTML;
$page_maintitle = "Home";
$page_footer = "<p id=\"blog_bottom\">To view all entries, please visit <a href=\"/notepad/\">Notepad</a>.</p>";
}
if($_GET['category_name']) {
	$page_subtitle = single_cat_title('', false);
} else {
	$page_subtitle = single_post_title('', false);
}
require_once("./inc/header.php");
?>

<?php if ($posts) : foreach ($posts as $post) : start_wp(); ?>

<div class="entry">
<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>" class="h2"><?php the_title(); ?></a></h2>
<?php the_content(); ?>
<div class="footer"><a href="<?php the_permalink() ?>" title="Permanent Link: <?php the_title(); ?>" class="date"><?php the_time('F j, Y'); ?></a> | <?php comments_popup_link('Reply First', '1 Comment', '% Comments','comments', 'Comments Disabled'); ?><?php wp_link_pages(); ?></div>
<!--
<?php trackback_rdf(); ?>
-->

</div>

<?php include(ABSPATH . 'wp-comments.php'); ?>

<?php endforeach; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?=$page_footer; ?>

<?

require_once ("./inc/footer.php");

?>

