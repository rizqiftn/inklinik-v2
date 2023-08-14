<?php

use App\Http\Controllers\Backend\ScheduleController;
use Tabuna\Breadcrumbs\Trail;

Route::get('schedule/master', [ScheduleController::class, 'list'])
    ->name('schedule.master')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Master Jadwal Praktik'), route('admin.schedule.master'));
    });

Route::get('schedule/dayoff', [ScheduleController::class, 'dayoffList'])
    ->name('schedule.dayoff')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Master Dayoff'), route('admin.schedule.dayoff'));
    });

Route::get('schedule/add-new-dayoff', [ScheduleController::class, 'addNewDayoff'])
    ->name('schedule.dayoffForm')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Master Dayoff'), route('admin.schedule.dayoff'));
        $trail->push(__('Tambah Data Dayoff'), route('admin.schedule.dayoffForm'));
    });

Route::get('schedule/edit-dayoff/{dayoffId}', [ScheduleController::class, 'editDayoff'])
    ->name('schedule.editDayoffForm')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Master Dayoff'), route('admin.schedule.dayoff'));
        $trail->push(__('Edit Data Dayoff'), route('admin.schedule.editDayoffForm', ['dayoffId']));
    });

Route::post('schedule/save-new-dayoff', [ScheduleController::class, 'storeDayoff'])->name('schedule.storeDayoff');
Route::post('schedule/edit-dayoff', [ScheduleController::class, 'updateDayoff'])->name('schedule.updateDayoff');

Route::get('schedule/get-dayoff-list', [ScheduleController::class, 'getDataDayoff']);
Route::get('schedule/get-schedule-list', [ScheduleController::class, 'getScheduleData']);

Route::get('schedule/delete-dayoff/{dayoffId}', [ScheduleController::class, 'removeDayoff']);