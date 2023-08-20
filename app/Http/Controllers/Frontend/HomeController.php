<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Queue;
use App\Models\Schedule as ModelsSchedule;
use App\Repositories\Patient;
use App\Repositories\Queue as QueueRepositories;
use App\Repositories\Schedule;
use Illuminate\Http\Request;
use App\Repositories\Options;
use App\Models\Faskes;

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
        $faskesList = Faskes::all()->toArray();

        return view('frontend.pages.get-queue', compact('scheduleOptions', 'patientInformation', 'dateDisabled','dayOff', 'dateStart', 'faskesList'));
    }

    public function storeQueue(Request $request)
    {
        $queuePayload = $request->all();

        $getSchedule = ModelsSchedule::find($queuePayload['schedule_id']);
        $queuePayload['time_attendance'] = QueueRepositories::calculateAttendanceTime($queuePayload['admission_date'].' '.$getSchedule->schedule_time_start, $queuePayload['admission_date'].' '.$getSchedule->schedule_time_end, $queuePayload['symptoms'], $queuePayload['faskes_id']);

        Queue::create([
            'schedule_id' => $queuePayload['schedule_id'],
            'patient_id' => $queuePayload['patient_id'],
            'dic_id' => $queuePayload['dic_id'],
            'symptoms' => $queuePayload['symptoms'],
            'time_attendance' => $queuePayload['time_attendance'],
            'symptom_notes' => $queuePayload['symptom_notes'],
            'faskes_id' => $queuePayload['faskes_id'],
        ]);

        return redirect(route('frontend.user.dashboard'));
    }

    public function getScheduleTime($schedule, $reservationDate, $faskesId)
    {
        $scheduleQuery = ModelsSchedule::where('schedule_day', $schedule);
        if ( date('Y-m-d', strtotime($reservationDate)) == date('Y-m-d') ) {
            $scheduleQuery->where('schedule_time_end', '>', date('H:i:00', strtotime('+60 minutes'))); // ditambah sejam biar masuk ke rules maksimal pengambilan adalah 1 jam sebelum jam klinik tutup
        }

        $scheduleQuery->where('faskes_id', '=', $faskesId);
        return response()->json([
            'message' => "Success get schedule time",
            'data' => $scheduleQuery->orderBy('schedule_time_start', 'ASC')->get()->toArray()
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
