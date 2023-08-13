<?php

namespace App\Repositories;

use App\Models\Patient as modelPatient;
use App\Repositories\BaseRepositories;

class Patient extends BaseRepositories {

    public function __construct()
    {
        $this->table = 'patient_m';
    }

    public function createPatient($data)
    {
        return $this->dbHandler()->insert([
            'patient_name' => $data['name'],
            'user_id' => $data['user_id'],
            'patient_dob' => $data['dob'],
            'identity_id' => $data['identity_type'],
            'identity_number' => $data['identity_number'],
            'sex' => $data['sex'],
            'patient_dob' => $data['dob'],
            'province_id' => $data['province_id'],
            'city_id' => $data['city_id'],
            'region_id' => $data['district_id'],
            'address' => $data['address'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number']
        ]);
    }

    public function getPatient($userId)
    {
        return $this->dbHandler()->select(
            'patient_m.patient_id',
            'patient_m.patient_name',
            'reference_m.reference_value as patient_sex',
            'patient_m.patient_dob',
            'patient_m.phone_number',
            'patient_m.address'
        )
        ->join('reference_m', 'reference_m.reference_id', '=', 'patient_m.sex')
        ->where('user_id', '=', $userId)
        ->first();
    }

    public function getPatientById($patientId)
    {
        return $this->dbHandler()->select(
            'patient_m.patient_id',
            'patient_m.patient_name',
            'reference_m.reference_value as patient_sex',
            'patient_m.patient_dob',
            'patient_m.phone_number',
            'patient_m.address',
        )
        ->join('reference_m', 'reference_m.reference_id', '=', 'patient_m.sex')
        ->where('patient_m.patient_id', '=', $patientId)
        ->first();
    }
}