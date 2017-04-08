<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Request;

/**
 * User "/jobs" command
 */
class JobsCommand extends HelperCommand
{
    /**#@+
     * {@inheritdoc}
     */
    protected $name = 'jobs';
    protected $description = 'Show list of available jobs';
    protected $usage = '/jobs';
    protected $version = '0.1.0';
    protected $enabled = true;
    /**#@-*/

    /**
     * {@inheritdoc}
     */
    public function do_execute()
    {
        $chat_id = $this->getMessage()->getChat()->getId();
        $jobs = [
            ['text' => 'Job 1', 'callback_data' => 'job1'],
            ['text' => 'Job 2', 'callback_data' => 'job2'],
            ['text' => 'Job 3', 'callback_data' => 'job3']
        ];

        $inline_keyboard = new InlineKeyboard($jobs);

        $data = [
            'chat_id'      => $chat_id,
            'text'         => 'inline keyboard',
            'reply_markup' => $inline_keyboard,
        ];

        return Request::sendMessage($data);
    }
}
