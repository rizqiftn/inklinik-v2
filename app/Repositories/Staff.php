<?php

namespace App\Repositories;

use App\Repositories\BaseRepositories;

class Staff extends BaseRepositories {

    protected $type;

    public function __construct()
    {
        switch ($this->type) {
            case 'nurse':
                $this->table = 'nurse_m';
                break;
            
            default:
                $this->table = 'doctor_m';
                break;
        }
    }
}