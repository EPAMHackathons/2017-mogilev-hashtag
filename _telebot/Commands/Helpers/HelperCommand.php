<?php

namespace Longman\TelegramBot\Commands\UserCommands;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

class HelperCommand extends UserCommand
{
    protected function sendText($text) {
        $data = [
            'chat_id' => $this->getMessage()->getChat()->getId(),
            'text' => $text,
        ];
        return Request::sendMessage($data);
    }

    protected function sendImage($assetName) {
        $data = ['chat_id' => $this->getMessage()->getChat()->getId()];
        $result = Request::sendPhoto($data, $_SERVER['bot_config']['asset_dir'] . $assetName);
    }

    private function unAuthorised() {
        $this->sendImage('denied.jpg');
    }

    private function isValidUser($userId) {
        $user = db_getRow("SELECT * FROM user WHERE id = '$userId'");
        return !empty($user['active']);
    }

    public function execute() {
        $msg = $this->getMessage();
        $autorId = $msg->from['id'];
        if (!$this->isValidUser($autorId)) return $this->unAuthorised();
        $this->user = new \user($autorId);

        return $this->do_execute();
    }

}

?>