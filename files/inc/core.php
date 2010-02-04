<?
if(!$in_php) {
	die("hacking attempt");
	exit();
}

ini_set('session.use_only_cookies', '1');
ini_set('session.use_trans_sid', '0');
ini_set('session.use_only_cookies', true);
ini_set('session.use_trans_sid', false);

session_start();
require_once ("config.php");

if(!mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS)) {
	die ("Error connecting the database. <br />".mysql_error());
} else if (!mysql_select_db(MYSQL_DB)) {
	die ("Error selecting the database. <br />".mysql_error());
}
$core_required = true;
?>