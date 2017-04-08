<?

/**
 * array $fields contains values (raw) in the same format as it's stored in DB
 *    any convert routines must be placed in getters/setters
 *    default values for initilialasing fields must be placed in set_defaults
 */
class db_row
{
	var $fields;
	var $table;
	var $pri_key;
	var $autoinc; //is primary key autouincremented
	var $last_error;
	var $use_db;

	var $parent_key; //parent key field - used for positioning

	//*** constuctor  ***//
	function __construct($id = NULL)
	{
		if (empty($this->use_db)) $this->use_db = false; //use default connection
		//load initial values
		if (!is_null($id)) {
			$values = db_getRow("SELECT * FROM $this->table WHERE $this->pri_key = '$id'", $this->use_db);
			if ($values === false) { //record not found 
				$this->last_error = 1;
			} else {
				foreach ($values as $k => $v) {
					$this->fields[$k] = $v;
				}
			}
		}
	}

	//*** set fields from array ***//
	function from_array($a)
	{
		foreach ($this->fields as $k => $v) {
			if (!isset($a[$k])) continue;
			if (method_exists($this, 'set_' . $k)) {
				call_user_func(array($this, 'set_' . $k), $a[$k]);
			} else {
				$this->fields[$k] = $a[$k];
			}
		}
	}

	//*** set fields from mysql result (raw data) ***//
	function from_raw($a)
	{
		foreach ($a as $k => $v) {
			$this->fields[$k] = $v;
		}
	}

	//*** return fields as array ***//
	function to_array($dont_get_more = false)
	{

		$res = array();
		foreach ($this->fields as $k => $v) {
			if (method_exists($this, 'get_' . $k)) {
				$res[$k] = call_user_func(array($this, 'get_' . $k));
				$res['raw_' . $k] = $v; //raw data from DB
			} else {
				$res[$k] = $this->fields[$k];
			}
		}
		if (!$dont_get_more && method_exists($this, 'get_more_data')) $res = array_merge($res, call_user_func(array($this, 'get_more_data')));
		return $res;
	}

	//*** save to DB  ***//
	function save()
	{

		$this->init_fields();
		if (method_exists($this, 'set_defaults')) $this->set_defaults();
		if (empty($this->fields[$this->pri_key])) {
			$sql = "INSERT INTO " . $this->table . " ";
			$vars = $values = array();
			foreach ($this->fields as $k => $v) {
				if (is_null($v)) continue; //ignore unset values
				if ($k == $this->pri_key && $this->autoinc == 1) continue; //ignore primary key if it's autoincrement
				$vars[] = '`' . $k . '`';
				$values[] = $v;
			}
			$vars_sql = implode(',', $vars);
			$values_sql = "'" . implode("','", $values) . "'";
			$sql = "INSERT INTO " . $this->table . " ($vars_sql) VALUES ($values_sql)";
//			echo $sql;			die;
			$id = db_query($sql, $this->use_db);
			//get id of inserted record
			if ($this->autoinc == 1) $this->fields[$this->pri_key] = $id;

			//updating record
		} else {
			$sql = "UPDATE " . $this->table . " SET ";
			$sets = array();
			foreach ($this->fields as $k => $v) {
				if (is_null($v)) continue; //ignore unset values
				if ($k == $this->pri_key) continue; //ignore primary key
				$sets[] = " `$k` ='$v'";
			}
			$sql .= implode(', ', $sets);
			$sql .= " WHERE $this->pri_key='" . $this->fields[$this->pri_key] . "' ";
			//echo $sql; die;
			db_query($sql, $this->use_db);
		}
		if (method_exists($this, 'save_more_data')) call_user_func(array($this, 'save_more_data'));

		if ($this->has_field('img_fname')) $this->init_img_fname();
		if ($this->has_field('fname')) $this->init_fname();
	}

	//*** delete from DB  ***//
	function delete()
	{
		if ($this->has_field('position')) $this->update_pos_after_delete();

		db_query("DELETE FROM " . $this->table . " WHERE $this->pri_key = '" . $this->fields[$this->pri_key] . "'", $this->use_db);
	}


