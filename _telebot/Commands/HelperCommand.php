<?php

namespace Longman\TelegramBot\Commands\UserCommands;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

class HelperCommand extends UserCommand
{
    protected function sendText($text) {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $text = trim($message->getText(true));

        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
        ];

        echo "Send";
        return Request::sendMessage($data);
    }

    private function unAuthorised() {
        $this->sendText('Thou shall not pass');
    }

    private function isValidUser($userId) {
        $user = db_getRow("SELECT * FROM user WHERE id = '$userId'");
        return !empty($user['active']);
    }

    public function execute() {
        $msg = $this->getMessage();
        $autorId = $msg->from['id'];
        if (!$this->isValidUser($autorId)) return $this->unAuthorised();

        echo "EXecing command, chat_id: $autorId\n";
        $this->do_execute();
    }

}

?>