<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram;

/**
 * Class HelpCommand.
 */
class HelpCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'help';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['listcommands'];

    /**
     * @var string Command Description
     */
    protected $description = 'لیست تمام دستورها را اینجا مشاهده کنید';

    /**
     * {@inheritdoc}
     */
    public function handle()

    {
        $response = $this->getUpdate();

        $text = 'به ربات کانال VIP رسول احمدی خوش آمدید. ' . chr(10);

        $this->replyWithMessage(compact('text'));
    }
}