	//*** COMMON DATA FUNCS
	function init_fields()
	{
		if ($this->has_field('position') && empty($this->fields['position'])) $this->init_position();
		if ($this->has_field('time') && empty($this->fields['time'])) $this->fields['time'] = time();
		if ($this->has_field('url') && empty($this->fields['url']) && !empty($this->fields['title'])) $this->init_URL();

	}

	function has_field($field_name)
	{
		$keys = array_keys($this->fields);
		if (is_array($keys)) foreach ($keys as $k => $v) $keys[$k] = strtolower($v);
		return @in_array($field_name, $keys);
	}


	//*** POSITION
	function init_position()
	{
		$pos = db_getOne("SELECT MAX(position) FROM " . $this->table . " WHERE " . $this->get_positionCondition());
		$pos = (empty($pos)) ? 1 : $pos + 1;
		$this->fields['position'] = $pos;
	}

	function move_up()
	{
		$pos = $this->fields['position'];
		$new = $pos - 1;
		if ($new < 1) $new = 1;
		db_query("UPDATE " . $this->table . " SET position='$pos' WHERE position='$new' AND  " . $this->get_positionCondition());
		db_query("UPDATE " . $this->table . " SET position='$new' WHERE id='" . $this->fields['id'] . "' AND " . $this->get_positionCondition());
	}


	function move_down()
	{
		$pos = $this->fields['position'];
		$max = db_getOne("SELECT MAX(position) FROM " . $this->table . ' WHERE ' . $this->get_positionCondition());
		if ($pos != $max) { //already last
			$new = $pos + 1;
			db_query("UPDATE " . $this->table . " SET position='$pos' WHERE position='$new' AND " . $this->get_positionCondition());
			db_query("UPDATE " . $this->table . " SET position='$new' WHERE id='" . $this->fields['id'] . "' AND " . $this->get_positionCondition());
		}
	}

	function update_pos_after_delete()
	{
		$max = db_getOne("SELECT MAX(position) FROM " . $this->table . ' WHERE ' . $this->get_positionCondition());
		$cur = $this->fields['position'];
		$cur += 1;
		for ($i = $cur; $i <= $max; ++$i) {
			$new = $i - 1;
			db_query("UPDATE " . $this->table . " SET position='$new' WHERE position='$i' " . ' AND ' . $this->get_positionCondition());
		}

		db_query("DELETE FROM " . $this->table . " WHERE id=" . $this->fields['id'] . ' AND ' . $this->get_positionCondition());
	}

	function get_positionCondition()
	{
		$res = " 1 = 1 ";
		if (!empty($this->parent_key)) $res .= " AND `" . $this->parent_key . "` = '" . $this->fields[$this->parent_key] . "' ";
		return $res;
	}

	function rebuild_pos($cat)
	{
		$items = db_getAll("SELECT * FROM " . $this->table . " WHERE `" . $this->parent_key . "` = " . $cat);
		$pos = 0;
		foreach ($items as $i) {
			++$pos;
			$id = $i['id'];
			db_query("UPDATE " . $this->table . " SET position = '$pos' WHERE id = $id");
		}

	}


	// *** URL
	function init_URL()
	{
		if (!empty($this->fields['url'])) return;

		$this->fields['url'] = $this->craft_url();
		$have = db_getOne("SELECT id FROM " . $this->table . " WHERE url = '" . $this->fields['url'] . "'");
		$n = 0;
		while ($have == true) {
			++$n;
			$this->fields['url'] = $this->craft_url($n);
			$have = db_getOne("SELECT id FROM " . $this->table . " WHERE url = '" . $this->fields['url'] . "'");
		}
	}

	function craft_url($n = false)
	{
		$url = '';
		if (!empty($this->url_prefix)) $url = $this->url_prefix;

		$url .= gen_url($this->fields['title']);

		if (!empty($n)) $url .= '-' . $n;

		if (!empty($this->url_postfix)) $url .= $this->url_postfix;
		return $url;
	}

	// *** activation
	function activate()
	{
		db_query("UPDATE " . $this->table . " SET active='1' WHERE id='" . $this->fields['id'] . "'");
	}

	function deactivate()
	{
		db_query("UPDATE " . $this->table . " SET active='0' WHERE id='" . $this->fields['id'] . "'");
	}

