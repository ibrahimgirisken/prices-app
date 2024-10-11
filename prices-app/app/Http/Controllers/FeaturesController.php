<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\features;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function getProductGroupByIdEdit(Request $request)
    {
        $features = features::find('id', $request->id);
        if (!$features) {
            return response()->json(["error" => ""], 404);
        }
        return response()->json([]);
    }

    public function getFeaturesEdit()
    {
        $features = features::all();
        $departments=department::all();
        return view("frontend.pages.feature-edit")->with("features", $features)->with("departments",$departments);
    }

    public function postFeaturesEdit(Request $request)
    {
        try {
            $ids = $request->input('Id');
            $departmentIds = $request->input('departmentId');
            foreach($ids as $key =>$id){
                features::where("id",$id)->update(
                    [
                        'department'=>$departmentIds[$key]
                    ]);
            }
            features::where("id", $request->id)->update(
                [
                    'department' => $request->department
                ]
            );
            return response(['status' => 'success', 'title' => 'Başarılı', 'content' => 'Güncellendi!']);
        } catch (\Throwable $e) {
            return response(['status' => 'error', 'title' => 'Başarısız', 'content' => 'Güncellenemedi ' . $e]);
        }
    }
}
