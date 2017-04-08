<?

class user extends db_row
{

    function user($id = NULL)
    {
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

    function get_more_data()
    {
        $res = array();
        if (!empty($this->fields['id'])) {
            //fetch addditional info
            $res['job_permissions'] = db_getAll("SELECT * FROM users_permissions WHERE user_id =  " . $this->fields['id']);
            $permissions = db_getAll("SELECT * FROM users_permissions WHERE user_id =  " . $this->fields['id']);
            foreach ($permissions as $p) {
                $res['permissions_servers']['jobs'][$p['server_id']][] = $p['job_id'];
                $res['permissions_servers']['creds'][$p['server_id']][] = $p['credential_id'];

                $res['job_creds'][ $p['server_id'] ][ $p['job_id'] ] = $p['credential_id'];
            }


        }
        return $res;
    }

    function getJobs()
    {
        $uid = $this->fields['id'];

        $allowed = db_getAll("SELECT 
		        jobs.id as job_id,
		        servers.id as server_id,
		        servers_credentials.id as credentials_id,
		        jobs.command as payload,
		        jobs.title as job_title,
		        jobs.need_args as need_args,
		        jobs.telegegram_cmd as telegegram_cmd,
		        job_types.title as job_type, 
		        servers.name as server_title,
		        servers_credentials.login as login,
		        
		        servers.active as server_active,
		        servers_credentials.active as credentials_active
		    FROM 
		        users_permissions as up
            LEFT JOIN jobs ON jobs.id = up.job_id
            LEFT JOIN job_types ON job_types.id = jobs.type
            LEFT JOIN servers ON servers.id = up.server_id
            LEFT JOIN servers_credentials ON servers_credentials.id = up.credential_id
		    WHERE up.user_id = $uid; 
		    ");

        $ret = [];
        foreach ($allowed as $job) {
            if (empty($job['server_active']) || empty($job['credentials_active'])) continue;
            $ret[] = $job;
        }
        return $ret;
    }


    function getJobsForTelegram()
    {
        $jobs = $this->getJobs();

        $kbrd = [];
        foreach ($jobs as $j) {
            $a = [
                'text' => $j['job_title'] . '@' . $j['server_title'] . ' (' . $j['login'] . ')',
            ];

            if (empty($j['need_args'])) {
                $a['callback_data'] = 'job_' . $j['job_id'] . '_' . $j['server_id'] . '_' . $j['credentials_id'];
            } else {
                $a['switch_inline_query_current_chat'] = '/job' . $j['telegegram_cmd'] . ' ' .$j['job_id']. ' ' . $j['login'] . '@' . $j['server_title'] . ' ' . $j['payload'];
            }
            $kbrd[] = $a;
        }

        return $kbrd;
    }

    function getServersForExec()
    {
        $res = [];
        $jobs = $this->getJobs();
        foreach ($jobs as $j) {
            if ($j['job_type'] == "SSH cmd") {
                $res[] = ['login' => $j['login'], 'server' => $j['server_title']];
            }
        }

        return $res;
    }

}

class user_list extends db_list
{

    function user_list()
    {
        $this->single_element_class = 'user';
        $this->table = 'user';
        $this->sort_by = 'id';
        $this->sort_mode = 'desc';
        $this->items_per_page = 10;
    }

}

?>