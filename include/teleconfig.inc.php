<?php

$_SERVER['bot_config'] = [
    'name' => 'TeleHelp222bot',
    'token' => '367008735:AAHvdiPEuXsSG7JcoFAOdv_jp5iAg0B6epI',
    'mysqlCreds' => getMysqlCredsForBot(),
    'cmd_path' => __DIR__.'/../_telebot/Commands',
    'dir' => __DIR__.'/../_telebot/',
    'asset_dir' => __DIR__.'/../_telebot/assets/'
];



function getMysqlCredsForBot() {
    if (true) { //todo: detect ENV
        return [
            'host'     => 'localhost',
            'user'     => 'root',
            'password' => '',
            'database' => 'telehelp',
        ];
    }
}

?>