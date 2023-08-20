<?php

namespace App\Repositories;

use App\Models\Queue as ModelQueue;
use App\Repositories\Reference;
use App\Repositories\BaseRepositories;
use Carbon\Carbon;

class Queue extends BaseRepositories {

    public function __construct()
    {
        $this->table = 'queue_t';
    }

    public function getQueue($id)
    {
        return $this->dbHandler()->select('*')->where('queue_id', $id)->get()->first();
    }

    public function getQueueByUser($id)
    {
        return $this->dbHandler()
                    ->select('queue_t.*')
                    ->join('patient_m', 'patient_m.patient_id', '=', 'queue_t.patient_id')
                    ->join('users', 'users.id', '=', 'patient_m.user_id')
                    ->where('users.id', $id)
                    ->where('queue_t.queue_status', 12)->get()->first();
    }

    public function updateQueueStatus($id)
    {
        return $this->dbHandler()->where('queue_id', $id)->update([
            'queue_status' => config('global.reference.queue_status_dipanggil')
        ]);
    }

    public function getQueueList()
    {
        return [];
    }

    public function createQueue($data)
    {
        return $this->dbHandler()->insert([
                        'schedule_id' => $data['schedule_id'],
                        'patient_id' => $data['patient_id'],
                        'dic_id' => $data['dic_id'],
                        'symptoms' => $data['symptoms'],
                        'time_attendance' => $data['time_attendance'],
                        'created_at' => Carbon::now(),
                        'symptom_notes' => $data['symptom_notes']
                    ]);
    }

    public static function calculateAttendanceTime($date_start, $date_end, $symptoms = '',  $faskesId)
    {
        $getLatestQueue = (new ModelQueue())->select('time_attendance', 'symptoms')->whereBetween('time_attendance', [
            date('Y-m-d H:i:s', strtotime($date_start)), 
            date('Y-m-d H:i:s', strtotime($date_end))
        ])->where('faskes_id', '=', $faskesId)->orderBy('queue_id', 'desc')->get()->first();

        if ( empty($getLatestQueue) ) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $date_start)->toDateTimeString();
        }

        $avgWaitingTime = (new Examination)->getAvgExaminationTime($getLatestQueue->symptoms, $faskesId);

        $latestQueueDate = date('Y-m-d H:i:00', strtotime($getLatestQueue->time_attendance));
        if ( date('Y-m-d H:i:00') > $latestQueueDate) {
            $latestQueueDate = date('Y-m-d H:i:00');
        }

        return Carbon::createFromFormat('Y-m-d H:i:s', $latestQueueDate)->addSecond($avgWaitingTime)->toDateTimeString();
    }

    public function getQueueCount($status = '')
    {
        $getActiveSchedule = (new Schedule)->getActiveSchedule();
        $getQueueData = $this->dbHandler()->select('queue_id')->where('queue_status', '=', $status == '' ? config('global.reference.queue_status_antrian') : $status);

        if ( $getActiveSchedule ) {
            $getQueueData->where('schedule_id', '=', $getActiveSchedule->schedule_id);
            return $getQueueData->count();
        }

        return 0;
    }

    public function getLatestQueue($status = '')
    {
        $getActiveSchedule = (new Schedule)->getActiveSchedule();
        $getQueueData = $this->dbHandler()->select('queue_number', 'queue_id')->where('queue_status', '=', $status == '' ? config('global.reference.queue_status_antrian') : $status);

        $getQueueData->where('schedule_id', '=', $getActiveSchedule->schedule_id);

        return $getQueueData->get()->last();
    }

}