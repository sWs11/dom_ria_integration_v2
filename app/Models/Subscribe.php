<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Subscribe
 *
 * @property int $id
 * @property int|null $user_id
 * @property mixed|null $subscribe_data
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subscribe onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereSubscribeData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subscribe withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subscribe withoutTrashed()
 * @mixin \Eloquent
 */
class Subscribe extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'subscribe_data'
    ];
}
