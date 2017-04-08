<?
class db_list
{
	var $table;
	var $sort_by;
	var $sort_mode;
	var $single_element_class;
	var $sql;
	var $filters;
	var $items_per_page;
	var $page_uri;
	var $pages_to_side = 3; //amount of pages to display in paginator
	var $use_db;


	//*** get list of all records from table
	function get()
	{
		if (empty($this->use_db)) $this->use_db = false; //use default connection
		$this->sql = 'SELECT * FROM ' . $this->table;
		$this->apply_filters();
		$this->apply_sort();
		return $this->fetch_records();
	}

	//*** get records for one page
	function get_page($page_num = 0, $dont_get_more = false)
	{
		if (empty($this->use_db)) $this->use_db = false; //use default connection
		$total_records = $this->get_num_records();
		$this->sql = 'SELECT * FROM ' . $this->table;
		$this->apply_filters();
		$this->apply_sort();
		//applying limit modifier
		$total_pages = ceil($total_records / $this->items_per_page);
		if ($page_num < 1) $page_num = 1;
		$start = ($page_num - 1) * $this->items_per_page;
		$this->sql .= " LIMIT $start, " . $this->items_per_page;

		//info for paginator template
		$res['pages']['total_pages'] = $total_pages;
		$res['pages']['total_records'] = $total_records;
		$res['pages']['limit'] = $this->items_per_page;
		$res['pages']['page_num'] = $page_num;
		//preparing uri
		$res['pages']['uri'] = $this->page_uri;
		//prepare page numbersfor paginator
		$page_min = $page_num - $this->pages_to_side;
		if ($page_min < 1) $page_min = 1;
		$page_max = $page_num + $this->pages_to_side;
		if ($page_max > $total_pages) $page_max = $total_pages;
		for ($i = $page_min; $i <= $page_max; ++$i) $res['pages']['paginator_array'][] = $i;
		$res['data'] = $this->fetch_records($dont_get_more);
		return $res;
	}

	//*** fetch records and craft them into arrays with getters
	function fetch_records($dont_get_more = false)
	{
		//echo $this->sql.'<br>';
		$recs = db_getAll($this->sql, $this->use_db);
		if ($recs === false) return array();

		$res = array();
		$single_el = new $this->single_element_class;
		foreach ($recs as $rec) {
			$single_el->from_raw($rec);
			$res[] = $single_el->to_array($dont_get_more);
		}
		return $res;
	}

	//*** get number of records
	function get_num_records()
	{
		$this->sql = 'SELECT COUNT(*) FROM ' . $this->table;
		$this->apply_filters();
		return db_getOne($this->sql, $this->use_db);
	}


	//*** apply search filters
	function apply_filters()
	{
		if (!is_array($this->filters) || count($this->filters) == 0) return;
		$res = ' WHERE (' . implode(') AND (', $this->filters) . ')';
		$this->sql .= $res;
	}

	//*** apply sorting mode
	function apply_sort()
	{
		if (!empty($this->sort_by)) {
			$this->sql .= ' ORDER BY ' . $this->sort_by . ' ';
			if (!empty($this->sort_mode)) $this->sql .= $this->sort_mode;
		}
	}


}

?>