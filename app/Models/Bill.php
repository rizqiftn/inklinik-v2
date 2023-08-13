<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bill_t';

    protected $primaryKey = 'bill_id';

    protected $fillable = ['admission_id'];
}
