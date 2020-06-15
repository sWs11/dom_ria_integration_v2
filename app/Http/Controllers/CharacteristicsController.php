<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OperationType;
use App\Models\RealtyType;
use Illuminate\Http\Request;

class CharacteristicsController extends Controller
{

    public function realtyCharacteristics() {
        $categories = Category::all();
        $operation_types = OperationType::all();
        $realty_types = RealtyType::select(['categories.name AS category_name', 'realty_types.*'])
            ->leftJoin('categories', 'realty_types.category_ext_id', 'categories.ext_id')
            ->get()
        ;

        $realty_types = $realty_types->groupBy('category_name');

        return view('main.realty_characteristics', [
            'categories' => $categories,
            'operation_types' => $operation_types,
            'realty_types' => $realty_types,
        ]);
    }

    public function getRealtyCharacteristicsFromApi(Request $request) {

        $url = "https://developers.ria.com/dom/options?"
            ."category=" . $request->get('category')
            ."lang_id=4"
            ."&realty_type=" . $request->get('realty_type')
            ."&operation_type=" . $request->get('operation_type')
            ."&api_key=" . config('common.ria_api_key')
        ;

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

        $options = json_decode($response, true);


        $char_names = [];
        foreach ($options as $option) {
            $char_names[] = $option['group_name'];
        }

        echo($response);
        dd($options);
//
    }
}
