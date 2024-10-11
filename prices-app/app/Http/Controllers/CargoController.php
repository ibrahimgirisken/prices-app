<?php

namespace App\Http\Controllers;

use App\Models\cargo;
use Illuminate\Http\Request;


class CargoController extends Controller
{
    public function getCargoEdit()
    {
        $cargoPrices = cargo::all();
        return view("frontend.pages.cargo-edit")->with("cargoPrices", $cargoPrices);
    }

    public function postCargoEdit(Request $request)
    {
        try {
            $minDesies = $request->input('minDesi');
            $maxDesies = $request->input('maxDesi');
            $prices = $request->input('price');
    
            foreach ($prices as $key => $price) {
                cargo::updateOrCreate(
                    ['price' => $price],
                    [
                        'minDesi' => $minDesies[$key],
                        'maxDesi' => $maxDesies[$key]
                    ]
                );
            }
            return response(['status' => 'success', 'title' => 'Başarılı', 'content' => 'Kargo Fiyatları Güncellendi!']);
        } catch (\Throwable $e) {
            return response(['status' => 'error', 'title' => 'Başarısız', 'content' => 'Kargo Fiyatları Güncellenemedi ' . $e]);
        }
        
    }
}
