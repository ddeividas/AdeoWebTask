<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use GuzzleHttp\Client;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */

    public function index()
    {
        if (request()->input('city')) {
            $city = request()->input('city');
            $client = new Client();
            $response = $client->get( "https://api.meteo.lt/v1/places/$city/forecasts/long-term");
            $body = json_decode((string) $response->getBody(), true);

            $weather = $body['forecastTimestamps'][0]['conditionCode'];

            $products = Product::select('sku', 'name', 'price')
                ->where($weather, 1)
                ->get();

            $meteo_data = collect(['city', 'current_weather', 'recommended_products'])->combine([$body['place']['name'], $weather, $products])->toJson(JSON_PRETTY_PRINT);

            return response ($meteo_data, 200) ;
        }
    }
}
