<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillInstruction extends Model
{
    use HasFactory;

    protected $table = 'billinstruction_t';

    protected $primaryKey = 'billinstruction_id';

    protected $fillable = ['bill_id', 'instruction_id', 'bill_instruction_name','instruction_qty', 'instruction_base_price', 'instruction_total_price', 'dic_id', 'nic_id'];
}
