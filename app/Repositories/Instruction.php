<?php

namespace App\Repositories;

use App\Repositories\BaseRepositories;

class Instruction extends BaseRepositories {

    public function __construct()
    {
        $this->table = 'instruction_m';
    }

    public function getInstruction($instruction)
    {
        $queryInstruction = $this->dbHandler()->select(
            'instruction_m.instruction_id',
            'instruction_m.instruction_name',
            'instruction_m.price',
            'instruction_m.unit',
        );

        if ( !empty($diagnosa) ) {
            $queryInstruction->where('instruction_name', 'like', '%'.strtolower($instruction).'%', 'or');
        }

        return $queryInstruction->limit(200)->get()->toArray();
    }

}