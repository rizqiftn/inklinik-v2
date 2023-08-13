<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Repositories\Admission;
use App\Repositories\Examination;
use DB;

class PaymentController extends Controller
{
    //
    public function list()
    {
        return view('backend.payment.list');
    }

    public function form($billId)
    {
        $getBillData = (new Examination)->getExaminationBill($billId);
        return view('backend.payment.form', compact('getBillData', 'billId'));
    }

    public function getData(Request $request)
    {
        $admissionData = (new Admission)->getUnpaidAdmission();
        $result = [];
        foreach( $admissionData->get()->toArray() as $key => $admissionItem ) {
            $result[] = $admissionItem;
        }
        return response()->json([
            'message' => 'Success get admission data',
            'draw' => $request->get('draw'),
            'recordsTotal' => count($result),
            'recordsFiltered' => count($result),
            'data' => $result
        ]);
    }

    public function store(Request $request)
    {
        $postdata = $request->post();
        
        $postdata['total_amount'] = (int) str_replace('.', '', $postdata['total_amount']);
        $postdata['total_payment'] = (int) str_replace('.', '', $postdata['total_payment']);
        $postdata['changes'] = (int) str_replace('.', '', $postdata['changes']);

        $getBillData = (new Examination)->getExaminationBill($postdata['bill_id'], false);
        $getBillHeader = Bill::where('bill_id', $postdata['bill_id'])->first();

        $postdata['admission_id'] = $getBillHeader->admission_id;
        DB::transaction( function() use ($getBillData, $postdata) {
            $savePayment = Payment::create([
                'admission_id' => $postdata['admission_id'],
                'total_amount' => $postdata['total_amount'],
                'total_payment' => $postdata['total_payment'],
                'changes' => $postdata['changes'],
            ]);
    
            $paymentDetail = [];
            foreach($getBillData as $key => $billItem) {
                $paymentDetail[] = [
                    'payment_id' => $savePayment->payment_id,
                    'item_name' => $billItem->item_name,
                    'item_type' => $billItem->jenis,
                    'item_qty' => $billItem->item_qty,
                    'item_unit' => $billItem->unit,
                    'item_base_price' => $billItem->item_base_price,
                    'item_total_price' => $billItem->item_total_price,
                    'created_at' => date('Y-m-d H:i:00')
                ];
            }

            PaymentDetail::insert($paymentDetail);

            Bill::where('bill_id', $postdata['bill_id'])->where('payment_status', config('global.reference.payment_status_unpaid'))->update(['payment_status' => config('global.reference.payment_status_paid')]);
        } );

        return response()->json([
            'message' => 'Sukses',
            'data' => $postdata
        ]);
    }
}
