<?php

namespace App\Classes;

use App\Classes\Integrations\DomRia;
use App\Models\Order;

class Cron {
    public function getCitiesFromApi($region_id = 1) {
        $url = "https://developers.ria.com/dom/cities/{$region_id}?api_key=" . config('common.ria_api_key');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
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

        return $response;
    }


    public function getAreasFromApi($city_id = 47) {
        $url = "https://developers.ria.com/dom/cities_districts/{$city_id}?api_key=" . config('common.ria_api_key');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
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

        return $response;
    }



    public function getOrdersFromDomRia() {
        $count_pages = 1;
        $current_page = 0;

        $dom_ria_integration = new DomRia();

        $filter = [
            'city_id' => 1 // Вінниця
        ];

        do {
            $result = $dom_ria_integration->getOrdersFromApi($current_page, array_merge(['date_from' => '2020-06-17'], $filter));
            $count_pages = $current_page !== 0 ? $count_pages : ceil($result['count']/100);
            $orders_ext_ids = $result['items'];

            /*dump([
                '$count_pages' => $count_pages,
                '$current_page' => $current_page,
                '$result[\'count\']' => $result['count']
            ]);*/


            if(gettype($orders_ext_ids) !== 'array') {
                dump($current_page);
                dump($orders_ext_ids);
                dd($result);
            }

            try {
                $this->getOrdersInfo($orders_ext_ids);
            } catch (\Exception $exception) {
                dump($orders_ext_ids);
            }

            $current_page++;
        } while($current_page < $count_pages);


    }

    public function getOrdersInfo(array $orders_ext_ids) {

//        print_r($orders_ext_ids);

        $exist_orders = Order::select('ext_id')
            ->whereIn('ext_id', array_values($orders_ext_ids))
            ->get()
            ->pluck('ext_id')
            ->toArray()
        ;

        $needed_ids = array_diff($orders_ext_ids, $exist_orders);
        $dom_ria_integration = new DomRia();

//        dump($needed_ids);

        foreach ($needed_ids as $id) {
            $response = $dom_ria_integration->getOrderInfo($id);

            try {
                $this->createOrder($response, $id);
            } catch (Exception $e) {
                dump('Error create order ' + $id);
            }
        }





    }

    public function getOrdersFromDomRia_old() {
        $exist_ext_ids = Order::orderBy('ext_id', 'DESC')->get('ext_id');
        $last_ext_id = $exist_ext_ids->first();
        $last_ext_id = $last_ext_id ? $last_ext_id->ext_id : null;

//        dump($last_ext_id);
//        dd($exist_ext_ids->pluck('ext_id')->toArray());

        $dom_ria_integration = new DomRia();

        $page = 1;
        $is_need_next_page = true;
        while ($page <= 9 && $is_need_next_page) {
            $filter = [
                'city_id' => 1 // Вінниця
            ];

            $result = $dom_ria_integration->getOrdersFromApi($page, array_merge(['date_from' => '2020-05-31 18:00'], $filter));

            dump($result);

            $order_ext_ids = $result['items'];
            $index_exist_element = array_search($last_ext_id, $order_ext_ids);

            /*if($index_exist_element !== false) {
                $is_need_next_page = false;
                $order_ext_ids = array_slice($order_ext_ids, 0, $index_exist_element);
            }*/

            $this->getOrdersInfo_old($order_ext_ids, $exist_ext_ids->pluck('ext_id')->toArray());

            $page++;
        }
    }


    public function getOrdersInfo_old(array $ext_ids, array $exist_ids = []) {
        $dom_ria_integration = new DomRia();

        ini_set('max_execution_time', 0);

        dump(['count' => count($ext_ids)]);

        $count_created = 0;
        $executed_ids = [];
        foreach ($ext_ids as $ext_id) {
            if(in_array($ext_id, $exist_ids)) {
                $executed_ids[] = $ext_id;

                continue;
            }

            $response = $dom_ria_integration->getOrderInfo($ext_id);
            $response_arr = json_decode($response, true);

            /*Order::create([
                'ext_id' => $ext_id,
                'api_data' => $response
            ]);*/

//            if($ext_id != 16373469)
//                dd($response_arr);


            $this->createOrder($response, $ext_id);

            $count_created++;
        }

//        dump(['$count_created' => $count_created]);
//        dump(['$executed_ids' => $executed_ids]);
    }

