<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $table = 'paymentdetail_t';

    protected $primaryKey = 'paymentdetail_id';

    protected $fillable = ['payment_id', 'item_name', 'item_type', 'item_qty', 'item_unit', 'item_base_price', 'item_total_price', 'created_at'];
}
