<?php

namespace App\Http\Controllers;

use App\Classes\Cities;
use App\Classes\Cron;
use App\Classes\Integrations\DomRia;
use App\Models\Category;
use App\Models\City;
use App\Models\OperationType;
use App\Models\RealtyType;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://developers.ria.com/dom/search?category=1&realty_type=2&operation_type=1&state_id=10&city_id=10&district_id=15187&district_id=15189&district_id=15188&characteristic%5B209%5D%5Bfrom%5D=1&characteristic%5B209%5D%5Bto%5D=3&%0Acharacteristic%5B214%5D%5Bfrom%5D=60&characteristic%5B214%5D%5Bto%5D=90&characteristic%5B216%5D%5Bfrom%5D=30&characteristic%5B216%5D%5Bto%5D=50&%0Acharacteristic%5B218%5D%5Bfrom%5D=4&characteristic%5B218%5D%5Bto%5D=9&characteristic%5B227%5D%5Bfrom%5D=3&characteristic%5B227%5D%5Bto%5D=7&%0Acharacteristic%5B443%5D=442&characteristic%5B234%5D%5Bfrom%5D=20000&characteristic%5B234%5D%5Bto%5D=90000&%0Acharacteristic%5B242%5D=239&characteristic%5B273%5D=273&characteristic%5B1437%5D=1434&api_key=M8QJ7oaGk2xAA0OwUXT8IW2kXTVcSvQzWef4RwQT",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);

        curl_close($curl);


        return response()->json(json_decode($response, true));

    }

    public function search() {
        $dom_ria_integration = new DomRia();

        $page = 1;

        $filter = [
            'city_id' => 1 // Вінниця
        ];

        $result = $dom_ria_integration->getOrdersFromApi($page, array_merge(['date_from' => '2020-06-02'], $filter));

        dd($result);
    }


    public function testCron()
    {
        $cron = new Cron();

        // Отримати міста з апі по регіонах

        /*$regions = Region::all();

        foreach ($regions as $region) {
            $response = $cron->getCitiesFromApi($region->stateID);
            DB::table('tmp_cities')->insert(['data' => $response]);
        }*/


        /* ------------------------------------------------------------ */

        // Запизати міста в базу

        /*$tmp_cities_data = City::from('tmp_cities')->get();


        foreach ($tmp_cities_data as $region_cities_json) {
            $region_cities = json_decode($region_cities_json['data'], true);

            foreach ($region_cities as $city) {
                Cities::saveCity($city);
            }
        }*/

        /* ------------------------------------------------------------ */
        /* ------------------------------------------------------------ */


        // Отримати райони з апі по містах

        ini_set('max_execution_time', 600);
        /*$cities = City::all();

        foreach ($cities as $city) {
            $response = $cron->getAreasFromApi($city->cityID);

            DB::table('tmp_areas')->insert(['data' => $response]);
        }*/


        /* ------------------------------------------------------------ */

        // Запизати райони міст в базу

        /*$tmp_areas_data = City::select(['tmp_areas.*', 'cities.cityID'])->from('tmp_areas')
            ->leftJoin('cities', 'tmp_areas.id', 'cities.id')
            ->get()
        ;

        foreach ($tmp_areas_data as $city_areas_json) {
            $city_area_types = json_decode($city_areas_json['data'], true);
            $cityID = $city_areas_json->cityID;

            foreach ($city_area_types as $areas) {

                $area_type_name = '';
                foreach ($areas as $index => $area) {
                    if($index == 0) {
                        $area_type_name = $area['name'];
                        continue;
                    }

                    $area['cityID'] = $cityID;
                    $area['type_name'] = $area_type_name;

                    Cities::saveArea($area);
                }

            }
        }*/


        /* ------------------------------------------------------------ */
        /* ------------------------------------------------------------ */

//        https://developers.ria.com/dom/options?category=4&realty_type=7&operation_type=1&api_key=YOUR_API_KEY


        // отримати характеристи по категоріях

        /*$dom_ria = new DomRia;

        $operation_types = OperationType::all();
        $realty_types = RealtyType::select([
                'categories.name AS category_name',
                'realty_types.id AS realty_types_id',
                'realty_types.name AS realty_types_name',
                'realty_types.ext_id AS realty_types_ext_id',
                'realty_types.category_ext_id AS category_ext_id',
            ])
            ->leftJoin('categories', 'realty_types.category_ext_id', 'categories.ext_id')
            ->get()
        ;

        foreach ($realty_types as $realty_type) {
            foreach ($operation_types as $operation_type) {

                $response = $dom_ria->getOptions($realty_type->category_ext_id, $realty_type->realty_types_ext_id, $operation_type->ext_id);

                DB::table('tmp_options')->insert([
                    'data' => $response,
                    'category_ext_id' => $realty_type->category_ext_id,
                    'realty_type_ext_id' => $realty_type->realty_types_ext_id,
                    'operation_type_ext_id' => $operation_type->ext_id,
                    'category_name' => $realty_type->category_name,
                    'realty_type_name' => $realty_type->realty_types_name,
                    'operation_type_name' => $operation_type->name,
                ]);
            }
        }*/

        /*$result_json = $dom_ria->getOptions();

        $result_array = json_decode($result_json, true);

        echo $result_json;*/
    }

    public function testCron2() {
        $dom_ria = new DomRia;

        $result_json = $dom_ria->getOrder();

        $result_array = json_decode($result_json, true);

        echo $result_json;
    }

    public function testCron3() {

        ini_set('max_execution_time', 600);


        $cron = new Cron();

        $cron->getOrdersFromDomRia();
    }

    public function testEcho() {
//        dd(scandir('.'));

        echo file_get_contents('other/options.json');
    }


}
