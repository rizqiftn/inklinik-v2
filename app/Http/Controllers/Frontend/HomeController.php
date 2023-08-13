<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Queue;
use App\Models\Schedule as ModelsSchedule;
use App\Repositories\Patient;
use App\Repositories\Queue as QueueRepositories;
use App\Repositories\Schedule;
use Illuminate\Http\Request;
use App\Repositories\Admission;
use App\Repositories\Options;

/**
 * Class HomeController.
 */
class HomeController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $scheduleData = Schedule::getSchedule();

        return view('frontend.index', compact('scheduleData'));
    }

    public function getQueue()
    {
        $scheduleOptions = Schedule::getScheduleDay();
        $patientInformation = (new Patient)->getPatient(auth()->user()->id);
        $dateDisabled = (new Schedule)->getDateDisabled();
        $dayOff = (new Schedule)->getDayOff();
        $dateStart = (new Schedule)->getStartDate();

        return view('frontend.pages.get-queue', compact('scheduleOptions', 'patientInformation', 'dateDisabled','dayOff', 'dateStart'));
    }

    public function storeQueue(Request $request)
    {
        $queuePayload = $request->all();

        $getSchedule = ModelsSchedule::find($queuePayload['schedule_id']);

        $queuePayload['dic_id'] = $getSchedule->doctor_id;
        $queuePayload['time_attendance'] = QueueRepositories::calculateAttendanceTime($queuePayload['admission_date'].' '.$getSchedule->schedule_time_start, $queuePayload['admission_date'].' '.$getSchedule->schedule_time_end, $queuePayload['symptoms']);

        Queue::create([
            'schedule_id' => $queuePayload['schedule_id'],
            'patient_id' => $queuePayload['patient_id'],
            'dic_id' => $queuePayload['dic_id'],
            'symptoms' => $queuePayload['symptoms'],
            'time_attendance' => $queuePayload['time_attendance'],
            'symptom_notes' => $queuePayload['symptom_notes']
        ]);

        return redirect(route('frontend.user.dashboard'));
    }

    public function getScheduleTime($schedule)
    {
        return response()->json([
            'message' => "Success get schedule time",
            'data' => ModelsSchedule::where('schedule_day', $schedule)->orderBy('schedule_time_start', 'ASC')->get()->toArray()
        ]);
    }

    public function getSymptoms(Request $request)
    {
        return response()->json([
            'message' => "Success get symptoms list",
            'data' => (new Options)->getSymptomList($request->get('search', null))
        ]);
    }
}
