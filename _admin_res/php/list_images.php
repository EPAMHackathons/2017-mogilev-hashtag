<?php
// files storage folder
$dir = str_replace('\\', '/', dirname(__FILE__));
$dir = str_replace('_admin_res/php', '/images/content/', $dir);

$files = scandir($dir);
$res = array();
foreach ($files as $f) {
	if ($f != '.' && $f != '..')
		$res[] = array('thumb' => '/images/content/'.$f, 'image' => '/images/content/'.$f);
}

echo json_encode($res);
?>