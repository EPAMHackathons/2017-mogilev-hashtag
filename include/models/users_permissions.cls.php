<?
	class users_permissions extends db_row {
		
		function __construct($id = NULL) {
			//$this->use_db = DB_USERS_NAME;
			$this->table = 'users_permissions';
			$this->pri_key = 'id';
			$this->autoinc = 1;
			//$this->parent_key = '';
			//$this->url_prefix = '/users_permissions/';
			//$this->url_postfix = '.html';


			$this->fields['user_id'] = NULL;
			$this->fields['job_id'] = NULL;

            parent::__construct($id);
		}

		function get_more_data() {
			$res = array();
			if ( !empty($this->fields['id']) ) {
				//fetch addditional info
			}
			return $res;
		}

	}

	class users_permissions_list extends db_list {

		function __construct() {
			$this->single_element_class = 'users_permissions';
			$this->table = 'users_permissions';
			$this->sort_by = 'id';
			$this->sort_mode = 'desc';
			$this->items_per_page = 10;
		}

	}

?>