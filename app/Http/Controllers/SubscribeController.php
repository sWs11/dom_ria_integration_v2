<?php

namespace App\Http\Controllers;

use App\Classes\Integrations\TelegramBot;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function getSubscribeLink() {

        http://t.me/VinnynsiaDomRiaBot?start=5bf741745a4acbcfd98e980d989f0e1b
    }

    public function index() {

        // chat_id = 422621375

        $url = config('common.telegram_api_bot_base_url') . config('common.telegram_api_bot_key') . '/getUpdates';
        config('common.telegram_api_bot_key');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);

        dd(json_decode($response, true));
    }

    public function sendMessage() {
        $bot = new TelegramBot();

        $bot->sendMessage();

    }
}
