<?
	class servers_jobs extends db_row {
		
		function __construct($id = NULL) {
			//$this->use_db = DB_USERS_NAME;
			$this->table = 'servers_jobs';
			$this->pri_key = 'id';
			$this->autoinc = 1;
			//$this->parent_key = '';
			//$this->url_prefix = '/servers_jobs/';
			//$this->url_postfix = '.html';


			$this->fields['server_id'] = NULL;
			$this->fields['script_id'] = NULL;

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

	class servers_jobs_list extends db_list {

		function __construct() {
			$this->single_element_class = 'servers_jobs';
			$this->table = 'servers_jobs';
			$this->sort_by = 'id';
			$this->sort_mode = 'desc';
			$this->items_per_page = 10;
		}

	}

?>