<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupage extends Model
{
    use HasFactory;

    protected $table = 'groupage_m';

    protected $primaryKey = 'groupage_id';
}
