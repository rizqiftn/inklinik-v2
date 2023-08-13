<?php

namespace App\Repositories;

use App\Repositories\Admission as ModelAdmission;
use App\Repositories\BaseRepositories;
use Illuminate\Support\Facades\DB;

class Admission extends BaseRepositories {

    public function __construct()
    {
        $this->table = 'admission_t';
    }
    public function createAdmission($data)
    {
        return $this->dbHandler()->insert([
            'patient_id' => $data['patient_id'],
            'dic_id' => $data['dic_id'],
            'nic_id' => $data['nic_id'],
            'queue_id' => $data['queue_id'],
            'symptoms' => $data['symptoms'],
            'symptom_notes' => $data['symptom_notes'],
            'patient_age' => $data['patient_age'],
            'height' => $data['height'],
            'weight' => $data['weight'],
            'body_temp' => $data['body_temp'],
            'blood_pulse' => $data['blood_pulse'],
            'blood_pressure' => $data['blood_pressure'],
            'respiratory_rate' => $data['respiratory_rate'],
            'admission_status' => config('global.reference.admission_status_belumdiperiksa'),
            'created_at' => date('Y-m-d H:i:00'),
            'groupage_id' => $data['groupage_id']
        ]);
    }

    public function getAdmission($admissionId)
    {
        return $this->dbHandler()
                    ->select(
                        'admission_t.admission_id',
                        'admission_t.patient_id',
                        'admission_t.height',
                        'admission_t.weight',
                        'admission_t.blood_pulse',
                        'admission_t.blood_pressure',
                        'admission_t.body_temp',
                        'admission_t.respiratory_rate',
                        'admission_t.symptoms',
                        'admission_t.symptom_notes',
                        'admission_t.admission_status',
                        'admission_t.dic_id',
                        'admission_t.patient_age'
                    )->where('admission_t.admission_id', '=', $admissionId);
    }

    public function getAdmissionList($admissionStatus = '')
    {
        $admissionQuery = $this->dbHandler()
                                ->select(
                                    'admission_t.admission_id',
                                    'admission_t.admission_number',
                                    'admission_t.patient_id',
                                    'queue_t.queue_number',
                                    'patient_m.patient_name',
                                    'patient_m.patient_dob',
                                    'doctor.staff_name as doctor_name',
                                    'nurse.staff_name as nurse_name',
                                    'admission_t.admission_status',
                                    'reference_m.reference_value as admission_status_text',
                                    'reference_sex.reference_value as sex',
                                    'admission_t.created_at as admission_date',
                                    'admission_t.patient_age'
                                );
        $admissionQuery->join('patient_m', 'patient_m.patient_id', '=', 'admission_t.patient_id');
        $admissionQuery->join('reference_m', 'reference_m.reference_id', '=', 'admission_t.admission_status');
        $admissionQuery->join('doctor_m', 'doctor_m.doctor_id', '=', 'admission_t.dic_id');
        $admissionQuery->join('staff_m as doctor', 'doctor.staff_id', '=', 'doctor_m.staff_id');
        $admissionQuery->join('nurse_m', 'nurse_m.nurse_id', '=', 'admission_t.nic_id');
        $admissionQuery->join('staff_m as nurse', 'nurse.staff_id', '=', 'nurse_m.staff_id');
        $admissionQuery->join('queue_t', 'queue_t.queue_id', '=', 'admission_t.queue_id', 'left');
        $admissionQuery->join('reference_m as reference_sex', 'reference_sex.reference_id', '=', 'patient_m.sex');
        if ( !empty($admissionStatus) ) {
            $admissionQuery->where('admission_t.admission_status', '=', $admissionStatus);
        }
        return $admissionQuery;
    }

    public function getUnpaidAdmission()
    {
        $admissionQuery = $this->dbHandler()->select(
            'admission_t.admission_id',
            'bill_t.bill_id',
            'admission_t.admission_number',
            'patient_m.patient_name',
            'patient_m.patient_dob',
            'staff_m.staff_name as doctor_name',
            'reference_m.reference_value as payment_status_text',
            'reference_sex.reference_value as sex',
            'bill_t.payment_status',
            'admission_t.patient_age'
        );

        $admissionQuery->join('bill_t', 'bill_t.admission_id', '=', 'admission_t.admission_id');
        $admissionQuery->join('patient_m', 'patient_m.patient_id', '=', 'admission_t.patient_id');
        $admissionQuery->join('doctor_m', 'doctor_m.doctor_id', '=', 'admission_t.dic_id');
        $admissionQuery->join('staff_m', 'doctor_m.staff_id', '=', 'staff_m.staff_id');
        $admissionQuery->join('reference_m', 'reference_m.reference_id', '=', 'bill_t.payment_status');
        $admissionQuery->join('reference_m as reference_sex', 'reference_sex.reference_id', '=', 'patient_m.sex');
        return $admissionQuery->where('bill_t.payment_status', '=', 17);
    }

    public static function printAdmission()
    {
        return [];
    }

    public static function getAdmissionHistory()
    {
        return [];
    }

    public function getSymptomList($symptoms = null)
    {
        $query = $this->dbHandler()
                    ->distinct('symptoms')
                    ->where('admission_status', '=', config('global.reference.admission_status_pulang'));
        if ( $symptoms ) {
            $query->where(DB::raw('lower(symptoms)'), 'like', '%'.strtolower($symptoms).'%');
        }
        return $query;
    }

    public function updateAdmissionStatus($admissionId, $updatedColumn)
    {
        return $this->dbHandler()->where('admission_id', $admissionId)->update($updatedColumn);
    }
}