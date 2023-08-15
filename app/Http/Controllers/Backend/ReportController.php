<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Groupage;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;
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
            $viewFile = $this->generateKunjungan();
        }

        return response()->json([
            'message' => 'Success get report view',
            'title' => $reportTitle,
            'viewFile' => $viewFile
        ]);
    }

    public function printReport()
    {
        
        $pdf = $this->generateKunjungan(true);
        // download PDF file with download method
        return $pdf->stream('laporan_kunjungan.pdf');
    }

    private function generateKunjungan($download = false)
    {
        $getData = DB::table('morbiditas_r')->select(
                    'diagnose_code',
                    'diagnose_name',
                    'sex',
                    DB::raw('COUNT(diagnose_code) as total_diagnosa'),
                    DB::raw('is_new_case as kasus_baru')
                )
                ->groupBy('diagnose_code', 'diagnose_name', 'sex', 'is_new_case')
                ->orderBy('total_diagnosa', 'desc')->get()->toArray();
        $result = [];
        foreach( $getData as $key => $diagnoseItem ) {
            $totalKasusLaki = $diagnoseItem->sex == 'L' ? $diagnoseItem->kasus_baru : 0;
            $totalKasusPerempuan = $diagnoseItem->sex == 'P' ? $diagnoseItem->kasus_baru : 0;
            $totalKunjungan = isset($result[$diagnoseItem->diagnose_code]['total_kunjungan']) ? $result[$diagnoseItem->diagnose_code]['total_kunjungan'] : 0;

            $result[$diagnoseItem->diagnose_code] = [
            'diagnose_code' => $diagnoseItem->diagnose_code,
            'diagnose_name' => $diagnoseItem->diagnose_name
            ];

            $result[$diagnoseItem->diagnose_code]['total_kasus_l'] = (isset($result[$diagnoseItem->diagnose_code]['total_kasus_l']) ? $result[$diagnoseItem->diagnose_code]['total_kasus_l'] : 0 ) + $totalKasusLaki;
            $result[$diagnoseItem->diagnose_code]['total_kasus_p'] = (isset($result[$diagnoseItem->diagnose_code]['total_kasus_p']) ? $result[$diagnoseItem->diagnose_code]['total_kasus_p'] : 0 ) + $totalKasusPerempuan;
            $result[$diagnoseItem->diagnose_code]['total_kasus_baru'] = $result[$diagnoseItem->diagnose_code]['total_kasus_l'] + $result[$diagnoseItem->diagnose_code]['total_kasus_p'];
            $result[$diagnoseItem->diagnose_code]['total_kunjungan'] = $totalKunjungan + $diagnoseItem->total_diagnosa;
        }
        if ( $download ) {
            return Pdf::loadView('backend.report.partial.kunjungan', compact('result'));
        }
        return view('backend.report.partial.kunjungan', compact('result'))->render();
    }
}

