<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ExaminationController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Dashboard'), route('admin.dashboard'));
    });
Route::get('worklist', [ExaminationController::class, 'list'])
    ->name('worklist')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Worklist'), route('admin.worklist'));
    });