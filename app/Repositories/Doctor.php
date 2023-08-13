<?php

namespace App\Repositories;

use App\Repositories\BaseRepositories;

class Doctor extends BaseRepositories {

    public function __construct()
    {
        $this->table = 'doctor_m';
    }

    public function getAllDoctors()
    {
        return $this->dbHandler()->select(
            'doctor_m.doctor_id',
            'doctor_m.doctor_registration_number',
            'staff_m.staff_name',
        )->join('staff_m', 'staff_m.staff_id', '=', 'doctor_m.staff_id')
        ->get();
    }
}