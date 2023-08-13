<?php

use Carbon\Carbon;

if (! function_exists('appName')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function appName()
    {
        return config('app.name', 'Laravel Boilerplate');
    }
}

if (! function_exists('carbon')) {
    /**
     * Create a new Carbon instance from a time.
     *
     * @param $time
     * @return Carbon
     *
     * @throws Exception
     */
    function carbon($time)
    {
        return new Carbon($time);
    }
}

if (! function_exists('homeRoute')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function homeRoute()
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                return 'admin.dashboard';
            }

            if (auth()->user()->isUser()) {
                return 'frontend.user.dashboard';
            }
        }

        return 'frontend.index';
    }
}

if ( ! function_exists('findAge') ) {
    function findAge($born)
    {
        $y = date('Y', strtotime($born));
        $m = date('m', strtotime($born));
        $d = date('d', strtotime($born));
        $bornDate = Carbon::create($y, $m, $d);
        $age = $bornDate->diff(Carbon::now())->format('%y Tahun, %m Bulan and %d Hari');
        return $age;
    }
}

if ( ! function_exists('getCustomDiff') ) {
    function getCustomDiff($startDate, $endDate = null)
    {
        $dateStart = Carbon::parse($startDate);
        $dateEnd = $endDate ? Carbon::parse($endDate) : Carbon::now();

        return $dateStart->diffInDays($dateEnd);
    }
}


