<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/Commands/Helpers/HelperCommand.php';
require_once __DIR__ . '/../include/teleconfig.inc.php';
require_once __DIR__ . '/../include/init.inc.php';


try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($_SERVER['bot_config']['token'], $_SERVER['bot_config']['name']);

    $telegram->addCommandsPath($_SERVER['bot_config']['cmd_path']);
    // Enable MySQL
    $telegram->enableMySQL($_SERVER['bot_config']['mysqlCreds']);

    while (true) {
        // Handle telegram getUpdate request
        $telegram->handleGetUpdates();
        usleep(500);
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
    echo $e;
}

?>