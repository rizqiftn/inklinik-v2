<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TermsController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])
    ->name('index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });
Route::get('/get-schedule-time/{schedule}', [HomeController::class, 'getScheduleTime'])->name('getScheduleTime');
Route::get('/get-symptoms', [HomeController::class, 'getSymptoms'])->name('getSymptoms');

Route::get('/get-queue', [HomeController::class, 'getQueue'])
    ->middleware('is_user')
    ->name('getQueue');

Route::post('/get-queue', [HomeController::class, 'storeQueue'])
    ->middleware('is_user')
    ->name('storeQueue');

Route::get('terms', [TermsController::class, 'index'])
    ->name('pages.terms')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
    });
