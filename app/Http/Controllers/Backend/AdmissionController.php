<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Groupage;
use App\Models\Queue as ModelsQueue;
use App\Repositories\Admission;
use App\Repositories\Doctor;
use App\Repositories\Nurse;
use App\Repositories\Options;
use App\Repositories\Patient;
use App\Repositories\Schedule;
use App\Repositories\Queue;
use stdClass;

class AdmissionController extends Controller
{
    //

    public function add(Request $request)
    {
        $patientInformation = $queueData = [];

        if ($request->get('queue_id')) {
            $queueData = (new Queue)->getQueue($request->get('queue_id'));
        }

        if ( $queueData ) {
            $patientInformation = (new Patient)->getPatientById($queueData->patient_id);
            // create new object for add patient age
            $findAge = new stdClass;
            $findAge->patient_age = findAge($patientInformation->patient_dob);

            $patientInformation = (object) array_merge((array) $patientInformation, (array) $findAge);
        }

        $doctorOptions = (new Options)->getDoctorList();
        $nurseData = (new Nurse)->getNurseByUser(auth()->user()->id);

        return view('backend.admission.form', compact('queueData', 'patientInformation', 'doctorOptions', 'nurseData'));
    }

    public function queueForm()
    {
        $queueCount = (new Queue)->getQueueCount();
        $activeSchedule = (new Schedule)->getActiveSchedule();

        return view('backend.admission.queue-form', compact('queueCount', 'activeSchedule'));
    }

    public function newPatient()
    {
        $provinceData = Options::getProvince();
        return view('backend.admission.new-patient', compact('provinceData'));
    }

    public function getLatestQueue()
    {
        $latest = (new Queue)->getLatestQueue(config('global.reference.queue_status_antrian'));

        (new Queue)->updateQueueStatus($latest->queue_id);

        return response()->json([
            'message' => 'Success get queue',
            'data' => [
                'latest' => $latest,
                'queueCount' => (new Queue)->getQueueCount(config('global.reference.queue_status_antrian'))
            ]
        ]);
    }

    public function skipQueue(Request $request)
    {
        ModelsQueue::where('queue_id', '=', $request->get('queue_id'))->update([
            'queue_status' => config('global.reference.queue_status_dilewati')
        ]);
        return response()->json([
            'message' => 'Success skip queue',
        ]);
    }

    public function saveAdmission(Request $request)
    {
        $payload = $request->post();

        // get patient information
        $patientInformation = (new Patient)->getPatientById($payload['patient_id']);

        $patientAgeInDays = getCustomDiff($patientInformation->patient_dob);
        $getGroupAge = Groupage::where('age_end', '>=', $patientAgeInDays)->orderBy('age_end', 'asc')->get('groupage_id')->first();

        // get patient group age, report needs
        $payload['groupage_id'] = $getGroupAge->groupage_id;

        // calculate patient age
        $payload['patient_age'] = findAge($patientInformation->patient_dob);

        (new Admission)->createAdmission($payload);
        if ( isset($payload['queue_id']) ) {
            ModelsQueue::where('queue_id', '=', $payload['queue_id'])->update([
                'queue_status' => config('global.reference.queue_status_dipanggil')
            ]);
        }
        return redirect(route('admin.admission.queueForm'));
    }

    public function getSkippedQueue(Request $request)
    {
        $activeSchedule = (new Schedule)->getActiveSchedule();

        $queueData = ModelsQueue::where('schedule_id', '=', $activeSchedule->schedule_id)->where('queue_status', '=', 20);
        // $queueData->whereBetween('admission_t.created_at', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:00')]);
        $result = [];
        foreach( $queueData->get()->toArray() as $key => $queueItem ) {
            $result[] = $queueItem;
        }
        return response()->json([
            'message' => 'Success get queue data',
            'draw' => $request->get('draw'),
            'recordsTotal' => count($result),
            'recordsFiltered' => count($result),
            'data' => $result
        ]);
    }
}