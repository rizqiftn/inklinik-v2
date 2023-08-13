<?php

use App\Http\Controllers\Backend\ExaminationController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::get('examination/list', [ExaminationController::class, 'list'])
    ->name('examination.list')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Worklist'), route('examination.list'));
    });

Route::get('examination/form/{admissionId}', [ExaminationController::class, 'form'])
    ->name('examination.list.form')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.examination.list'));
        $trail->push(__('Formulir Pemeriksaan'), route('admin.examination.list.form', ['admission_id']));
    });

Route::get('examination/get-examination-list', [ExaminationController::class, 'getData']);
Route::get('examination/get-primary-diagnose', [ExaminationController::class, 'getPrimaryDiagnose']);
Route::get('examination/get-instruction', [ExaminationController::class, 'getInstruction']);
Route::get('examination/get-medicine', [ExaminationController::class, 'getMedicine']);

Route::post('examination/store', [ExaminationController::class, 'storeExamination']);