<?php

namespace App\Http\Controllers;

use App\Classes\Integrations\TelegramBot;
use App\Models\Subscribe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubscribeController extends Controller
{
    public function getSubscribeLink() {

        $key = Str::random();

        $current_user = Auth::user();
        $current_user->telegram_subscribe_key = $key;
        $current_user->save();

        return response()->json([
            'data' => [
                'link' => 'http://t.me/VinnynsiaDomRiaBot?start=' . $key
            ]
        ]);

    }

    public function saveSubscribe(Request $request) {
        $subscribe = new Subscribe();

        $subscribe->user_id = Auth::id();
        $subscribe->subscribe_data = json_encode($request->get('filter'));

        $result = $subscribe->save();

        return response()->json([
            'status' => $result ? 'success' : 'error'
        ]);
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

        curl_close($curl);

        $response_arr = json_decode($response, true);

//        dd($response_arr);

        $new_subscribes = [];

        foreach ($response_arr['result'] as $item) {
            if(strpos($item['message']['text'], '/start') === false)
                continue;

            $telegram_subscribe_key = trim(substr($item['message']['text'], 6));

            if(empty($telegram_subscribe_key))
                continue;

            $new_subscribes[$telegram_subscribe_key] = $item['message'];
        }

//        dd($new_subscribes);

        if(!empty($new_subscribes)) {
            $users = User::whereIn('telegram_subscribe_key', array_keys($new_subscribes))->get();

            $users = $users->keyBy('telegram_subscribe_key');

            foreach ($users as $subscribe_key => $user) {
                $user->telegram_user_id = $new_subscribes[$subscribe_key]['from']['id'];
                $user->telegram_chat_id = $new_subscribes[$subscribe_key]['chat']['id'];
                $user->telegram_subscribe_key = null;

                $user->save();
            }
        }
    }

    public function sendMessage() {
        $bot = new TelegramBot();

        $bot->sendMessage();

    }
}
