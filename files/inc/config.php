<?
if (!$in_php) {
	die('hacking attempt');
	exit();
}
// MySQL Config
define ("MYSQL_HOST", "CONFIG_DB_HOST");
define ("MYSQL_USER", "CONFIG_DB_USER");
define ("MYSQL_PASS", "CONFIG_DB_PASSWORD");
define ("MYSQL_DB", "CONFIG_DB_NAME");

//Page layout config
define ("SITE_TITLE_FRONT", "");
define ("SITE_TITLE_BACK", " - mtsix | Oliver Zheng");
define ("SITE_TITLE_CONNECTOR", " - ");
define ("PAGE_HISTORY_NUMBER", 3);
?>
