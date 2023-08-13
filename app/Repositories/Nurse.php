<?php

namespace App\Repositories;

use App\Repositories\BaseRepositories;

class Nurse extends BaseRepositories {
    public function __construct()
    {
        $this->table = 'nurse_m';
    }

    public function getNurseByUser($userId)
    {
        return $this->dbHandler()
                    ->select(
                        'nurse_m.nurse_id',
                        'nurse_m.nurse_registration_number',
                        'staff_m.staff_name',
                    )
                    ->join('staff_m', 'staff_m.staff_id', '=', 'nurse_m.staff_id')
                    ->where('staff_m.user_id', '=', $userId)->get()->first();
    }
}