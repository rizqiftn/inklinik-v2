<?php

namespace App\Http\Controllers\Backend;

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
        return response()->json([
            'message' => 'Success retrieve dashboard data',
            'data' => [
                'pasien_menunggu_diperiksa' => 0,
                'total_pasien_hari_ini' => 0,
                'rata_rata_waktu_pelayanan' => 15,
                'avg_symptoms' => [
                    [
                        'symptoms' => 'Sakit Perut',
                        'waktu_pelayanan' => '10 Menit'
                    ],
                    [
                        'symptoms' => 'Sakit Kepala',
                        'waktu_pelayanan' => '15 Menit'
                    ],
                ]
            ]
        ]);
    }
}
