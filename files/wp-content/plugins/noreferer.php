<?php
/*
Plugin Name: Referrer Bouncer
Plugin URI: http://blog.taragana.com/index.php/archive/word-press-1-5-plugin-referer-bouncer/
Description: Bounce referer spammers back to their own sites. The plugin comes with a list of default sites. However you can <a href="../wp-admin/templates.php?file=%2Fwp-content%2Freferer.txt">modify the referer.txt file</a> to add/remove your referer's(requires that the file is first created either manually or through a link provided later). Do not leave any empty lines or extra spaces in the file. If you have not manually created a file called referer.txt in wp-content directory then you can <a href="../wp-content/plugins/noreferer.php?noreferer_initialize=true">create it here</a>. This creates an empty file. Unless you add some referer data to it (one per line) no filtering will be done. Creating this files disables the default filter list. You can reset to the default filter list by either <a href="../wp-content/plugins/noreferer.php?noreferer_delete=true">deleting this file</a> or copying the <a href="../wp-content/plugins/noreferer.php?noreferer_list=true">default filter list</a> to <a href="../wp-admin/templates.php?file=%2Fwp-content%2Freferer.txt">this file</a>. After you are done with <a href="../wp-content/plugins/noreferer.php?noreferer_initialize=true">creating</a>/<a href="../wp-content/plugins/noreferer.php?noreferer_delete=true">deleting</a> the referer.txt file you *must* <a href="../wp-content/plugins/noreferer.php?noreferer_allset=true">disable the links to create and delete the referer file</a> to prevent outsiders from accessing these functions. You can still <a href="../wp-admin/templates.php?file=%2Fwp-content%2Freferer.txt">modify it</a> as before(if it has already been created before). To re-enable creating/deleting referer.txt you must manually delete nrsetup.txt file in wp-content directory.
Version: 1.1.1
Author: Angsuman Chakraborty
Author URI: http://blog.taragana.com/
Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
Copyright: Angsuman Chakraborty (angsuman@taragana.com)
*/
$file_path = "referer.txt";
$setup_completed_file_path = "nrsetup.txt";
$ref = $_SERVER["HTTP_REFERER"];
// List contents from frenchfragfactory.net/ozh/archives/2005/02/05/no-refer-spam/
$default_spammers = array (
	"terashells.com", "chat-nett.com", "exitq.com", "cxa.de", "sysrem03.com",
	"pharmacy.info", "guide.info", "drugstore.info",
	"coresat.com", "psxtreme.com", "freakycheats.com", "cool-extreme.com",
	"pervertedtaboo.com", "crescentarian.net", "texas-holdem", "fuck-fest", "yelucie.com",
	"poker-online", "findwebhostingnow.com", "smsportali.net", "6q.org", "flowersdeliveredquick.com",
	"ronnieazza", "lemonrider", "future-2000", "trackerom.com", "andrewsaluk.com", "4u.net", "4u.com", "doobu.com",
	"nutzu", "italiancharms", "likejazz", "kloony", "isacommie.com", "musicbox1.com", "tigerspice", "roody.com"
);
$referer_file = (dirname(__FILE__) . '/' . "../" . $file_path);
$referer_setup_completed = (dirname(__FILE__) . '/' . "../" . $setup_completed_file_path);
if(isset($_GET['noreferer_initialize'])) { // Create an empty file
	if(!file_exists($referer_setup_completed) && !file_exists($referer_file)) {
		touch($referer_file);
		chmod($referer_file, 0644);
	}
	header("Location: $ref"); 
	exit();
} if(isset($_GET['noreferer_delete'])) { // Delete	
	if(!file_exists($referer_setup_completed) && file_exists($referer_file)) unlink($referer_file);
	header("Location: $ref"); 
	exit();
} if(isset($_GET['noreferer_list'])) { // Default List; This is visible to one and all
	foreach ($default_spammers as $spammer) {
		echo $spammer . '<br/>';
	}
	exit();
} if(isset($_GET['noreferer_allset'])) { // Make the above functions unmodifiable.	
	if(!file_exists($referer_setup_completed)) {
		touch($referer_setup_completed);
		chmod($referer_setup_completed, 0644);
	}
	header("Location: $ref");
	exit();	
} else { // Scan for referer's and bounce appropriately
	$referer_file = (ABSPATH . "wp-content/" . $file_path);
	$ref = $_SERVER["HTTP_REFERER"];
	if ($ref) {
		if (!file_exists($referer_file)) {
			$spammers = $default_spammers;
		} else {
			$spammers = file($referer_file);
		}
        $ref = trim($ref);
		foreach ($spammers as $site) {
            $site = trim($site);            
			$pattern = "/$site/i";
			if (preg_match ($pattern, $ref)) {
				header("Location: $ref"); exit();
			}
		}
	}
}
?>