<?php

namespace App\Repositories;

use App\Repositories\BaseRepositories;
use Illuminate\Support\Facades\DB;

class Examination extends BaseRepositories {
    public function getAvgExaminationTime($symptoms = '', $faskesId = 1)
    {
        $avgExaminationTime = config('global.reference.waiting_time');

        if ( !empty($symptoms) ) {
            $data = DB::table('examination_logs')
                        ->select(DB::raw("AVG(time_diff) as time_diff"))
                        ->join('admission_t', 'admission_t.admission_id', '=', 'examination_logs.admission_id')
                        ->where('symptoms' , 'like', '%'.$symptoms.'%')->where('faskes_id', '=', $faskesId)->get()->first();

            return $data->time_diff == null ? $avgExaminationTime : $data->time_diff;
        }
        return $avgExaminationTime;
    }

    public function getExaminationBill($billId, $groupped = true)
    {
        $getInstructionBill = DB::table('billinstruction_t')
                                    ->select(
                                        DB::raw("'Tindakan' as jenis"),
                                        "billinstruction_t.billinstruction_id",
                                        "billinstruction_t.instruction_id",
                                        "bill_t.admission_id",
                                        "instruction_m.instruction_name as item_name",
                                        "billinstruction_t.instruction_qty as item_qty",
                                        "billinstruction_t.instruction_qty as item_qty_unit",
                                        "instruction_m.unit",
                                        "billinstruction_t.instruction_base_price as item_base_price",
                                        "billinstruction_t.instruction_total_price as item_total_price"
                                    )
                                    ->join('bill_t', 'bill_t.bill_id', '=', 'billinstruction_t.bill_id')
                                    ->join('instruction_m', 'instruction_m.instruction_id', '=', 'billinstruction_t.instruction_id')
                                    ->where('bill_t.bill_id' , '=', $billId)
                                    ->get()
                                    ->toArray();
        $getMedicineBill = DB::table('billmedicine_t')
                                    ->select(
                                        DB::raw("'Obat / Alkes' as jenis"),
                                        "billmedicine_t.billmedicine_id",
                                        "billmedicine_t.medicine_id",
                                        "bill_t.admission_id",
                                        "medicine_m.medicine_name as item_name",
                                        "billmedicine_t.medicine_qty as item_qty",
                                        DB::raw("CONCAT(billmedicine_t.medicine_qty, ' ', billmedicine_t.medicine_unit) AS item_qty_unit"),
                                        "billmedicine_t.medicine_unit as unit",
                                        "billmedicine_t.medicine_base_price as item_base_price",
                                        "billmedicine_t.medicine_total_price as item_total_price"
                                    )
                                    ->join('bill_t', 'bill_t.bill_id', '=', 'billmedicine_t.bill_id')
                                    ->join('medicine_m', 'medicine_m.medicine_id', '=', 'billmedicine_t.medicine_id')
                                    ->where('bill_t.bill_id' , '=', $billId)
                                    ->get()
                                    ->toArray();
        return $groupped ? [
            'Tindakan' => $getInstructionBill,
            'Obat / Alkes' => $getMedicineBill
        ] : array_merge($getInstructionBill, $getMedicineBill);
    }
}