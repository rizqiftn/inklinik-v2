<?php

namespace App\Repositories;

use App\Repositories\BaseRepositories;

class Diagnose extends BaseRepositories {

    public function __construct()
    {
        $this->table = 'diagnosa_m';
    }

    public function getDiagnoseList($diagnosa = '')
    {
        $queryDiagnosa = $this->dbHandler()->select(
            'diagnosa_m.diagnosa_id',
            'diagnosa_m.diagnosa_nama',
            'diagnosa_m.diagnosa_kode',
            'diagnosa_m.klasifikasi_diagnosa'
        );

        if ( !empty($diagnosa) ) {
            $queryDiagnosa->where('diagnosa_kode', 'like', '%'.strtolower($diagnosa).'%', 'or');
            $queryDiagnosa->where('diagnosa_nama', 'like' ,'%'.strtolower($diagnosa).'%', 'or');
        }

        return $queryDiagnosa->limit(200)->get()->toArray();
    }

}