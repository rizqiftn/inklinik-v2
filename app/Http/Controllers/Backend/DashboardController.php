<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admission;
use DB;

/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.dashboard');
    }

    public function dashboardData()
    {
        $countWaitingAdmission = Admission::where('admission_status', '=', config('global.reference.admission_status_belumdiperiksa'))
                                            ->where(DB::raw("date(created_at)"), '=', date('Y-m-d'));
        $countPatientToday = Admission::where(DB::raw("date(created_at)"), '=', date('Y-m-d'));
        $averageSymptoms = Admission::select(
                                                DB::raw("DISTINCT(admission_t.symptoms)"),
                                                DB::raw("AVG(examination_logs.time_diff) as waktu_pelayanan")
                                            )
                                            ->join('examination_logs', 'examination_logs.admission_id', '=', 'admission_t.admission_id')
                                            ->where('examination_logs.examination_start', '!=', null)
                                            ->where('examination_logs.examination_end', '!=',  null)
                                            ->groupBy('admission_t.symptoms')->get()->toArray();
        $totalAvg = 0;
        if ( $averageSymptoms ) {
            foreach( $averageSymptoms as $key => $averageItem ) {
                $totalAvg += ($averageItem['waktu_pelayanan'] / 60);
            }

            $totalAvg = floor($totalAvg / count($averageSymptoms));
        }
        return response()->json([
            'message' => 'Success retrieve dashboard data',
            'data' => [
                'pasien_menunggu_diperiksa' => $countWaitingAdmission->count(),
                'total_pasien_hari_ini' => $countPatientToday->count(),
                'rata_rata_waktu_pelayanan' => $totalAvg,
                'avg_symptoms' => $averageSymptoms
            ]
        ]);
    }
}
