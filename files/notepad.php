<?
$page_maintitle = "Notepad";
$page_subtitle = "";
require_once("./inc/header.php");
?>
<div class="entry">
<h3>Test Entry Today!</h3>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nulla urna dolor, accumsan nec, congue vitae, tincidunt sed, est. Duis vel magna. Suspendisse nibh. Sed nulla. Sed non ligula nec nunc egestas convallis. Phasellus mollis ligula nec sem. Aliquam est turpis, molestie id, ornare sit amet, hendrerit vel, lorem. Cum sociis natoque penatibus et ma</p>
<p>Anchored link - <a href="#">Linkie Click Me</a></p>
<blockquote cite="#">Quote me ablaskdjflaskfjalsdfjalsdfjasdfsd asdf asd fds d asd fasd fasd fasd sd  </blockquote>

<p>unordered list - </p>
<ul>
<li>first list</li>
<li>also first list</li>
</ul>
<p>ordered list - </p>
<ol>
<li>first list</li>
<li>second list</li>
</ol>
<p><a href="#" class="images"><img src="./images/emotioneric.jpg" /></a></p>
<p><code>&lt;?php
<br />
&nbsp;&nbsp;&nbsp;&nbsp;php_info();
<br />
&nbsp;&nbsp;&nbsp;&nbsp;echo &quot;hello world&quot;;
<br />
?&gt;
</code>
</p>
<div class="footer"><a href="#" class="date">November 3, 2004</a> | <a href="#" class="comments">2 Comments</a></div>
</div>
<div class="entry">
<h3>Test Entry Today!</h3>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nulla urna dolor, accumsan nec, congue vitae, tincidunt sed, est. Duis vel magna. Suspendisse nibh. Sed nulla. Sed non ligula nec nunc egestas convallis. Phasellus mollis ligula nec sem. Aliquam est turpis, molestie id, ornare sit amet, hendrerit vel, lorem. Cum sociis natoque penatibus et ma</p>
<p>Morbi accumsan dolor eget enim. Praesent aliquam, pede imperdiet semper dapibus, mauris mauris congue eros, nec iaculis metus ante congue risus. Duis neque. Cras tempus. Mauris consectetuer posuere sapien. Pellentesque egestas rutrum enim. Praesent </p>
<p>Sed at nulla commodo leo tristique pharetra. Quisque id nibh. Suspendisse eu eros. Cras vel purus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi quis sapien. Fusce tristique, justo pellentesque gravida auctor, dolor leo eleifend tortor, eget euismod pede nisl a quam. Morbi quis arcu id tellus tristique cursus. Nunc dictum turpis ac metus. Donec nonummy, felis vel sodales imperdiet, sapien magna convallis mi, ulla</p>
<div class="footer"><a href="#" class="date">November 3, 2004</a> | <a href="#" class="comments">2 Comments</a></div>
</div>
</div>

<?
$sidebar_html =<<<END_HTML
<p>Home</p>
<ul>
	<li><a href="#">Profile</a></li>
	<li><a href="#">Recent Work</a></li>
	<li><a href="#">Ladida</a></li>
</ul>
<p>Blog</p>
<ul>
	<li><a href="#">November Archive</a></li>
	<li><a href="#">October Archive</a></li>
	<li><a href="#">September Archive</a></li>
</ul>
END_HTML;

require_once ("./inc/footer.php");
?>