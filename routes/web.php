<?php

use App\Http\Controllers\TelegramController;
use App\Models\Log as ModelsLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/fjoavndgqjtivmywzuxkopenaerzdfewmhwtqrimjpchantyjlujvbjhaiocxxfzrnujqlvlapdapzahuhkjupygtmeidzlkajosvdfdvnssztawcyfthllnriffhtie/webhook', [TelegramController::class, 'start']);


Route::get('/setwebhook', function () {
    $response = Telegram::setWebhook(['url' =>  env('TELEGRAM_WEBHOOK_URL')]);
    dd($response);
});
