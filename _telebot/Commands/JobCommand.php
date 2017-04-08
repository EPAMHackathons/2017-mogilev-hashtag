<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;


class JobCommand extends HelperCommand
{
    /**
     * @var string
     */
    protected $name = 'job';

    /**
     * @var string
     */
    protected $description = 'Execute simple job';

    /**
     * @var string
     */
    protected $usage = '/job';

    /**
     * @var string
     */
    protected $version = '0.9.5';

    /**
     * Command execute method
     *
     * @return mixed
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $text = trim($message->getText(true));

        if ($text === '') {
            $text = 'Command usage: ' . $this->getUsage();
        }

        $data = [
            'chat_id' => $chat_id,
            'text' => 'You send me: ' . $text,
        ];

        return Request::sendMessage($data);
    }
}
