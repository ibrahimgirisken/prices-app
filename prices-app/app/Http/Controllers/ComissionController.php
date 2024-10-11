<?php

namespace App\Http\Controllers;

use App\Models\comission;
use Illuminate\Http\Request;

class ComissionController extends Controller
{
    public function getComissionEdit()
    {
        $comissionRates = comission::all();
        return view("frontend.pages.comission-edit")->with("comissionRates", $comissionRates);
    }

    public function postComissionEdit(Request $request)
    {
        try {
            $platforms = $request->input('platform');
            $products = $request->input('product');
            $rates = $request->input('rate');
    
            foreach ($platforms as $key => $platform) {
                comission::updateOrCreate(
                    ['platform' => $platform],
                    [
                        'product' => $products[$key],
                        'rate' => $rates[$key]
                    ]
                );
            }
            return response(['status' => 'success', 'title' => 'Başarılı', 'content' => 'Komisyon Oranları Güncellendi!']);
        } catch (\Throwable $e) {
            return response(['status' => 'error', 'title' => 'Başarısız', 'content' => 'Komisyon Oranları Güncellenemedi ' . $e]);
        }
        
    }
}
