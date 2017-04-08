<?
	class user extends db_row {
		
		function user($id = NULL) {
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
			$this->fields['active'] = NULL;
			
			parent::__construct($id);
		}

		function get_more_data() {
			$res = array();
			if ( !empty($this->fields['id']) ) {
				//fetch addditional info
                $this->fields['job_permissions'] = db_getCol("SELECT * FROM users_permissions WHERE user_id =  " . $this->fields['id']);
			}
			return $res;
		}

	}

	class user_list extends db_list {

		function user_list() {
			$this->single_element_class = 'user';
			$this->table = 'user';
			$this->sort_by = 'id';
			$this->sort_mode = 'desc';
			$this->items_per_page = 10;
		}

	}

?>