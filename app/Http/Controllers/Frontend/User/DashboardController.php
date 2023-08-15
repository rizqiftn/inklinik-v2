<?php

namespace App\Http\Controllers\Frontend\User;

use App\Models\Queue as ModelsQueue;
use App\Repositories\Queue;
use Illuminate\Support\Facades\DB;

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
        $getActiveQueue = (new Queue)->getQueueByUser(auth()->user()->id);
        $getCountQueue = 0;
        if ( $getActiveQueue ) {
            $getCountQueue = ModelsQueue::where('schedule_id', '=', $getActiveQueue->schedule_id)
                            ->where('queue_id', '<', $getActiveQueue->queue_id)
                            ->where(DB::raw('date(time_attendance)'), '=', '2023-08-14')
                            ->where('queue_status', '=', config('global.reference.queue_status_antrian'))
                            ->count();
        }
        $getExaminationHistory = DB::table('admission_t')->select(
            'admission_t.admission_number',
            DB::raw('admission_t.created_at as admission_date'),
            DB::raw("staff_m.staff_name as doctor_name"),
            'anamnesis_t.height',
            'anamnesis_t.weight',
            'anamnesis_t.body_temp',
            'anamnesis_t.blood_pressure',
            'anamnesis_t.respiratory_rate',
            'anamnesis_t.blood_pulse',
            'examination_t.symptoms',
            'examination_t.medical_recommendation',
            'admission_t.symptom_notes',
            DB::raw("concat(diagnosa_m.diagnosa_kode, ' - ', diagnosa_m.diagnosa_nama) as diagnosa_utama"),
        )
        ->join('doctor_m', 'doctor_m.doctor_id', '=', 'admission_t.dic_id')
        ->join('staff_m', 'staff_m.staff_id', '=', 'doctor_m.staff_id')
        ->join('examination_t', 'examination_t.admission_id', '=', 'admission_t.admission_id')
        ->join('anamnesis_t', 'anamnesis_t.examination_id', '=', 'examination_t.examination_id')
        ->join('diagnosa_m', 'examination_t.primary_diagnose_code', '=', 'diagnosa_m.diagnosa_id')
        ->join('patient_m', 'admission_t.patient_id', '=', 'patient_m.patient_id')
        ->where('patient_m.user_id', '=', auth()->user()->id)
        ->get()
        ->toArray();

        return view('frontend.user.dashboard', compact('getActiveQueue', 'getCountQueue', 'getExaminationHistory'));
    }
}
