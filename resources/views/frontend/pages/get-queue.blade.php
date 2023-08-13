<?php

use Illuminate\Support\Js;

?>
@extends('frontend.layouts.app')

@push('after-styles')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bs.min.css') }}" rel="stylesheet">
     <!-- datepicker styles -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
@endpush

@push('after-scripts')
    <script src="{{ asset('js/select2.full.min.js') }}"> </script>
    <script src="{{ asset('js/app/queue_form.js') }}"> </script>
    <!-- Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"> </script>
    <script>
        var dateDisabled = {{ Js::from($dateDisabled) }};
        var dayOff = {{ Js::from($dayOff) }};
    </script>
@endpush

@section('title', __('Ambil Antrian'))

@section('content')
<input type="hidden" name="datestart" id="date-start" value="{{ $dateStart }}">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Form Pengambilan Antrian')
                    </x-slot>

                    <x-slot name="body">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <b>Informasi Pasien</b>
                                </h6>
                                <hr>
                                <div class="row">
                                    <div class="col-sm">
                                        <h6>
                                            <b>Nama Pasien</b>
                                        </h6>
                                        <p>
                                            {{ $patientInformation->patient_name }} ({{ $patientInformation->patient_sex }})<br>
                                        </p>
                                    </div>
                                    <div class="col-sm">
                                        <h6>
                                            <b> No. Handphone / WA </b>
                                        </h6>
                                        <p>{{ $patientInformation->phone_number }}</p>
                                    </div>
                                    <div class="col-sm">
                                        <h6>
                                            <b>Alamat Pasien</b>
                                        </h6>
                                        <p>{{ $patientInformation->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div> <br> <!-- End Patient Information -->
                        <x-forms.post :action="route('frontend.storeQueue')">
                            <input type="hidden" name="patient_id" value="{{ $patientInformation->patient_id }}">
                            <div class="form-group required row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Tanggal Kunjungan')</label>

                                <div class="col-md-6">
                                    <input type="text" min="{{ date('Y-m-d') }}" name="admission_date" id="admission_date" class="form-control" value="{{ old('admission_date') }}" placeholder="{{ __('Tanggal Kunjungan') }}" required autofocus autocomplete="off"/>
                                </div>
                            </div><!--form-group-->

                            <div class="form-group required row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Jam Buka Klinik')</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="schedule_id" id="schedule_id">
                                        <option value="0" disabled selected>-- Pilih --</option>
                                    </select>
                                </div>
                            </div><!--form-group-->

                            <div class="form-group required row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Keluhan')</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="symptoms" id="symptoms">

                                    </select>
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Catatan')</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" name="symptom_notes" id="" cols="50" rows="5" placeholder="Catatan, contoh: Sudah berlangsung 3 hari, sudah minum obat">{{ old('symptom_notes') }}</textarea>
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button class="btn btn-primary" type="submit">@lang('Submit Antrian')</button>
                                </div>
                            </div><!--form-group-->
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
