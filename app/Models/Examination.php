<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $table = 'examination_t';

    protected $primaryKey = 'examination_id';

    protected $fillable = ['admission_id', 'dic_id', 'symptoms', 'primary_diagnose_code', 'secondary_diagnose_code', 'examination_date', 'medical_recommendation'];

}
