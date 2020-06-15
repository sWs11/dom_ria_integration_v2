<?php

namespace App\Classes;

use App\Models\Area;
use App\Models\City;

class Cities {
    public static function saveCity(array $city_data) {
        $city = City::updateOrCreate([
                'cityID' => $city_data['cityID'],
            ],
            [
                'cityID' => $city_data['cityID'],
                'stateID' => $city_data['stateID'],
                'name' => $city_data['name'],
                'eng' => $city_data['eng'],
                'declension' => $city_data['declension'],
                'translit' => $city_data['translit'],
                'preview_img' => $city_data['preview_img'],
            ]
        );

        return $city;
    }

    public static function saveArea(array $area_data) {
        $area = Area::updateOrCreate([
                'area_id' => $area_data['area_id'],
            ],
            [
                'name' => $area_data['name'],
                'type' => $area_data['type'],
                'type_name' => $area_data['type_name'],
                'value' => $area_data['value'],
                'area_id' => $area_data['area_id'],
                'cityID' => $area_data['cityID'],
            ]
        );

        return $area;
    }
}
