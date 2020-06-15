<?php

namespace App\Classes\Integrations;

class DomRia {

    public function getOptions($category = null, $realty_type = null, $operation_type = null) {
        $url = "https://developers.ria.com/dom/options?category={$category}&realty_type={$realty_type}&operation_type={$operation_type}&api_key=" . config('common.ria_api_key');

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

    public function getOrder($id = 16579752) {
        $url = "https://developers.ria.com/dom/info/{$id}?api_key=" . config('common.ria_api_key');

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


    public function getOrdersFromApi(int $page = 0, array $filter = []) {
        $response = $this->sendRequest('search', array_merge(['page' => $page], $filter));
        $response_array = json_decode($response, true);

        return $response_array;
    }

    public function getOrderInfo($ext_id) {
        return $this->sendRequest('info', ['ext_id' => $ext_id]);
    }

    private function getApiURL(string $method, array $params = []) {
        $params['api_key'] = config('common.ria_api_key');

        $url = '';

        switch ($method) {
            case 'search':
                $url = 'https://developers.ria.com/dom/search?' . http_build_query($params);

                echo $url;

                break;

            case 'info':
                $url = "https://developers.ria.com/dom/info/" . $params['ext_id'] . "?api_key=" . config('common.ria_api_key');
                break;
        }

        return $url;
    }

    private function sendRequest(string $method, array $params = []) {
        $url = $this->getApiURL($method, $params);

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

//        echo $response;

        curl_close($curl);

        return $response;
    }

}
