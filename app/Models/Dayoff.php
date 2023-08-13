<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dayoff extends Model
{
    use HasFactory;

    protected $table = 'dayoff_m';

    protected $primaryKey = 'dayoff_id';

    protected $fillable = ['dayoff_date', 'reason'];
}
