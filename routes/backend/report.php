<?php

use App\Http\Controllers\Backend\ReportController;
use Tabuna\Breadcrumbs\Trail;

Route::get('report', [ReportController::class, 'generateReport'])
    ->name('report')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Generate Report'), route('admin.report'));
    });

Route::get('report/print/{reportType}/{reportPeriode}', [ReportController::class, 'printReport']);
Route::post('report/report-view', [ReportController::class, 'reportView'])->name('report.reportView');
    