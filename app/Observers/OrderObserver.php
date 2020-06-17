<?php

namespace App\Observers;

use App\Classes\Integrations\TelegramBot;
use App\Models\Order;
use App\Models\Subscribe;
use Illuminate\Database\Eloquent\Builder;

class OrderObserver
{
    public function created(Order $order) {
        $subscribes = Subscribe::select('*')
            ->where(function (Builder $query) use ($order) {
//                $query->whereJsonContains('subscribe_data->realty_type_parent_id', $order->realty_type_parent_id)
                $query->whereRaw('JSON_EXTRACT(subscribe_data, \'$."realty_type_parent_id"\') = "' . $order->realty_type_parent_id . '"')
                    ->orWhereRaw('JSON_EXTRACT(subscribe_data, \'$."realty_type_parent_id"\') IS NULL');
            })
            ->where(function (Builder $query) use ($order) {
//                $query->whereJsonContains('subscribe_data->realty_type_id', $order->realty_type_id)
                $query->whereRaw('JSON_EXTRACT(subscribe_data, \'$."realty_type_id"\') = "' . $order->realty_type_id . '"')
                    ->orWhereRaw('JSON_EXTRACT(subscribe_data, \'$."realty_type_id"\') IS NULL');
            })
            ->where(function (Builder $query) use ($order) {
//                $query->whereJsonContains('subscribe_data->advert_type_id', $order->advert_type_id)
                $query->whereRaw('JSON_EXTRACT(subscribe_data, \'$."advert_type_id"\') = "' . $order->advert_type_id . '"')
                    ->orWhereRaw('JSON_EXTRACT(subscribe_data, \'$."advert_type_id"\') IS NULL');
            })
            ->join('users', 'subscribes.user_id', 'users.id')
            ->get()
        ;

        if($subscribes->isNotEmpty()) {
            $bot = new TelegramBot();

            foreach ($subscribes as $user) {
                if(!empty($user->telegram_chat_id))
                    $bot->sendMessage($user->telegram_chat_id, 'https://dom.ria.com/ru/' . $order->beautiful_url);

            }
        }
    }
}
