<?php

namespace App\Http\Controllers\Frontend\User;

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
        return view('frontend.user.dashboard', compact('getActiveQueue'));
    }
}
