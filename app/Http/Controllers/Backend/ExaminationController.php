<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admission as ModelsAdmission;
use App\Models\Anamnesis;
use App\Models\Bill;
use App\Models\BillInstruction;
use App\Models\BillMedicine;
use App\Models\Examination;
use App\Models\Groupage;
use App\Models\Instruction;
use App\Models\Medicine;
use App\Repositories\Admission;
use App\Repositories\Options;
use App\Repositories\Patient;
use Carbon\Carbon;
use DB;
use DateTime;
use stdClass;

class ExaminationController extends Controller
{
    //

    public function list()
    {
        return view('backend.examination.list');
    }

    public function form($admissionId)
    {
        $admissionData = (new Admission)->getAdmission($admissionId)->get()->first();

        // update admission status when form open
        if ( $admissionData->admission_status == config('global.reference.admission_status_belumdiperiksa')) {
            (new Admission)->updateAdmissionStatus($admissionId, [
                'admission_status' => config('global.reference.admission_status_periksa'),
                'updated_at' => Carbon::now()
            ]);
        }

        // find patient information
        $patientInformation = (new Patient)->getPatientById($admissionData->patient_id);

        // create new object for add patient age
        $findAge = new stdClass;
        $findAge->patient_age = $admissionData->patient_age;

        // merge patient and age object
        $patientInformation = (object) array_merge((array) $patientInformation, (array) $findAge);

        return view('backend.examination.form', compact('patientInformation', 'admissionData', 'admissionId', 'findAge'));
    }

    public function storeExamination(Request $request)
    {
        $postdata = [
            'examination' => [
                'admission_id' => $request->post('admission_id'),
                'dic_id' => $request->post('dic_id'),
                'symptoms' => $request->post('symptoms'),
                'primary_diagnose_code' => $request->post('primary_diagnose_code'),
                'secondary_diagnose_code' => $request->post('secondary_diagnose_code'),
                'medical_recommendation' => $request->post('medical_recommendation'),
                'examination_date' => date('Y-m-d H:i:00'),
            ],
            'anamnesis' => [
                'examination_id' => null,
                'symptoms' => $request->post('symptoms'),
                'height' => $request->post('height'),
                'weight' => $request->post('weight'),
                'body_temp' => $request->post('body_temp'),
                'blood_pulse' => $request->post('blood_pulse'),
                'respiratory_rate' => $request->post('respiratory_rate'),
                'blood_pressure' => $request->post('blood_pressure'),
            ],
            'bill' => [
                'admission_id' => $request->post('admission_id'),
                'billInstruction' => json_decode($request->post('instruction', json_encode([])), true),
                'billMedicine' => json_decode($request->post('pharmacy', json_encode([])), true),
            ],
        ];
        DB::transaction(function() use ($postdata) {

            // save examination data
            $saveExamination = Examination::updateOrCreate(['admission_id' => $postdata['examination']['admission_id']], $postdata['examination']);

            // save anamnesis data
            $postdata['anamnesis']['examination_id'] = $saveExamination->examination_id;
            Anamnesis::updateOrCreate(['examination_id' => $saveExamination->examination_id], $postdata['anamnesis']);

            // save bill
            $saveBillHeader = Bill::create([
                'admission_id' => $postdata['bill']['admission_id']
            ]);

            // save bill instruction detail
            if ( count($postdata['bill']['billInstruction']) ) {
                $instructionData = $postdata['bill']['billInstruction'];
                $instructionId = [];
                foreach( $instructionData as $key => $value ) {
                    $instructionId[] = (int) $value['instruction_id'];
                }

                $getAllInstructionData = Instruction::whereIn('instruction_id', $instructionId)->get();

                $instructionItemPrice = [];
                foreach( $getAllInstructionData as $item => $instruction ) {
                    $instructionItemPrice[$instruction->instruction_id] = $instruction->price;
                }

                foreach( $instructionData as $key => $value ) {
                    $instructionData[$key]['instruction_base_price'] = $instructionItemPrice[$value['instruction_id']];
                    $instructionData[$key]['instruction_total_price'] = $instructionItemPrice[$value['instruction_id']] * $value['instruction_qty'];
                    $instructionData[$key]['dic_id'] = $postdata['examination']['dic_id'];
                    $instructionData[$key]['bill_id'] = $saveBillHeader->bill_id;
                    $instructionData[$key]['created_at'] = date('Y-m-d H:i:00');
                }

                BillInstruction::insert($instructionData);
            }

            // save bill medicine detail
            if ( count($postdata['bill']['billMedicine']) ) {
                $medicineData = $postdata['bill']['billMedicine'];
                $medicineId = [];
                foreach( $medicineData as $key => $value ) {
                    $medicineId[] = (int) $value['medicine_id'];
                }

                $getAllMedicineData = Medicine::whereIn('medicine_id', $medicineId)->get();
                $medicineItemData = [];
                foreach( $getAllMedicineData as $item => $medicine ) {
                    $medicineItemData[$medicine->medicine_id] = $medicine;
                }

                foreach( $medicineData as $key => $value ) {
                    $medicineData[$key]['medicine_base_price'] = $medicineItemData[$value['medicine_id']]->price;
                    $medicineData[$key]['medicine_total_price'] = $medicineItemData[$value['medicine_id']]->price * $value['medicine_qty'];
                    $medicineData[$key]['medicine_unit'] = $medicineItemData[$value['medicine_id']]->unit;
                    $medicineData[$key]['dic_id'] = $postdata['examination']['dic_id'];
                    $medicineData[$key]['bill_id'] = $saveBillHeader->bill_id;
                    $medicineData[$key]['created_at'] = date('Y-m-d H:i:00');
                }

                BillMedicine::insert($medicineData);
            }
            
            // update admission status when patient status is diperiksa
            ModelsAdmission::where('admission_id', $postdata['bill']['admission_id'])->where('admission_status', config('global.reference.admission_status_periksa'))->update(['admission_status' => config('global.reference.admission_status_pulang')]);
        });


        return response()->json([
            'message' => 'Save examination success!',
            'postdata' => $postdata
        ]);
    }

    public function getData(Request $request)
    {
        $admissionData = (new Admission)->getAdmissionList()->where('admission_status', '!=', config('global.reference.admission_status_pulang'));
        // $admissionData->whereBetween('admission_t.created_at', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:00')]);
        $result = [];
        foreach( $admissionData->get()->toArray() as $key => $admissionItem ) {
            $result[] = $admissionItem;
        }
        return response()->json([
            'message' => 'Success get admission data',
            'draw' => $request->get('draw'),
            'recordsTotal' => 1,
            'recordsFiltered' => 1,
            'data' => $result
        ]);
    }

    public function getPrimaryDiagnose(Request $request)
    {
        return response()->json([
            'message' => 'Success get diagnose data',
            'data' => (new Options)->getDiagnoseList($request->get('search'))
        ]);
    }

    public function getInstruction(Request $request)
    {
        return response()->json([
            'message' => 'Success get instruction data',
            'data' => (new Options)->getInstructionList($request->get('search'))
        ]);
    }

    public function getMedicine(Request $request)
    {
        return response()->json([
            'message' => 'Success get medicine data',
            'data' => (new Options)->getMedicineList($request->get('search'))
        ]);
    }
}
