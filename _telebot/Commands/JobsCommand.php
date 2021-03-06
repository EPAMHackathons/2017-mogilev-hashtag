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
        $jobs = $this->user->getJobsForTelegram();
        $rows = [];
        foreach ($jobs as $j)  $rows[] = [$j];

        $inline_keyboard = new InlineKeyboard( ...$rows);

        $data = [
            'chat_id'      => $chat_id,
            'text'         => 'Available jobs',
            'reply_markup' => $inline_keyboard,
        ];

        return Request::sendMessage($data);
    }
}
