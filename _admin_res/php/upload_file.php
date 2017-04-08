<?
require_once('../../include/init.inc.php');
if (empty($_SESSION['admin_user'])) die('xx');

$name = gen_url($_FILES['file']['name']);
$a = pathinfo($_FILES['file']['name']);
$ext = strtolower($a['extension']);
$allowed = array('pdf', 'xls', 'xlsx', 'doc', 'docx', 'rtf', 'zip', 'rar');

if (in_array($ext, $allowed)) {
	$new_name = gen_url($a['filename']);
	$new = $new_name . '.' . $ext;
	$n = 0;
	while (file_exists(DOC_ROOT . '/files/content/' . $new)) {
		++$n;
		$new = $new_name . '-' . $n . '.' . $ext;
	}

	if (move_uploaded_file($_FILES['file']['tmp_name'], DOC_ROOT . '/files/content/' . $new)) {
		$array = array(
			'filelink' => '/files/content/' . $new,
			'filename' => $new
		);
		echo stripslashes(json_encode($array));
		die;
	}

}
$array = array(
	'error' => 1
);



echo stripslashes(json_encode($array));
?>