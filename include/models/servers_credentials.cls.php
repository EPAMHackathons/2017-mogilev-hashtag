<?
	class servers_credentials extends db_row {
		
		function __construct($id = NULL) {
			//$this->use_db = DB_USERS_NAME;
			$this->table = 'servers_credentials';
			$this->pri_key = 'id';
			$this->autoinc = 1;
			//$this->parent_key = '';
			//$this->url_prefix = '/servers_credentials/';
			//$this->url_postfix = '.html';


			$this->fields['id'] = NULL;
			$this->fields['server_id'] = NULL;
			$this->fields['login'] = NULL;
			$this->fields['password'] = NULL;
			$this->fields['public_key'] = NULL;
			$this->fields['private_key'] = NULL;

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

	class servers_credentials_list extends db_list {

		function __construct() {
			$this->single_element_class = 'servers_credentials';
			$this->table = 'servers_credentials';
			$this->sort_by = 'id';
			$this->sort_mode = 'desc';
			$this->items_per_page = 10;
		}

	}

?>