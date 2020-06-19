<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property string $ext_id
 * @property mixed $api_data
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereApiData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereExtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $state_id
 * @property int|null $city_id
 * @property int|null $district_id
 * @property int|null $street_id
 * @property string|null $state_name
 * @property string|null $city_name
 * @property string|null $district_name
 * @property string|null $street_name
 * @property string $beautiful_url
 * @property string|null $description
 * @property float|null $price
 * @property string|null $main_photo
 * @property mixed|null $photos
 * @property mixed|null $characteristics_values
 * @property int|null $rooms_count
 * @property string|null $currency_type
 * @property string|null $wall_type
 * @property string|null $publishing_date
 * @property string|null $youtube_link
 * @property int|null $floor Поверх
 * @property int|null $floors_count
 * @property string|null $created_date Дата створення оголошення на сайті
 * @property int|null $realty_sale_type
 * @property string|null $date_end
 * @property int|null $advert_type_id тип операції (продаж/оренда)
 * @property mixed|null $priceArr
 * @property mixed|null $all_response
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereAdvertTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereAllResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBeautifulUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCharacteristicsValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCurrencyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDistrictName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFloorsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereMainPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePriceArr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePublishingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRealtySaleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRoomsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereStateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereStreetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereStreetName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereWallType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereYoutubeLink($value)
 * @property string|null $building_number_str
 * @property string|null $flat_number
 * @property int|null $total_square_meters
 * @property int|null $realty_type_parent_id category id
 * @property int|null $realty_type_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBuildingNumberStr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFlatNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRealtyTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRealtyTypeParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTotalSquareMeters($value)
 */
class Order extends Model
{
    /*protected $fillable = [
        'ext_id',
        'api_data',
    ];*/
    protected $fillable = [
        'ext_id',
        'state_id',
        'city_id',
        'district_id',
        'street_id',
        'state_name',
        'city_name',
        'district_name',
        'street_name',
        'beautiful_url',
        'description',
        'price',
        'main_photo',
        'photos',
        'characteristics_values',
        'rooms_count',
        'currency_type',
        'wall_type',
        'publishing_date',
        'youtube_link',
        'floor',
        'floors_count',
        'created_date',
        'realty_sale_type',
        'date_end',
        'advert_type_id',
        'realty_type_parent_id',
        'realty_type_id',
        'building_number_str',
        'flat_number',
        'total_square_meters',
        'priceArr',
        'all_response',
    ];

    public function getMainPhotoAttribute($value)
    {
        $arr = explode('.', $value);
        if(!isset($arr[1]) || preg_match('~^http~', $value)) {
            debug([
                '$value' => $value,
                'id' => $this->id,
                'count' => count($arr),
            ]);

            return $value;
        }

        return $arr[0] . 'b.' . $arr[1];
    }
}
