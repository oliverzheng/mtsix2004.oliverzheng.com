<?
$in_php = true;
require_once("./inc/core.php");
$page_maintitle = "Work";

if(!empty($_GET['category'])) {
	$category_exists = mysql_query("SELECT * FROM work_categories WHERE name LIKE '".$_GET['category']."%' LIMIT 0, 1") or die(mysql_error());
	$category = mysql_fetch_array($category_exists) or die(mysql_error());

	if(!empty($_GET['id'])) {
		$project_exists = mysql_query("SELECT COUNT(*) AS numfound FROM work_pro_cat WHERE category_id='".$category['id']."' AND project_id='".$_GET['id']."'");
		$project_exists = mysql_fetch_array($project_exists);
		if($project_exists['numfound'] <= 0) {
			echo 'no project according to category';
		} else {
			$project = mysql_query("SELECT * FROM work_projects WHERE id='".$_GET['id']."'") or die(mysql_error());
			$project = mysql_fetch_array($project) or die(mysql_error());
///// Individual Project Page /////

			$page_subtitle = $project['name'];
			require_once("./inc/header.php");

			$file_path = "/work/".$_GET['category']."/".$_GET['id']."/view/";
			if($project['normal'] == '1') {
				$method = 1;
				$method_display = 'new window';
				if(substr($project['view_url'], 0, 7) != 'http://') {
					$project['view_url'] = $file_path.$project['view_url'];
				}
			} else if ($project['popup'] != '0') {
				$method = 2;
				$method_display = 'popup';
				$popup = explode(",", $project['popup']);
				$project['view_url'] = $file_path.$project['view_url'];
			} else if ($project['fullscreen'] == '1') {
				$method = 3;
				$method_display = 'fullscreen';
				$project['view_url'] = $file_path.$project['view_url'];
			}
			?>
<h2><?=$project['name']; ?></h2>
<p class="title_back"><a href="/work/<?=$_GET['category']; ?>/">&laquo; Return to <?=$category['name']; ?></a></p>

<p><div class="work_view_project"><a href="<?=$project['view_url'];?>" title="View <?=$project['name'];?>" class="view"<?
			switch($method) {
				case 1:
					echo " target=\"_blank\"";
					break;
				case 2:
					echo " onClick=\"return popitup('".$project['view_url']."', ".$popup[0].", ".$popup[1].")\"";
					break;
				case 3:
					echo " onClick=\"return fullScreen('".$project['view_url']."')\"";
					break;
			}
	?>>View Project</a><br /><span>[<?=$method_display; ?><?
	if(!empty($project['size'])) {
		echo ", ".$project['size'];
	} ?>]</span></div>
<?=$project['description']; ?></p>
<?
			if(!empty($project['description2'])) {
?>
<p><?
if($project['screenshot']) {
?><img src="<?=$file_path.$project['screenshot'];?>" class="work_screenshot" alt="<?=$project['name']; ?>" />
<?
}
?><?=$project['description2']; ?></p>
<?
			}
			if(!empty($project['description3'])) {
?>
<p><?
if($project['screenshot2']) {
?><img src="<?=$file_path.$project['screenshot2'];?>" class="work_screenshot" alt="<?=$project['name']; ?>" />
<?
}
?><?=$project['description3']; ?></p>
<?
			}
?>
<ul class="work_quick_facts">
<li><b>Date Completed:</b> <?=$project['date_completed']; ?></li>
<?
if(!empty($project['client'])) {
	?><li><b>Client:</b> <?
	if(!empty($project['client_url'])) {
		?><a href="<?=$project['client_url']; ?>" title="<?=$project['client']; ?> Site"><?
	}
	echo $project['client'];
	if(!empty($project['client_url'])) {
		?></a><?
	}
	?></li><?
}
?>
<li><b>Technology</b>: <?=$project['technology']; ?></li>
</ul>
<?
		}
	} else {
///// Category of Work Page /////

		$page_subtitle = $category['name'];
		require_once("./inc/header.php");

?>
<h2><?=$category['name']; ?></h2>
<p class="title_back"><a href="/work/">&laquo; Return to Work</a></p>
<p class="h2"><?=$category['description']; ?></p>
<?
		$pro_cat = mysql_query("SELECT project_id FROM work_pro_cat WHERE category_id = '".$category['id']."'") or die(mysql_error());
		$sql = "SELECT id, name, thumbnail, description_short FROM work_projects WHERE";
		while($pro_cat_echo = mysql_fetch_array($pro_cat)){
			$sql .= " id='".$pro_cat_echo['project_id']."' OR";
			$projects_exist = true;
		}
		if($projects_exist) {
			$sql .= " id='0' ORDER BY id DESC";
			$projects = mysql_query($sql) or die(mysql_error());
			while ($projects_echo = mysql_fetch_array($projects)) {
	?>
	<div class="work_entry" id="workentry<?=$projects_echo['id']; ?>">
	<h3><a href="/work/<?=$_GET['category']."/".$projects_echo['id']; ?>/"><?=$projects_echo['name']; ?></a></h3>
	<p class="h3"><a href="/work/<?=$_GET['category']."/".$projects_echo['id']; ?>/" class="img" title="<?=$projects_echo['name']; ?>"><img src="/work/<?=$_GET['category']."/".$projects_echo['id']."/view/".$projects_echo['thumbnail']; ?>" alt="<?=$projects_echo['name']; ?>" /></a><?=$projects_echo['description_short']; ?></p>
	</div>
	<?
			}
		} else {
			echo "<p>There are currently no projects in this category.</p>";
		}
	}

} else {
///// Main Work Page /////

	$page_subtitle = "";
	require_once("./inc/header.php");
?>
<h2>Work</h2>
<p>I often work on some personal experiments as well as commercial projects. This is a growing collection of my work, categorized by type and completed date (recent first).</p>
<dl class="work">
<?
	$categories = mysql_query("SELECT * FROM work_categories ORDER BY name ASC") or die(mysql_error());
	while($category_echo = mysql_fetch_array($categories)) {
		$cat_name = explode(" ", $category_echo['name']);
?>
<dt><a href="/work/<?=strtolower($cat_name[0]); ?>/"><?=$category_echo['name']; ?></a></dt>
<dd><?=$category_echo['description']; ?></dd>
<?
	}
?>
</dl>
<?
}


