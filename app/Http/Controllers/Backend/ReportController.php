<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Groupage;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function generateReport()
    {
        return view('backend.report.form');
    }

    public function reportView(Request $request)
    { 
        // 1 = Morbiditas
        // 2 = Kunjungan
        if ( $request->post('report_type') == '1' ) {
            $reportTitle = 'Formulir R.L 4B <br/> Data Keadaan Morbiditas Rawat Jalan';
            $groupAge = Groupage::select('groupage_id', 'group_title')->get()->toArray();
            $viewFile = view('backend.report.partial.morbiditas', compact('groupAge'))->render();
        } else {
            $reportTitle = 'Formulir R.L 5.4 <br/> Daftar 10 Besar Penyakit Rawat Jalan';
            $viewFile = view('backend.report.partial.kunjungan')->render();
        }

        return response()->json([
            'message' => 'Success get report view',
            'title' => $reportTitle,
            'viewFile' => $viewFile
        ]);
    }
}

