<?php

namespace App\Repositories;

use App\Models\Schedule as RsSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Schedule {
    public static function getSchedule()
    {
        $scheduleData = DB::table('schedule_m')
            ->select(
                    'schedule_m.schedule_id',
                    'schedule_m.doctor_id',
                    'schedule_m.quota',
                    'schedule_m.schedule_day',
                    'reference_m.reference_value as day',
                    'staff_m.staff_name as doctor_name',
                    'schedule_m.schedule_time_start',
                    'schedule_m.schedule_time_end',
                )
            ->join('reference_m', 'schedule_m.schedule_day', '=', 'reference_m.reference_id')
            ->join('doctor_m', 'schedule_m.doctor_id', '=', 'doctor_m.doctor_id')
            ->join('staff_m', 'doctor_m.staff_id', '=', 'staff_m.staff_id')
            ->where('schedule_m.is_active', '=', true)
            ->orderBy('schedule_m.schedule_day', 'asc')
            ->orderBy('schedule_m.schedule_time_start', 'asc')
            ->get();
        $result = [];

        if ( !empty($scheduleData) ) {
            foreach ( $scheduleData as $key => $scheduleItem) {
                if ( !isset($result[$scheduleItem->day]) ) {
                    $result[$scheduleItem->day] = [
                        'doctor_id' => $scheduleItem->doctor_id,
                        'doctor_name' => $scheduleItem->doctor_name,
                        'quota' => $scheduleItem->quota,
                        'schedule_day' => $scheduleItem->schedule_day,
                        'day' => $scheduleItem->day,
                        'schedule_time' => []
                    ];
                }

                $result[$scheduleItem->day]['schedule_time'][$scheduleItem->schedule_id] = [
                    'start' => $scheduleItem->schedule_time_start,
                    'end' => $scheduleItem->schedule_time_end,
                ];

            }
        }

        return (object) $result;
    }

    public static function getScheduleDay()
    {
        return DB::table('schedule_m')
                ->select(
                    'schedule_m.schedule_id',
                    'schedule_m.schedule_day',
                    'reference_m.reference_value as day'
                )
                ->join('reference_m', 'schedule_m.schedule_day', '=', 'reference_m.reference_id')
                ->where('schedule_m.is_active', '=', true)
                ->groupBy('schedule_m.schedule_day')
                ->get();
    }

    public static function getScheduleTime($scheduleDay)
    {
        if ( empty($scheduleDay) ) {
            return (object) [];
        }
        return DB::table('schedule_m')
                ->select(
                    'schedule_m.schedule_id',
                    'schedule_m.schedule_time_start as start',
                    'schedule_m.schedule_time_end as end',
                )
                ->where('schedule_day', '=', $scheduleDay)
                ->where('is_active', '=', true)
                ->get();
    }

    public function getActiveSchedule()
    {
        return DB::table('schedule_m')
                ->select(
                    'schedule_m.schedule_id',
                    'schedule_m.schedule_time_start as start',
                    'schedule_m.schedule_time_end as end',
                )
                ->where('is_active', '=', true)
                ->where('schedule_day', '=', Carbon::parse(date('Y-m-d'))->dayOfWeek + 1)
                ->where('schedule_time_start', '<', date('H:i:00', strtotime('now')))
                ->where('schedule_time_end', '>', date('H:i:00', strtotime('now')))
                ->orderBy('schedule_time_end', 'desc')
                ->get()->first();
    }

    public function getDateDisabled()
    {
        return DB::table('dayoff_m')->select('dayoff_date', 'reason')->pluck('dayoff_date')->toArray();
    }

    public function getDayOff()
    {
        $defaultDayOff = [0];
        $getExistedDate = DB::table('schedule_m')->distinct("schedule_day")->where('is_active', '=', true)->pluck('schedule_day')->toArray();

        $getDayOff = DB::table('reference_m')->select('reference_id')->whereNotIn('reference_id', $getExistedDate)->where('reference_type', '=', 'day')->pluck('reference_id')->toArray();
        foreach($getDayOff as $value) {
            $dayOff[] = $value - 1;
        }
        return array_merge($defaultDayOff, $dayOff);
    }

    public function getStartDate()
    {
        // check if there is active schedule
        $getActiveSchedule = DB::table('schedule_m')
                                ->select('schedule_id', 'schedule_time_end')
                                ->where('schedule_day', '=', Carbon::parse(date('Y-m-d'))->dayOfWeek + 1)
                                ->where('schedule_time_end', '>', date('H:i:00', strtotime('+60 minutes')))
                                ->get()
                                ->toArray();

        if ( empty($getActiveSchedule) ) {
            return date('Y-m-d', strtotime('+1 days'));
        }

        // then check if the latest queue on today schedule is not excess schedule time end - 1 hour
        $checkLatestQueue = DB::table('queue_t')
                                ->select('time_attendance')
                                ->where('time_attendance', '>', Carbon::parse($getActiveSchedule[0]->schedule_time_end)->subMinutes(30)->format('Y-m-d H:i:00'))
                                ->first();
        if ( $checkLatestQueue ) {
            return date('Y-m-d', strtotime('+1 days'));
        }

        return date('Y-m-d');
    }

    public function getScheduleList()
    {
        $query = DB::table('schedule_m')->select(
                                            'schedule_m.schedule_id',
                                            'schedule_m.schedule_time_start',
                                            'schedule_m.schedule_time_end',
                                            'staff_m.staff_name as doctor_name',
                                            'reference_m.reference_value as day'
                                        )
                                        ->join('reference_m', 'reference_m.reference_id', '=', 'schedule_m.schedule_day')
                                        ->join('doctor_m', 'doctor_m.doctor_id', '=', 'schedule_m.doctor_id')
                                        ->join('staff_m', 'staff_m.staff_id', '=', 'doctor_m.staff_id')
                                        ->where('schedule_m.is_active', '=', true);
        return $query;
    }
}