<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\City
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $cityID
 * @property int $stateID
 * @property string $name
 * @property string|null $eng
 * @property string|null $declension
 * @property string|null $translit
 * @property string|null $preview_img
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCityID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereDeclension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereEng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City wherePreviewImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereStateID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereTranslit($value)
 */
class City extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'cityID',
        'stateID',
        'name',
        'eng',
        'declension',
        'translit',
        'preview_img',
    ];
}
