<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Area
 *
 * @property int $id
 * @property string $name
 * @property int|null $type
 * @property string|null $type_name
 * @property int|null $value
 * @property int $area_id
 * @property int|null $cityID
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereCityID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Area whereValue($value)
 * @mixin \Eloquent
 */
class Area extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'type',
        'type_name',
        'value',
        'area_id',
        'cityID',
    ];
}
