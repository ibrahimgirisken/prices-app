<?php

namespace App\Http\Controllers;

use App\Models\XmlProducts;
use Illuminate\Http\Request;

class XmlProductsController extends Controller
{
    public function xmlProductUpdate()
    {
        try {
            $response = 'https://cw-xml.com/solar-sanal-market/016/products.xml';
            $xml = simplexml_load_file($response);
            foreach ($xml->product as $item) {

                XmlProducts::updateOrCreate(
                    ['productCode' => $item->productCode],
                    [
                        'brand' => $item->brand,
                        'productCode' => $item->productCode,
                        'desi' => (int) $item->desi,
                        'price' => $item->price,
                        'stock' => $item->quantity,
                    ]
                );
            }
            return view('frontend.pages.xml-update')->with('status', 'Başarıyla güncellendi!');            
        } catch (\Throwable $e) {
            return view('frontend.pages.xml-update')->with('error', 'Güncellenemedi!'. $e);
        }
    }

    public function getXmlEdit()
    {
        $xmlProducts = XmlProducts::all();
        return view("frontend.pages.xml-product-edit")->with("xmlProducts", $xmlProducts);
    }

    public function postXmlEdit(Request $request)
    {
        try {
            $code = $request->input('code');
            $productCodes = $request->input('productcode');
            $brands = $request->input('brand');
            $desis = $request->input('desi');
            $stocks = $request->input('stock');
            $prices = $request->input('price');

            foreach ($productCodes as $key => $productCode) {
                XmlProducts::updateOrCreate(
                    ['productcode' => $productCode],
                    [
                        'code' => $code[$key],
                        'brand' => $brands[$key],
                        'desi' => $desis[$key],
                        'stock' => $stocks[$key],
                        'price' => $prices[$key],
                    ]
                );
            }
            return response(['status' => 'success', 'title' => 'Başarılı', 'content' => 'XML Fiyatları Güncellendi!']);
        } catch (\Throwable $e) {
            return response(['status' => 'error', 'title' => 'Başarısız', 'content' => 'XML Fiyatları Güncellenemedi ' . $e]);
        }
    }
}
