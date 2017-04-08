<?
/**
 * mysql routines:
 *  - connection
 *  - escaping data from request
 *  - query functions
 */
/*************************************************
 * Connection
 *************************************************/
function do_mysql_connect($db_name, $link_key)
{
    if (!isset($_SERVER['mysql_auth'][$db_name])) die("No con settings for $db_name!");
    $con_settings = $_SERVER['mysql_auth'][$db_name];

    $_SERVER['mysql_links'][$link_key] = @new mysqli($con_settings['host'], $con_settings['user'], $con_settings['pass'], $db_name);
    if (!empty($_SERVER['mysql_links'][$link_key]->connect_errno)) {

        if (is_dev_server() || is_uat_server()) {
            echo "[".$_SERVER['mysql_links'][$link_key]->connect_errno.'] error msg: ' . $_SERVER['mysql_links'][$link_key]->connect_error.'<br>';
        }
        die("Could not connect to MySQL");
    }

    db_query("SET NAMES utf8", $link_key);
}

if (!defined('NO_MYSQL') && defined('MYSQL_DB')) {
    do_mysql_connect(MYSQL_DB, 'default');
}

/*************************************************
 * Escaping request's data
 *************************************************/

//*** let's strip slashes from magic quoutes
if (get_magic_quotes_gpc() || ini_get('magic_quotes_gpc')) {
    $_POST = stripslashes_recurrent($_POST);
    $_GET = stripslashes_recurrent($_GET);
    $_COOKIE = stripslashes_recurrent($_COOKIE);
}

//*** escape data and keep unsafe values
$_SERVER['us_POST'] = $_POST;
$_SERVER['us_GET'] = $_GET;
$_SERVER['us_COOKIE'] = $_COOKIE;
$_SERVER['us_REQUEST'] = $_REQUEST;
$_POST = escape_recurrent($_POST);
$_GET = escape_recurrent($_GET);
$_COOKIE = escape_recurrent($_COOKIE);
$_REQUEST = escape_recurrent($_REQUEST);


//*** recurrently add slashes and store unescaped values in us_* variables
function escape_recurrent($var, $noUs = false)
{
    if (!is_array($var)) return $var;
    foreach ($var as $k => $v) {
        if (is_array($v)) {
            $var[$k] = escape_recurrent($v, $noUs);
        } else {
            $var[$k] = $_SERVER['mysql_links']['default']->real_escape_string($v);
        }
    }
    return $var;

}

//*** recurrently clean data from magic quotes slashes
function stripslashes_recurrent($var)
{
    if (!is_array($var)) return $var;
    foreach ($var as $k => $v) {
        if (is_array($v)) {
            $var[$k] = stripslashes_recurrent($v);
        } else {
            $var[$k] = stripslashes($v);
        }
    }
    return $var;
}

/*************************************************
 * QUERY REPLACEMENTS
 * all new funcs return false if query had failed
 *************************************************/

/**
 * abstract query
 */
function db_query($query, $my_db_name = false)
{
    $link_key = 'default';
    if ($my_db_name != false) {
        if (!isset($_SERVER['mysql_links'][$my_db_name])) { //no existing connection to this DB - create one
            do_mysql_connect($my_db_name, $my_db_name);
        }
        $link_key = $my_db_name;
    }

    $res = $_SERVER['mysql_links'][$link_key]->query($query);

    if (is_dev_server()) {
        $state = $_SERVER['mysql_links'][$link_key]->sqlstate;
        if ($state  != '00000') {
            $error_list =  $_SERVER['mysql_links'][$link_key]->error_list;

            $msg = $query . "\r\n<br/>\n";

            foreach ($error_list as $err) {
                $msg .= '['.$err['errno'].'] ' . $err['error'] . "<br/>\r\n";
            }
            throw new Exception($msg);
        }
    }

    $id = $_SERVER['mysql_links'][$link_key]->insert_id;
    if (!empty($id)) return $id;


    return $res;
}

/**
 * fetch all rows into associative array
 */

function db_getAll($query, $my_db_name = false)
{
    $res = array();
    $p_result = db_query($query, $my_db_name);
    if (!is_object($p_result)) return $res;

    while ($arr = $p_result->fetch_assoc()) $res[] = $arr;
    $p_result->close();

    return $res;
}


/**
 * fetch first rows into associative array
 */
function db_getRow($query, $my_db_name = false)
{
    $res = array();
    $p_result = db_query($query, $my_db_name);
    if (!is_object($p_result)) return $res;

    if ($obj = $p_result->fetch_assoc()) $res = $obj;
    $p_result->close();

    return $res;
}

/**
 * fetch one first element into variable
 */
function db_getOne($query, $my_db_name = false)
{
    $res = false;
    $p_result = db_query($query, $my_db_name);
    if (!is_object($p_result)) return $res;

    if ($obj = $p_result->fetch_array()) $res = $obj[0];
    $p_result->close();
    return $res;
}

/**
 * fetch and store first column into array with numerical keys
 */
function db_getCol($query, $my_db_name = false)
{
    $res = array();
    $p_result = db_query($query, $my_db_name);
    if (!is_object($p_result)) return $res;

    while ($obj = $p_result->fetch_array()) $res[] = $obj[0];
    $p_result->close();
    return $res;
}

function get_vals($arr)
{
    $res = array();
    $vals = @array_unique($arr);
    if (!empty($vals)) {
        foreach ($vals as $val_id) {
            $val_id = intval($val_id);
            if (!empty($val_id)) $res[] = $val_id;
        }
    }
    return $res;
}

function save_one_tomany($table, $item_field, $val_field, $item_id, $vals)
{
    db_query("DELETE FROM $table WHERE `$item_field` = '$item_id'");

    $vals = get_vals($vals);
    if (!empty($vals)) foreach ($vals as $val_id) db_query("INSERT INTO $table SET  `$item_field` = '$item_id', `$val_field` = '$val_id' ");
}

function get_one_tomany($val_field, $link_table, $item_field, $values_table, $item_id)
{

    if (!empty($item_id)) $has = db_getCol("SELECT `$val_field` FROM `$link_table` WHERE `$item_field` =  " . $item_id);
    if (empty($has)) $has = array();

    $values = db_getAll("SELECT * FROM `$values_table` ORDER BY title ASC");
    foreach ($values as $k => $b) if (in_array($b['id'], $has)) $values[$k]['selected'] = 1;

    return $values;
}


?>