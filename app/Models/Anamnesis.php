<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anamnesis extends Model
{
    use HasFactory;

    protected $table = 'anamnesis_t';

    protected $primaryKey = 'anamnesis_id';

    protected $fillable = ['examination_id', 'symptoms', 'height','weight', 'body_temp', 'blood_pulse', 'respiratory_rate', 'blood_pressure'];
}
