<?
	class job_types extends db_row {
		
		function job_types($id = NULL) {
			//$this->use_db = DB_USERS_NAME;
			$this->table = 'job_types';
			$this->pri_key = 'id';
			$this->autoinc = 1;
			//$this->parent_key = '';
			//$this->url_prefix = '/job_types/';
			//$this->url_postfix = '.html';


			$this->fields['id'] = NULL;
			$this->fields['title'] = NULL;

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

	class job_types_list extends db_list {

		function job_types_list() {
			$this->single_element_class = 'job_types';
			$this->table = 'job_types';
			$this->sort_by = 'id';
			$this->sort_mode = 'desc';
			$this->items_per_page = 10;
		}

	}

?>