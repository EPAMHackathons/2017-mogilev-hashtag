<?php
require_once('../../include/init.inc.php');
if (empty($_SESSION['admin_user'])) die('xx');

$table = $_GET['table'];
$data = json_decode($_SERVER['us_GET']['data'], true);

foreach ($data as $id => $pos) {
	$id = intval($id);
	$pos = intval($pos);
	db_query("UPDATE `$table` SET `position`='$pos' WHERE id='$id'");
}

?>