<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Region
 *
 * @property int $id
 * @property int|null $stateID
 * @property string|null $name
 * @property string|null $eng_name
 * @property string|null $declension
 * @property string|null $center_declension
 * @property string|null $region_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region whereCenterDeclension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region whereDeclension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region whereEngName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region whereRegionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Region whereStateID($value)
 * @mixin \Eloquent
 */
class Region extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'stateID',
        'name',
        'eng_name',
        'declension',
        'center_declension',
        'region_name',
    ];
}
