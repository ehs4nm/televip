<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram;
use Telegram\Bot\Laravel\Facades\Telegram as FacadesTelegram;
use Telegram\Bot\TelegramClient;
use Telegram\Bot\TelegramRequest;

/**
 * Class HelpCommand.
 */
class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'start';

    /**
     * @var array Command Aliases
     */
    // protected $aliases = ['listcommands'];

    /**
     * @var string Command Description
     */
    protected $description = 'Start command';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {

        $keyboard = [
            ['7', '8', '9'],
            ['4', '5', '6'],
            ['1', '2', '3'],
            ['0']
        ];

        $reply_markup = Telegram\Bot\Keyboard\Keyboard::make([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);

        $response = $this->getUpdate();
        $botId = $response->getId();
        $firstName = $response->getFirstName();
        $username = $response->getUsername();

        $commands = $this->getTelegram()->getCommands();

        $text = 'به ربات کانال VIP رسول احمدی خوش آمدید. ' . chr(10);
        $text .= $firstName . $username . $botId . '      d';

        $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]);



        $messageId = $response->getMessageId();
    }
}
