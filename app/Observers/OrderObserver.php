<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Subscribe;
use Illuminate\Database\Eloquent\Builder;

class OrderObserver
{
    public function created(Order $order) {
        $subscribes = Subscribe::select('*')
            ->where(function (Builder $query) use ($order) {
                $query->whereJsonContains('subscribe_data->realty_type_id', "5");
            })
            ->join('users', 'subscribes.user_id', 'users.id')
            ->get()
        ;

//        dd($subscribes->toArray());
    }
}
