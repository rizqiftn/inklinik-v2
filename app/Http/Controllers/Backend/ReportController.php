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
            $viewFile = $this->generateMorbiditas();
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

    public function printReport($reportType, $reportPeriode)
    {
        if ( $reportType == 'morbiditas') {
            $pdf = $this->generateMorbiditas(true);
            return $pdf->stream('laporan_morbiditas.pdf');
        } else {
            $pdf = $this->generateKunjungan(true);
            return $pdf->stream('laporan_kunjungan.pdf');
        }
    }

    private function generateMorbiditas( $download = false )
    {
        $groupAge = Groupage::select('groupage_id', 'group_title')->get()->toArray();
        $getData = DB::table('morbiditas_r')->select(
            'diagnose_code',
            'diagnose_name',
            'sex',
            DB::raw('COUNT(diagnose_code) as total_diagnosa'),
            DB::raw('SUM(is_new_case) as kasus_baru'),
            'groupage_id'
        )
        ->groupBy('diagnose_code', 'diagnose_name', 'sex', 'is_new_case', 'groupage_id')
        ->orderBy('diagnose_code', 'asc')->get()->toArray();

        $result = [];
        // dd($getData);
        foreach( $getData as $key => $morbiditasItem ) {
            $totalKasusLaki[$morbiditasItem->groupage_id] = (int) ($morbiditasItem->sex == 'L' ? $morbiditasItem->total_diagnosa : 0);
            $totalKasusPerempuan[$morbiditasItem->groupage_id] = (int) $morbiditasItem->sex == 'P' ? $morbiditasItem->total_diagnosa : 0;
            $totalKunjungan = isset($result[$morbiditasItem->diagnose_code]['total_kunjungan']) ? $result[$morbiditasItem->diagnose_code]['total_kunjungan'] : 0;

            if ( !isset( $result[$morbiditasItem->diagnose_code]) ) {
                $result[$morbiditasItem->diagnose_code] = [
                    'diagnose_code' => $morbiditasItem->diagnose_code,
                    'diagnose_name' => $morbiditasItem->diagnose_name,
                    'total_kasus_baru' => 0,
                    'total_kasus_baru_p' => 0,
                    'total_kasus_baru_l' => 0,
                    'total_kunjungan' => 0
                ];
                foreach ( $groupAge as $groupAgeKey => $groupAgeItem) {
                    $result[$morbiditasItem->diagnose_code]['groupage_data']['total_kasus_l_'.$groupAgeItem['groupage_id']] = ($morbiditasItem->sex == 'L' && $morbiditasItem->groupage_id == $groupAgeItem['groupage_id']) ? $morbiditasItem->total_diagnosa : 0;
                    $result[$morbiditasItem->diagnose_code]['groupage_data']['total_kasus_p_'.$groupAgeItem['groupage_id']] = ($morbiditasItem->sex == 'P' && $morbiditasItem->groupage_id == $groupAgeItem['groupage_id']) ? $morbiditasItem->total_diagnosa : 0;
                }
            } else {
                foreach ( $groupAge as $groupAgeKey => $groupAgeItem) {
                    $result[$morbiditasItem->diagnose_code]['groupage_data']['total_kasus_l_'.$groupAgeItem['groupage_id']] += ($morbiditasItem->sex == 'L' && $morbiditasItem->groupage_id == $groupAgeItem['groupage_id']) ? $morbiditasItem->total_diagnosa : 0;
                    $result[$morbiditasItem->diagnose_code]['groupage_data']['total_kasus_p_'.$groupAgeItem['groupage_id']] += ($morbiditasItem->sex == 'P' && $morbiditasItem->groupage_id == $groupAgeItem['groupage_id']) ? $morbiditasItem->total_diagnosa : 0;
                }
            }
        }

        if ( $download ) {
            $pdf = Pdf::loadView('backend.report.partial.morbiditas', compact('groupAge','result', 'download'));
            $pdf->setPaper('A4', 'landscape');
            return $pdf;
        }
        return view('backend.report.partial.morbiditas', compact('groupAge', 'result', 'download'))->render();
    }
    private function generateKunjungan($download = false)
    {
        $getData = DB::table('morbiditas_r')->select(
                    'diagnose_code',
                    'diagnose_name',
                    'sex',
                    DB::raw('COUNT(diagnose_code) as total_diagnosa'),
                    DB::raw('SUM(is_new_case) as kasus_baru')
                )
                ->groupBy('diagnose_code', 'diagnose_name', 'sex', 'is_new_case')
                ->orderBy('total_diagnosa', 'desc')->limit(10)->get()->toArray();
        $result = [];
        foreach( $getData as $key => $diagnoseItem ) {
            $totalKasusLaki = $diagnoseItem->sex == 'L' ? $diagnoseItem->kasus_baru : 0;
            $totalKasusPerempuan = $diagnoseItem->sex == 'P' ? $diagnoseItem->kasus_baru : 0;
            $totalKunjungan = isset($result[$diagnoseItem->diagnose_code]['total_kunjungan']) ? $result[$diagnoseItem->diagnose_code]['total_kunjungan'] : 0;

            if ( !isset($result[$diagnoseItem->diagnose_code]) ) {
                $result[$diagnoseItem->diagnose_code] = [
                    'diagnose_code' => $diagnoseItem->diagnose_code,
                    'diagnose_name' => $diagnoseItem->diagnose_name
                ];
                $result[$diagnoseItem->diagnose_code]['total_kasus_l'] = (isset($result[$diagnoseItem->diagnose_code]['total_kasus_l']) ? $result[$diagnoseItem->diagnose_code]['total_kasus_l'] : 0 ) + $totalKasusLaki;
                $result[$diagnoseItem->diagnose_code]['total_kasus_p'] = (isset($result[$diagnoseItem->diagnose_code]['total_kasus_p']) ? $result[$diagnoseItem->diagnose_code]['total_kasus_p'] : 0 ) + $totalKasusPerempuan;
                $result[$diagnoseItem->diagnose_code]['total_kasus_baru'] = $result[$diagnoseItem->diagnose_code]['total_kasus_l'] + $result[$diagnoseItem->diagnose_code]['total_kasus_p'];
                $result[$diagnoseItem->diagnose_code]['total_kunjungan'] = $totalKunjungan + $diagnoseItem->total_diagnosa;
            } else {
                $result[$diagnoseItem->diagnose_code]['total_kasus_l'] = (isset($result[$diagnoseItem->diagnose_code]['total_kasus_l']) ? $result[$diagnoseItem->diagnose_code]['total_kasus_l'] : 0 ) + $totalKasusLaki;
                $result[$diagnoseItem->diagnose_code]['total_kasus_p'] = (isset($result[$diagnoseItem->diagnose_code]['total_kasus_p']) ? $result[$diagnoseItem->diagnose_code]['total_kasus_p'] : 0 ) + $totalKasusPerempuan;
                $result[$diagnoseItem->diagnose_code]['total_kasus_baru'] = $result[$diagnoseItem->diagnose_code]['total_kasus_l'] + $result[$diagnoseItem->diagnose_code]['total_kasus_p'];
                $result[$diagnoseItem->diagnose_code]['total_kunjungan'] = $totalKunjungan + $diagnoseItem->total_diagnosa;
            }
        }

        if ( $download ) {
            return Pdf::loadView('backend.report.partial.kunjungan', compact('result', 'download'));
        }
        return view('backend.report.partial.kunjungan', compact('result', 'download'))->render();
    }
}

