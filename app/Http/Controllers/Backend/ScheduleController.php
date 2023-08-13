<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Dayoff;
use App\Repositories\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    //
    public function list()
    {
        return view('backend.schedule.list');
    }

    public function getScheduleData(Request $request)
    {
        $result = [];
        $queryData = (new Schedule)->getScheduleList();
        $queryData->orderBy('schedule_m.schedule_day', 'asc');
        foreach( $queryData->get()->toArray() as $key => $scheduleItem ) {
            $result[] = $scheduleItem;
        }
        return response()->json([
            'message' => 'Success get dayoff data',
            'draw' => $request->get('draw'),
            'recordsTotal' => count($result),
            'recordsFiltered' => count($result),
            'data' => $result
        ]);
    }

    public function dayoffList()
    {
        return view('backend.schedule.dayoff');
    }

    public function addNewDayoff()
    {
        $getAllDayoff = Dayoff::orderBy('dayoff_date', 'asc')->get()->all();
        $dayOff = [];

        foreach( $getAllDayoff as $key => $item ) {
            $dayOff[] = $item->dayoff_date;
        }
        return view('backend.schedule.dayoffForm', compact('dayOff'));
    }

    public function editDayoff($dayoffId)
    {
        $getCurrentDayoff = Dayoff::where('dayoff_id', $dayoffId)->first();
        $getAllDayoff = Dayoff::where('dayoff_id', '!=', $dayoffId)->orderBy('dayoff_date', 'asc')->get()->all();
        $dayOff = [];

        foreach( $getAllDayoff as $key => $item ) {
            $dayOff[] = $item->dayoff_date;
        }
        return view('backend.schedule.editDayoffForm', compact('dayOff', 'getCurrentDayoff'));
    }

    public function storeDayoff(Request $request)
    {
        $dayoffPayload = $request->post();
        $validatedRequest = $request->validate([
            'dayoff_date' => 'required',
        ]);

        Dayoff::create($dayoffPayload);
        return redirect(route('admin.schedule.dayoff'));
    }

    public function updateDayoff(Request $request)
    {
        $dayoffPayload = $request->post();
        $validatedRequest = $request->validate([
            'dayoff_date' => 'required',
        ]);

        Dayoff::where('dayoff_id', $request->post('dayoff_id'))->update([
            'dayoff_date' => $request->post('dayoff_date'),
            'reason' => $request->post('reason')
        ]);
        return redirect(route('admin.schedule.dayoff'));

    }

    public function getDataDayoff(Request $request)
    {
        $result = [];
        $limit = $request->get('length', 10);
        $start = $request->get('start', 0);
        $getDayoffData = new Dayoff();
        $getDayoffData->offset($start)->limit($limit);
        
        foreach( $getDayoffData->all()->toArray() as $key => $dayoffItem ) {
            $result[] = $dayoffItem;
        }

        return response()->json([
            'message' => 'Success get dayoff data',
            'draw' => $request->get('draw'),
            'recordsTotal' => count($result),
            'recordsFiltered' => count($result),
            'data' => $result,
        ]);
    }
}