    private function createOrder($response, $ext_id) {
        $response_arr = json_decode($response, true);

//        dd($response);

//        echo $response;
//        die();

        try {
            Order::create([
                'ext_id' => $ext_id,
                'state_id' => isset($response_arr['state_id']) ? $response_arr['state_id'] : null,
                'city_id' => isset($response_arr['city_id']) ? $response_arr['city_id'] : null,
                'district_id' => isset($response_arr['district_id']) ? $response_arr['district_id'] : null,
                'street_id' => isset($response_arr['street_id']) && !empty($response_arr['street_id']) ? $response_arr['street_id'] : null,
                'state_name' => isset($response_arr['state_name']) ? $response_arr['state_name'] : null,
                'city_name' => isset($response_arr['city_name']) ? $response_arr['city_name'] : null,
                'district_name' => isset($response_arr['district_name']) ? $response_arr['district_name'] : null,
                'street_name' => isset($response_arr['street_name']) ? $response_arr['street_name'] : null,
                'building_number_str' => isset($response_arr['building_number_str']) ? $response_arr['building_number_str'] : null,
                'flat_number' => isset($response_arr['flat_number']) ? $response_arr['flat_number'] : null,
                'beautiful_url' => isset($response_arr['beautiful_url']) ? $response_arr['beautiful_url'] : null,
                'description' => isset($response_arr['description']) ? $response_arr['description'] : null,
                'total_square_meters' => isset($response_arr['total_square_meters']) ? $response_arr['total_square_meters'] : null,
                'price' => isset($response_arr['price']) ? $response_arr['price'] : null,
                'main_photo' => isset($response_arr['main_photo']) ? $response_arr['main_photo'] : null,
                'photos' => isset($response_arr['photos']) ? json_encode($response_arr['photos']) : '{}',
                'characteristics_values' => isset($response_arr['characteristics_values']) ? json_encode($response_arr['characteristics_values']) : '{}',
                'rooms_count' => isset($response_arr['rooms_count']) ? $response_arr['rooms_count'] : null,
                'currency_type' => isset($response_arr['currency_type']) ? $response_arr['currency_type'] : null,
                'wall_type' => isset($response_arr['wall_type']) ? $response_arr['wall_type'] : null,
                'publishing_date' => isset($response_arr['publishing_date']) ? $response_arr['publishing_date'] : null,
                'youtube_link' => isset($response_arr['youtube_link']) ? $response_arr['youtube_link'] : null,
                'floor' => isset($response_arr['floor']) ? $response_arr['floor'] : null,
                'floors_count' => isset($response_arr['floors_count']) ? $response_arr['floors_count'] : null,
                'created_date' => isset($response_arr['created_at']) ? $response_arr['created_at'] : null,
                'realty_sale_type' => isset($response_arr['realty_sale_type']) ? $response_arr['realty_sale_type'] : null,
                'date_end' => isset($response_arr['date_end']) ? $response_arr['date_end'] : null,
                'advert_type_id' => isset($response_arr['advert_type_id']) ? $response_arr['advert_type_id'] : null,
                'realty_type_parent_id' => isset($response_arr['realty_type_parent_id']) ? $response_arr['realty_type_parent_id'] : null,
                'realty_type_id' => isset($response_arr['realty_type_id']) ? $response_arr['realty_type_id'] : null,
                'priceArr' => isset($response_arr['priceArr']) ? json_encode($response_arr['priceArr']) : '{}',
                'all_response' => $response,
            ]);
        } catch (\Exception $e) {
            dump($e->getMessage());
//            dump($e->getMessage());
        }
    }


}

/*

https://dom.ria.com/ru/realty-perevireno-prodaja-kvartira-vinnitsa-staryiy-gorod-pokryishkina-ulitsa-17132037.html


https://cdn.riastatic.com/photos/dom/photo/11240/1124046/112404659/112404659b.jpg
                                 dom/photo/11240/1124046/112404659/112404659.jpg

*/
