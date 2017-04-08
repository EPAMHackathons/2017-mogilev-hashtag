<?php
/**
 * This file is part of the TelegramBot package.
 *
 * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;

/**
 * Callback query command
 */
class CallbackqueryCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'callbackquery';

    /**
     * @var string
     */
    protected $description = 'Reply to callback query';

    /**
     * @var string
     */
    protected $version = '1.1.0';

    /**
     * Command execute method
     *
     * @return mixed
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $update = $this->getUpdate();
        $callback_query = $update->getCallbackQuery();
        $callback_query_id = $callback_query->getId();
        $callback_data = $callback_query->getData();
        $chatId = $callback_query->raw_data['message']['chat']['id'];

        if (preg_match('@^job_(\d+)_(\d+)_(\d+)@', $callback_data, $m)) {
            $jobId = $m[1];
            $serverId = $m[2];
            $credId = $m[3];

            $result = \JobFactory::exec($jobId, $serverId, $credId);
            if ($result !== null) {
                $data = [
                    'chat_id' => $chatId,
                    'parse_mode' => 'MARKDOWN',
                    'text' => "Executing job",
                ];
                Request::sendMessage($data);
            } else {
                $result = "Failed to create job";
            }
        } else {
            $result = 'Something went wrong';
        }


        $data = [
            'chat_id' => $chatId,
            'text' => $result,
        ];
        $msgData = $data;
        $msgData['parse_mode'] = 'MARKDOWN';
        $msgData['text'] = '``` ' . $data['text'] . '```';
        Request::sendMessage($msgData);

        return Request::answerCallbackQuery($data);
    }
}
