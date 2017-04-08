<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Conversation;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Request;


//disable builtin commands
class CancelCommand extends UserCommand
{

    protected $enabled = false;

    public function execute()
    {

    }

}
