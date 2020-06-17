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

    }

    public function sendMessage() {
        $bot = new TelegramBot();

        $bot->sendMessage();

    }
}
