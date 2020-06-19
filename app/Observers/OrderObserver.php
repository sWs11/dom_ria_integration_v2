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
            ->where(function (Builder $query) use ($order) {
//                $query->whereJsonContains('subscribe_data->advert_type_id', $order->advert_type_id)
                $query->whereRaw('JSON_EXTRACT(subscribe_data, \'$."price"."from"\') >= "' . $order->price . '"')
                    ->orWhereRaw('JSON_EXTRACT(subscribe_data, \'$."price"."from"\') IS NULL');
            })
            ->where(function (Builder $query) use ($order) {
//                $query->whereJsonContains('subscribe_data->advert_type_id', $order->advert_type_id)
                $query->whereRaw('JSON_EXTRACT(subscribe_data, \'$."price"."to"\') <= "' . $order->price . '"')
                    ->orWhereRaw('JSON_EXTRACT(subscribe_data, \'$."price"."to"\') IS NULL');
            })
            ->join('users', 'subscribes.user_id', 'users.id')
            ->get()
        ;

        if($subscribes->isNotEmpty()) {
            $bot = new TelegramBot();

            foreach ($subscribes as $user) {
                if(!empty($user->telegram_chat_id)) {
                    $message = 'Цена: ' . $order->price . ' ' . $order->currency_type . "\n";
                    $message .= 'Комнат: ' . $order->rooms_count . "\n";
                    $message .= 'Площадь: ' . $order->total_square_meters . 'м2' . "\n";
                    $message .= 'Этаж: ' . $order->floor . '/' . $order->floors_count . "\n\n";
                    $message .= 'https://dom.ria.com/ru/' . $order->beautiful_url;

                    $bot->sendMessage($user->telegram_chat_id, $message);
                }

            }
        }
    }
}
