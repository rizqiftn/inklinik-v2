<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class BaseRepositories {
    protected $table;
    protected $payload;

    protected function dbHandler()
    {
        return DB::table($this->table);
    }
}