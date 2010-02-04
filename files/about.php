<?
$in_php = true;

$page_maintitle = "About";
if($_GET['section'] == 'oliver') {
	$page_subtitle = "Oliver Zheng";
} else if ($_GET['section'] == 'resume') {
	$page_subtitle = "Resum&eacute;";
} else {
	$page_subtitle = '';
}
require_once("./inc/header.php");
if($_GET['section'] == 'oliver') {
?>
<h2>About Oliver</h2>
<p>Just in the slightest case of you wondering the true power of the universe, I'm Oliver Zheng, the author of MTsix. Not that I don't have much to write about, which I'm sure I should, this short list of key points will reveal my deepest secrets to you.</p>
<h3>Online Involvement</h3>
<p>As you are probably aware of that this site is "online", I am deeply involved in the dirty angst of this Internet business. After I joined the underground market in the millennium, I started getting more into the development of this absurd communication route.</p>
<p>HTML, Flash, Graphics, and all the other amateur jazz bored me pretty quickly. I came to styling in xhtml and dynamic scripting with PHP for a piece of true mind. And so the journey began with my awesome coding skills..</p>
<h3>Reality</h3>
<p>Currently attending <a href="http://ubc.ca">University of British Columbia</a>, I'm enrolled in first year Engineering. If you see me drinking beer and/or partying, join right in because Engineers RULE!<p>
<p><em>September 22, 2005</em></p>
<?
} else if ($_GET['section'] == 'resume') {
?>
<h2>Resum&eacute;</h2>
<p>Here are a couple of resum&eacute;s that will hopefully satisfy your requirements. They are provided in several formats. Please email me if additional information is needed.</p>
<p><strong>Scholarship Resum&eacute;</strong>
<ul>
<li><a href="/resume/">View Online</a> (.html)</li>
<li><a href="/resume/resume.swf">View Online</a> (.swf)</li>
<li><a href="/resume/resume.pdf">Adobe Acrobat</a> (.pdf)</li>
<li><a href="/resume/resume.txt">Text Document</a> (.txt)</li>
<li><a href="/resume/resume.doc">Microsoft Word</a> (.doc)</li>
</ul></p>
<?
} else {
?>
<h2>About MTsix</h2>
<p>The beginning was nothing more than a few scraps of kilobytes of code here and there. As it grew, it needed to be managed. The collections of functions of objects together created this clean, unaltered page.</p>
<p>MTsix.com is my personal site. Bothered by the messiness of the files I've created overtime, I decided to put them onto a site where my growing <strong>portfolio of motion graphics and coding work</strong> can be found. Also to keep the viewers from crying from boredom, I also added a <strong>blog</strong>, one that updates everyday, or at least every once in awhile.. when I feel like it.</p>
<h3>Technicality</h3>
<p>This site is one hundred percent powered by <a href="http://www.php.net">PHP</a> and <a href="http://www.mysql.com">MySQL</a>. Proud as anyone who uses php, I crafted this shaft with complete automation. The directories you see in the URI bar are all generated from the .htaccess file.</p>
<p>The front-end of every page is (mostly) XHTML and CSS validated. Because of my use of Javascript to validate forms, not every element adheres to the rules of the Big Brothers. </p>
<?
}
$sidebar_html =<<<END_HTML
<p>About</p>
<ul>
	<li><a href="/about/">MTsix</a></li>
	<li><a href="/about/oliver/">Oliver Zheng</a></li>
	<li><a href="/about/resume/">Resum&eacute;</a></li>
	<li><a href="/contact/">Contact</a></li>
</ul>
END_HTML;

require_once ("./inc/footer.php");
?>
