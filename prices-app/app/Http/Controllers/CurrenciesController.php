<?php

namespace App\Http\Controllers;

use App\Models\currencies;
use Illuminate\Http\Request;

class CurrenciesController extends Controller
{
    public function getCurrencyEdit()
    {
        $currencyDatas = currencies::all();
        return view("frontend.pages.currency-edit")->with("currencyDatas", $currencyDatas);
    }

    public function postCurrencyEdit(Request $request)
    {
        try {
            $currency = $request->input('currencyData');
            $discountData = $request->input('discount');
    
                currencies::where("id",1)->update(
                    [   'currencyData' => $currency,
                        'discount' => $discountData
                    ]
                );
            return response(['status' => 'success', 'title' => 'Başarılı', 'content' => 'Komisyon Oranları Güncellendi!']);
        } catch (\Throwable $e) {
            return response(['status' => 'error', 'title' => 'Başarısız', 'content' => 'Komisyon Oranları Güncellenemedi ' . $e]);
        }
        
    }
}
