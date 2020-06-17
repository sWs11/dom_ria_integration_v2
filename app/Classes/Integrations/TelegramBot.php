<?php

namespace App\Classes\Integrations;

class TelegramBot {
    public function sendMessage($chat_id, $message) {
        // chat_id = 422621375

        $params = [
            'chat_id' => $chat_id,
            'text' => $message
        ];

        $url = config('common.telegram_api_bot_base_url') . config('common.telegram_api_bot_key') . '/sendMessage?' . http_build_query($params);

        $response = $this->sendRequest($url, $params);

        return $response;
    }

    public function getUpdates() {
        $url = config('common.telegram_api_bot_base_url') . config('common.telegram_api_bot_key') . '/getUpdates';

        $params = [
            'offset' => ''
        ];

        return $this->sendRequest($url, $params);
    }


    private function sendRequest($url, $params = []) {
        $url = empty($params) ? $url : $url . '?' . http_build_query($params);

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

        curl_close($curl);


//        $response_arr = json_decode($response, true);
        /*if($response_arr['ok']) {
            // write logs
        } else {
            // write logs
        }*/

        return $response;
    }
}
