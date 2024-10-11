<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\earning_raties;
use Illuminate\Http\Request;

class EarningRatiesController extends Controller
{
    public function getEarningRatiesEdit()
    {
        $earning_raties = earning_raties::with("department")->get();
        $departments=department::all();
        return view("frontend.pages.department-earning-edit")->with("earning_raties", $earning_raties)->with('departments',$departments);
    }

    public function postEarningRatiesEdit(Request $request)
    {
        try {
            $departmentIds = $request->input('departmentId');
            $rates = $request->input('rate');
    
            foreach ($departmentIds as $key => $department) {
                earning_raties::updateOrCreate(
                    ['department_id' => $department],
                    [
                        'department_id' => $departmentIds[$key],
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