$sidebar_html = <<<END_HTML
<p>Work</p>
<ul>
<li><a href="/work/">Home</a></li>
END_HTML;
$categories = mysql_query("SELECT * FROM work_categories ORDER BY name ASC");
while ($categories_echo = mysql_fetch_array($categories)) {
	$category_name = explode(" ", $categories_echo['name']);
	$sidebar_html .= "<li><a href=\"/work/".strtolower($category_name[0])."/\">".$categories_echo['name']."</a></li>";
}
$sidebar_html .= <<<END_HTML
</ul>
<p>Recent Work</p>
<ul>
END_HTML;
$recent_work = mysql_query("SELECT * FROM work_projects ORDER BY id DESC LIMIT 0,3");
while ($recent_work_echo = mysql_fetch_array($recent_work)) {
	$category = mysql_query("SELECT category_id FROM work_pro_cat WHERE project_id='".$recent_work_echo['id']."'");
	$category = mysql_fetch_array($category);
	$category_name = mysql_query("SELECT name FROM work_categories WHERE id = '".$category[0]."'");
	$category_name = mysql_fetch_array($category_name);
	$category_name = explode (" ", $category_name[0]);
	$sidebar_html .= "<li><a href=\"/work/".substr(strtolower($category_name[0]), 0, 15)."/".$recent_work_echo['id']."/\">".$recent_work_echo['name']."</a></li>";
}
$sidebar_html .=<<<END_HTML
</ul>
END_HTML;
require_once ("./inc/footer.php");
?>

