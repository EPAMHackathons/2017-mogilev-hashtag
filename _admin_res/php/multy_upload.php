<?php
require_once('../../include/init.inc.php');
if (empty($_SESSION['admin_user'])) die('xx');

$allowed_tables = array('album_images');
$table = $_REQUEST['table'];
if (!in_array($table, $allowed_tables)) die('22');

$id = intval($_REQUEST['id']);

if ($table == 'album_images') {
	$o = new album_images();
	$o->fields['album_id'] = $id;
	$o->save();

	$fname = db_getOne("SELECT img_fname FROM album_images WHERE id = " . $o->fields['id']);
	if (!empty($fname)) {
		$res = array('img' => '/images/album_images/' . $fname, 'id' => $o->fields['id']);
		echo json_encode($res);
		die;
	}
}

$res = array('error' => 1);
echo json_encode($res);
?>