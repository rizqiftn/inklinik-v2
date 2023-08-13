<?php

namespace App\Repositories;

use App\Repositories\BaseRepositories;

class Medicine extends BaseRepositories {

    public function __construct()
    {
        $this->table = 'medicine_m';
    }

    public function getMedicine($medicine)
    {
        $queryMedicine = $this->dbHandler()->select(
            'medicine_m.medicine_id',
            'medicine_m.medicine_name',
            'medicine_m.price',
            'medicine_m.unit',
        );

        if ( !empty($diagnosa) ) {
            $queryMedicine->where('medicine_name', 'like', '%'.strtolower($medicine).'%', 'or');
        }

        return $queryMedicine->limit(200)->get()->toArray();
    }

}