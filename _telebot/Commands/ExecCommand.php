<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Request;


use Ssh\Client;
use Ssh\Auth\Password;
use Ssh\Shell;

/**
 * User "/jobs" command
 */
class ExecCommand extends HelperCommand
{
    /**#@+
     * {@inheritdoc}
     */
    protected $name = 'exec';
    protected $description = 'Exec comand on remote server';
    protected $usage = '/exec';
    protected $version = '0.1.0';
    protected $enabled = true;
    /**#@-*/

    /**
     * {@inheritdoc}
     */
    public function do_execute()
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();

        $message_id = $message->getMessageId();
        $command    = trim($message->getText(true));

        $data = [
            'chat_id'      => $chat_id,
            'text'         => 'cmd is: ' . $command
        ];

        Request::sendMessage($data);

        $auth = new Password('alex', 'xcsPhtOAGLlLrzdn');
        $client = new Client('148.251.120.12');

        $client->connect()->authenticate($auth);
        $data['text'] = $client->exec($command);

        return Request::sendMessage($data);
    }
}
