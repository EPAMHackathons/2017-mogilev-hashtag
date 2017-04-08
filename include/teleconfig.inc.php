<?php

$_SERVER['bot_config'] = [
    'name' => 'TeleHelp222bot',
    'token' => '367008735:AAHvdiPEuXsSG7JcoFAOdv_jp5iAg0B6epI',
    'mysqlCreds' => getMysqlCredsForBot(),
    'cmd_path' => __DIR__ . '/../_telebot/Commands',
    'dir' => __DIR__ . '/../_telebot/',
    'asset_dir' => __DIR__ . '/../_telebot/assets/'
];


function getMysqlCredsForBot()
{
    if (preg_match('@telehelp_mediapark_group_com@', __DIR__)) {
        $_SERVER['HTTP_HOST'] = 'telehelp.mediapark-group.com';
        return [
            'host' => 'localhost',
            'user' => 'telehelp_mediapa',
            'password' => 'HT5uCD5lG4KCwqR7',
            'database' => 'telehelp_mediapa',
        ];
    } else {
        return [
            'host' => 'localhost',
            'user' => 'root',
            'password' => '',
            'database' => 'telehelp',
        ];
    }
}

?>