<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    protected $table = 'queue_t';

    protected $primaryKey = 'queue_id';

    protected $fillable = ['schedule_id', 'patient_id', 'dic_id', 'symptoms', 'time_attendance', 'symptom_notes'];
}