	//**** images
	function init_img_fname()
	{

		if (isset($_FILES['new_image']) && !empty($_FILES['new_image']['name'])) {

			$dirName = (empty($this->image_dir)) ? $this->table : $this->image_dir;
			$dir = '/images/' . $dirName . '/';
			@mkdir(DOC_ROOT . $dir);

			$file = $_FILES['new_image'];

			if ($file['error'] != '0') {
				flashbag_put('Ошибка при добавлении картинки', 'error');
				return false;
			}
			$name = $file['name'];
			$tmp = $file['tmp_name'];
			$a = pathinfo($name);
			$ext = strtolower($a['extension']);
			$allowed = array('jpg', 'jpeg', 'gif', 'png');
			if (!in_array($ext, $allowed)) {
				flashbag_put('Нельзя закачать изобрежение с раширением ' . $ext . '. Разрешенные расширения: ' . implode(', ', $allowed), 'error');
				return false;
			}

			$this->remove_image();
			$n = 0;

			$fname = '';
			if (!empty($this->fields['url'])) {
				$fname = pathinfo(basename($this->fields['url']));
				$fname = $fname['filename'];
			} elseif (!empty($this->fields['id'])) $fname = $this->fields['id'];
			else $fname = md5(microtime(true) . rand(1, 10000000));

			$new = $fname . '-' . $n . '.' . $ext;
			while (file_exists(DOC_ROOT . $dir . $new)) {
				++$n;
				$new = $fname . '-' . $n . '.' . $ext;
			}

			if (move_uploaded_file($tmp, DOC_ROOT . $dir . $new)) {
				db_query("UPDATE " . $this->table . " SET img_fname='$new' WHERE id = " . $this->fields['id']);
				resize_im($dir, $new);
			}
		}
	}

	function init_fname()
	{
		return $this->upload_file('fname', 'new_fname', '/files/'.$this->table, array('pdf', 'doc', 'docx', 'rtf', 'xls', 'xlsx', 'zip', 'rar'));
	}

	function remove_file()
	{
		$this->delete_file('fname');
	}

	function remove_image()
	{
		$this->delete_file('img_fname');
	}

	function delete_file($key)
	{
		if (!empty($this->fields[$key])) {
			$dir = '/images/' . $this->table . '/';
			@unlink(DOC_ROOT . $dir . $this->fields[$key]);
			db_query("UPDATE " . $this->table . " SET `" . $key . "`='' WHERE id = " . $this->fields['id']);
		}
	}

	function upload_file($field, $fileKey, $dir, $allowed)
	{
		if (isset($_FILES[$fileKey]) && !empty($_FILES[$fileKey]['name'])) {

			$dir .= '/';
			@mkdir(DOC_ROOT . '/' . $dir);

			$file = $_FILES[$fileKey];

			if ($file['error'] != '0') {
				flashbag_put('Ошибка при добавлении файла ' . $field, 'error');
				return false;
			}

			$info = pathinfo(strtolower($file['name']));
			if (!in_array($info['extension'], $allowed)) {
				flashbag_put('Нельзя закачать файл ' . $field . ' с раширением ' . $info['extension'] . '. Разрешенные расширения: ' . implode(', ', $allowed) . ' ( ' . $file['name'] . ' )', 'error');
				return false;
			}

			if (!empty($this->fields[$field])) {
				@unlink(DOC_ROOT . '/' . $dir . $this->fields[$field]);
				db_query("UPDATE " . $this->table . " SET `" . $field . "`='' WHERE id = " . $this->fields['id']);
			}

			$n = 0;
			$new = gen_url($info['filename']) . '.' . $info['extension'];
			while (file_exists(DOC_ROOT . '/' . $dir . $new)) {
				++$n;
				$new = gen_url($info['filename']) . '-' . $n . '.' . $info['extension'];
			}

			if (move_uploaded_file($file['tmp_name'], DOC_ROOT . '/' . $dir . $new)) {
				db_query("UPDATE " . $this->table . " SET `" . $field . "`='$new' WHERE id = " . $this->fields['id']);
			}

		}

	}

	function escape_fields() {
		foreach ($this->fields as $k=>$v) $this->fields[$k] = mysql_real_escape_string($v);
	}

	/*********** GETTERS & SETTERS section *****************/

}

?>