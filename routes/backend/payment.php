<?php

use App\Http\Controllers\Backend\PaymentController;
use Tabuna\Breadcrumbs\Trail;

Route::get('payment', [PaymentController::class, 'list'])
    ->name('payment')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Payment'), route('admin.payment'));
    });

Route::get('payment/form/{billId}', [PaymentController::class, 'form'])
    ->name('paymentForm')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Payment'), route('admin.payment'));
        $trail->push(__('Payment Form'), route('admin.paymentForm', ['billId']));
    });


Route::post('payment/save-payment', [PaymentController::class, 'store'])->name('payment.savePayment');
Route::get('payment/get-payment-list', [PaymentController::class, 'getData']);