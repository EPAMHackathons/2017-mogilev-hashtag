<?
	class admin_users extends db_row {
		
		function __construct($id = NULL) {
			//$this->use_db = DB_USERS_NAME;
			$this->table = 'admin_users';
			$this->pri_key = 'id';
			$this->autoinc = 1;
			//$this->parent_key = 'parent_id';


			$this->fields['id'] = NULL;
			$this->fields['login'] = NULL;
            $this->fields['active'] = NULL;
			$this->fields['pwd'] = NULL;
			$this->fields['is_root'] = NULL;
			$this->fields['permissions'] = NULL;
            $this->fields['signature'] = NULL;

            parent::__construct($id);
		}


		function has_permission( $req = '' ) {
			if ( !empty($this->fields['is_root']) ) return true;

			if (empty($req)) {
				$pi = pathinfo($_SERVER['SCRIPT_NAME']);
				$filename = strtolower($pi['filename']);

			} else $filename = $req;

			if ($filename == 'index') return true;

			$perms = explode(',', $this->fields['permissions']);
			if ( in_array($filename, $perms) ) return true;

			return false;
		}

		function isRoot() {
			return (!empty($this->fields['is_root']));
		}


	}

	class admin_users_list extends db_list {

		function __construct() {
			$this->single_element_class = 'admin_users';
			$this->table = 'admin_users';
			$this->sort_by = 'id';
			$this->sort_mode = 'desc';
			$this->items_per_page = 10;
		}

	}


function validate_admin_login($post) {
    $login = $post['admin_login'];
    $pwd = md5( md5( md5( $post['admin_pwd'] . strrev($post['admin_pwd']) )));

    return db_getRow("SELECT * FROM admin_users WHERE login = '$login' AND pwd = '$pwd' AND active='1' ");
}

?>