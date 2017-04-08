<?
	class user extends db_row {
		
		function __construct($id = NULL) {
			//$this->use_db = DB_USERS_NAME;
			$this->table = 'user';
			$this->pri_key = 'id';
			$this->autoinc = 1;
			//$this->parent_key = '';
			//$this->url_prefix = '/user/';
			//$this->url_postfix = '.html';


			$this->fields['id'] = NULL;
			$this->fields['first_name'] = NULL;
			$this->fields['last_name'] = NULL;
			$this->fields['username'] = NULL;
			$this->fields['created_at'] = NULL;
			$this->fields['updated_at'] = NULL;
			
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

	class user_list extends db_list {

		function __construct() {
			$this->single_element_class = 'user';
			$this->table = 'user';
			$this->sort_by = 'id';
			$this->sort_mode = 'desc';
			$this->items_per_page = 10;
		}

	}

?>