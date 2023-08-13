<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment_t';

    protected $primaryKey = 'payment_id';

    protected $fillable = ['admission_id', 'total_amount', 'total_payment', 'changes'];
}
