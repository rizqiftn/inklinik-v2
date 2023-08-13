<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillMedicine extends Model
{
    use HasFactory;

    protected $table = 'billmedicine_t';

    protected $primaryKey = 'billmedicine_id';

    protected $fillable = ['bill_id', 'medicine_id', 'bill_medicine_name','medicine_qty', 'medicine_base_price', 'medicine_total_price', 'medicine_signa', 'medicine_unit','dic_id', 'nic_id'];
}
