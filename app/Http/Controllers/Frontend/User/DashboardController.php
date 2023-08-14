<?php

namespace App\Http\Controllers\Frontend\User;

use App\Models\Queue as ModelsQueue;
use App\Repositories\Queue;
use Illuminate\Support\Facades\DB;

/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $getActiveQueue = (new Queue)->getQueueByUser(auth()->user()->id);
        $getCountQueue = 0;
        if ( $getActiveQueue ) {
            $getCountQueue = ModelsQueue::where('schedule_id', '=', $getActiveQueue->schedule_id)
                            ->where('queue_id', '<', $getActiveQueue->queue_id)
                            ->where(DB::raw('date(time_attendance)'), '=', '2023-08-14')
                            ->where('queue_status', '=', config('global.reference.queue_status_antrian'))
                            ->count();
        }
        return view('frontend.user.dashboard', compact('getActiveQueue', 'getCountQueue'));
    }
}
