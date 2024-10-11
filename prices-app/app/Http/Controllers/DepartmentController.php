<?php

namespace App\Http\Controllers;

use App\Models\department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function getDepartmentEdit()
    {
        $departments = department::all();
        return view("frontend.pages.department-edit")->with("departments", $departments);
    }

    public function postDepartmentEdit(Request $request)
    {
        try {
            $departments = $request->input('department');

            foreach ($departments as $key => $name) {
                department::updateOrCreate(
                    ['name' => $name],
                    [
                        'name' => $departments[$key]
                    ]
                );
            }
            return response(['status' => 'success', 'title' => 'Başarılı', 'content' => 'XML Fiyatları Güncellendi!']);
        } catch (\Throwable $e) {
            return response(['status' => 'error', 'title' => 'Başarısız', 'content' => 'XML Fiyatları Güncellenemedi ' . $e]);
        }
    }
}
