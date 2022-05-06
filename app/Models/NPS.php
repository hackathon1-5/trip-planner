<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NPS extends Model
{
    use HasFactory;

    private $apiKey;
    private $url;

    public function __construct($apiKey = null) {
        if ($apiKey == null) {
            $apiKey = env('NPS_API_KEY', '');
        }
        $this->apiKey = $apiKey;
        $this->url = 'https://developer.nps.gov/api/v1/';
    }

    protected function call(string $endpoint, array $params = null) {
        $curl = curl_init();
        $dataURL = $this->url . $endpoint . http_build_query($params);
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $dataURL,
//            CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
            CURLOPT_HTTPHEADER => array('X-Api-Key: ' . $this->apiKey)
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function getParks($q = null) {
        return $this->call('parks', ['q' => $q]);
    }
}
