<?php

namespace App\Http\Controllers;

use App\Models\comission;
use App\Models\features;
use Illuminate\Support\Facades\Cache;
use App\Models\prices;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

class PricesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPrices()
    {
        $prices = Cache::get('prices', function () {
            return prices::all();
        });
        return view("frontend.pages.prices")->with('prices', $prices);
    }

    public function sendPriceTweakRequest()
    {
        $timestamp = time();
        $formatted_date = date("Y-m-d\TH:i:s.u\Z", $timestamp);
        $client = new Client([
            'verify' => false
        ]);

        $headers = [
            'Authorization' => 'Basic ZXRpY2FyZXQ1QGN3LWVuZXJqaS5jb206Y2FtZGl6LTd4eXBtdS1LZWtiZWQ=',
            'Content-Type' => 'application/json',
            'Cookie' => 'LanguageCode=tr-TR'
        ];

        $body = json_encode([
            'date' => $formatted_date,
            'productCode' => '',
            'page' => 0,
            'priceOrders' => [
                [
                    'fieldName' => 'string',
                    'descending' => true
                ]
            ]
        ]);

        $request = new Request('POST', 'https://app.pricetweak.com/ApiV2/Query', $headers, $body);

        try {
            $response = $client->send($request);
            $responseBody = $response->getBody()->getContents();
            $responseArray = json_decode($responseBody, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json(['status' => 'error', 'message' => 'Invalid JSON response'], 500);
            }

            if ($responseArray['isSuccess']) {
                prices::truncate();
                foreach ($responseArray['data'] as $row) {
                    foreach ($row['prices'] as $detail) {
                        if ($detail["available"]) {
                            $priceData = [
                                [
                                    'linkId' => $detail['linkId'],
                                    'productId' => $row['id'],
                                    'code' => $row['code'],
                                    'group_name' => $row['name'],
                                    'title' => $detail['name'],
                                    'platform' => $detail['site'],
                                    'seller' => $detail['sellerName'],
                                    'price' => $detail['price'],
                                    'ownership' => $detail['isMyPrice'] === true ? 1 : 0,
                                    'link' => $detail['link']
                                ]
                            ];
                            foreach ($priceData as $data) {
                                prices::create($data);
                            }
                            $featuresData = [
                                [
                                    'productId' => $row['id'],
                                    'code' => $row['code'],
                                    'name' => $row['name']
                                ]
                            ];
                            foreach ($featuresData as $feature) {
                                Features::updateOrCreate(
                                    ['productId' => $feature["productId"]],
                                    [
                                        'code' => $feature["code"],
                                        'name' => $feature["name"],
                                    ]
                                );
                            }
                            $platformData = [
                                [
                                    'platform' => $detail['site']
                                ]
                            ];
                            foreach ($platformData as $platform) {
                                comission::updateOrCreate(
                                    ['platform' => $platform['platform']], 
                                    [             
                                        'platform' => $platform['platform']
                                    ]
                                );
                            }
                        } else {
                        }
                    }
                }
            }
            $response = ["status" => "success", "message" => "Ürün Güncellemesi Yapıldı!"];
            return view("frontend.pages.update-price")->with("response", $response);
        } catch (\Exception $e) {
            $response = ["status" => "error", "message" => "Ürün Güncellemesi Hatalı!" . $e];
            return view("frontend.pages.update-price")->with("response", $response);
        }
    }
}
