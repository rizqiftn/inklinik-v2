<?php

namespace App\Repositories;

use App\Repositories\BaseRepositories;

class Symptoms extends BaseRepositories {

    public function getSymptoms()
    {
        $this->table = 'admission_t';
        return [];
    }
}