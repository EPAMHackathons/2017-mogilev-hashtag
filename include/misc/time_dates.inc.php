<?

function month_to_num($month)
{
    $month = strtolower($month);
    $data = array(
        'january' => 1,
        'february' => 2,
        'march' => 3,
        'april' => 4,
        'may' => 5,
        'june' => 6,
        'july' => 7,
        'august' => 8,
        'september' => 9,
        'october' => 10,
        'november' => 11,
        'december' => 12,
    );
    return (isset($data[$month])) ? $data[$month] : 1;
}

function utc_time()
{
    $now = time();
    $now -= $_SERVER['timezone'] * 3600;
    return $now;
}

function sql_date($ts = 0)
{
    if (preg_match('@^(\d{2})\.(\d{2})\.(\d{4})$@', $ts, $m)) return $m[3] . '-' . $m[2] . '-' . $m[1];

    if (!preg_match('@^\d+$@', $ts)) $ts = strtotime($ts);
    if (empty($ts)) $ts = time();
    return date('Y-m-d H:i:s', $ts);
}


function rus_date($d)
{
    @list($date, $time) = explode(' ', $d);
    @list($y, $m, $d) = explode('-', $date);
    return $d . '.' . $m . '.' . $y;
}

function rus_time($d)
{
    if (empty($d)) return 'нет';

    @list($date, $time) = explode(' ', $d);
    @list($y, $m, $d) = explode('-', $date);
    return $d . '.' . $m . '.' . $y . ' ' . $time;
}
function rus_time_brief($d)
{
    if (empty($d)) return 'нет';

    @list($date, $time) = explode(' ', $d);
    @list($y, $m, $d) = explode('-', $date);
    if (strlen($y) == 4) $y = substr($y, -2);
    if (strlen($time) == 8) $time = substr($time, 0, 5);

    return $d . '.' . $m . '.' . $y . ' ' . $time;
}


function getAge($dob, $now)
{
    $bday = new DateTime($dob);
    $today = new DateTime($now);
    $diff = $today->diff($bday);

    return $diff->y;
}


function getNumDays($from, $to)
{
    $from = date('Y-m-d', strtotime($from));
    $to = date('Y-m-d', strtotime($to));

    $from = new DateTime($from);
    $to = new DateTime($to);
    $diff = $from->diff($to);


    if ($diff->invert) {
        $days = 0 - $diff->days;
    } else {
        $days = $diff->days + 1;
    }

    $res['from'] = $from;
    $res['to'] = $to;
    $res['diff'] = $diff;
    $res['days'] = $days;

    return $days;
}

function get_mon_name($s = '')
{
    if (empty($s)) $s = time();

    $s = date('F Y', $s);
    $search = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $replace = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');

    $s = str_replace($search, $replace, $s);
    return $s;
}


function rus_str_date($s = '')
{
    $s = date('d F Y', strtotime($s));
    $search = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $replace = array('Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря');

    $s = str_replace($search, $replace, $s);
    return $s;
}


function get_rus_month($ts)
{
    $monthes = array(
        1 => 'Январь',
        2 => 'Февраль',
        3 => 'Март',
        4 => 'Апрель',
        5 => 'Май',
        6 => 'Июнь',
        7 => 'Июль',
        8 => 'Август',
        9 => 'Сентябрь',
        10 => 'Октябрь',
        11 => 'Ноябрь',
        12 => 'Декабрь'
    );


    if (!preg_match('@^\d+$@', $ts)) $ts = strtotime($ts);
    $n = intval(date('m', $ts));

    return (isset($monthes[$n])) ? $monthes[$n] : '???';
}

function get_rus_day_ofweek($ts)
{
    $days = array(
        1 => 'Понедельник',
        2 => 'Вторник',
        3 => 'Среда',
        4 => 'Четверг',
        5 => 'Пятница',
        6 => 'Суббота',
        7 => 'Воскресенье'
    );


    if (!preg_match('@^\d+$@', $ts)) $ts = strtotime($ts);
    $n = intval(date('N', $ts));

    return (isset($days[$n])) ? $days[$n] : '???';
}


function date_to_rus($d)
{
    $d = strtotime($d);
    return date('d.m.Y', $d);
}

?>