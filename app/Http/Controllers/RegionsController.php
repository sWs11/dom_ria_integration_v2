<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionsController extends Controller
{
    public function getRegionsFromApi() {
        $url = "https://developers.ria.com/dom/states?api_key=" . config('common.ria_api_key');

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

        $regions = json_decode($response, true);

        echo $response;

        // $this->saveRegions($regions);
    }

    private function saveRegions(array $regions) {

        foreach ($regions as $region) {
            Region::create([
                'stateID' => $region['stateID'],
                'name' => $region['name'],
                'eng_name' => $region['eng_name'],
                'declension' => $region['declension'],
                'center_declension' => $region['center_declension'],
                'region_name' => $region['region_name'],
            ]);
        }
    }
}
