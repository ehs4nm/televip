<?php

namespace App\Http\Controllers;

use App\Models\Log as ModelsLog;
use App\Models\User;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Log;


class TelegramController extends Controller
{
    protected $user;
    public function __construct(Request $request)
    {
        $update = Telegram::commandsHandler(true);
        // $userId = $update->getId();
        // $this->user = User::where('tel_id', $userId)->get();

        $log = ModelsLog::create(['text' => $request]);
        Log::debug($request);
    }

    public function start()
    {
        if (!$this->user)
            Telegram::replyWithMessage(['text' => 'لطفا ابتدا ثبت نام کنید']);
    }
}
