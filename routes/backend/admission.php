<?php

use App\Http\Controllers\Backend\AdmissionController;
use App\Repositories\Admission;
use Tabuna\Breadcrumbs\Trail;

Route::get('admission/new-admission', [AdmissionController::class, 'add'])
    ->name('admission.admissionForm')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Admission'), route('admin.admission.queueForm'));
        $trail->push(__('Admission - Create Admission'), route('admin.admission.admissionForm'));
    });

Route::get('admission/queue-form', [AdmissionController::class, 'queueForm'])
    ->name('admission.queueForm')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Admission'), route('admin.admission.queueForm'));
    });

Route::get('admission/new-patient', [AdmissionController::class, 'newPatient'])
    ->name('admission.newPatient')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Admission'), route('admin.admission.queueForm'));
        $trail->push(__('Admission - Add New Patient'), route('admin.admission.newPatient'));
    });

Route::get('admission/get-latest-queue', [AdmissionController::class,'getLatestQueue']);
Route::get('admission/skip-queue', [AdmissionController::class,'skipQueue']);
Route::get('admission/get-skipped-queue-data', [AdmissionController::class,'getSkippedQueue']);

Route::post('admission/save-admission', [AdmissionController::class, 'saveAdmission'])->name('admission.saveAdmission');