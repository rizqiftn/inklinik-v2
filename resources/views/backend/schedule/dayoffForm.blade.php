<?php

use Illuminate\Support\Js;

?>
@extends('backend.layouts.app')

@section('title', __('Master Dayoff'))

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
@endpush

@push('after-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"> </script>
    <script src="{{ asset('js/app/schedule/dayoff_form.js') }}"></script>
    <script>
        var dateDisabled = {{ Js::from($dayOff) }};
    </script>
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Tambah Data Dayoff
        </x-slot>

        <x-slot name="body">
            <div class="row">
                <div class="col">
                    <a href="{{ route('admin.schedule.dayoff') }}" class="btn btn-success">Kembali</a>
                </div>
            </div>
            <br>
             <div class="row">
                <input type="hidden" id="date-start" value="{{ date('Y-m-d', strtotime('+2 days')) }}">
                <x-forms.post :action="route('admin.schedule.storeDayoff')">
                    <div class="form-group required row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Tanggal Kunjungan')</label>

                        <div class="col-md-6">
                            <input type="text" min="{{ date('Y-m-d') }}" name="dayoff_date" id="dayoff_date" class="form-control" value="{{ old('dayoff_date') }}" placeholder="{{ __('Tanggal Dayoff') }}" required autofocus autocomplete="off"/>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group required row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Alasan (Tutup / Cuti / Libur)')</label>

                        <div class="col-md-6">
                            <textarea class="form-control" name="reason" id="reason" cols="30" rows="10">{{ old('reason') }}</textarea>
                        </div>
                    </div><!--form-group-->
                    <div class="row">
                        <div class="col-4 offset-md-6 text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </x-forms.post>
             </div>
        </x-slot>
    </x-backend.card>
@endsection
