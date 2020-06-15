<?php

namespace App\Classes\Integrations;

class TelegramBot {
    public function sendMessage() {
        // chat_id = 422621375

        $params = [
            'chat_id' => 422621375,
            'text' => 'Message from bot!'
        ];

        $url = config('common.telegram_api_bot_base_url') . config('common.telegram_api_bot_key') . '/sendMessage?' . http_build_query($params);

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
}
