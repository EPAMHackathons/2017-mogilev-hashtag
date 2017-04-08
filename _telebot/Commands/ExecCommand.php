<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Request;


use Ssh\Client;
use Ssh\Auth\Password;
use Ssh\Shell;
use Longman\TelegramBot\Entities\Keyboard;

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
    protected $usage = '/exec {serverId} {cmd}';
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
        $command    = trim($message->getText(true));

        if (empty($command)) {
            $server = $this->user->getServersForExec();
            $msg = "List of servers available for you:\n";
            foreach ($server as $s) $msg .= "* $s[login]@$s[server]\n";

        } else {
            $data = explode(' ', $command);

            if (empty($data[0]) || empty($data[1])) {
                $msg = "You should specify server and command";
            } else {
                $server = $data[0];
                unset($data[0]);
                $cmd = implode(' ', $data);

                $res = \JobFactory::execShellCmd($server, $cmd);
                $msg = $res === null ? "Failed to create job" : '``` '.$res.'```';
            }
        }

        $data = [
            'chat_id' => $chat_id,
            'parse_mode' => 'MARKDOWN',
            'text' => $msg
        ];




        return Request::sendMessage($data);
    }
}
