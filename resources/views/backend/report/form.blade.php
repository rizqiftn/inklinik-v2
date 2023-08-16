@extends('backend.layouts.app')

@section('title', __('Payment List'))

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('vendor/css/datatables.min.css') }}">
@endpush

@push('after-scripts')
    <script src="{{ asset('vendor/js/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/js/app/report/generate_report.js') }}"></script>
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Generate Report
        </x-slot>

        <x-slot name="body">
            <x-forms.post :action="route('admin.report.reportView')" id="generate-report-form">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group required row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Jenis Laporan')</label>
    
                            <div class="col-md-8">
                                <select class="form-control" name="report_type" id="report_type">
                                    <option value="0" disabled selected>-- Pilih --</option>
                                    <option value="1">Laporan R.L 4b - Morbiditas Rawat Jalan</option>
                                    <option value="2">Laporan R.L 5.4 - Kunjungan Rawat Jalan</option>
                                </select>
                            </div>
                        </div><!--form-group-->
    
                        <div class="form-group required row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Periode')</label>
    
                            <div class="col-md-8 input-group">
                                <select class="form-control" name="report_periode" id="report_periode">
                                    <option value="0" disabled selected>-- Pilih --</option>
                                    <option value="2023">2023</option>
                                </select>
                            </div>
                        </div><!--form-group-->
                        <div class="row">
                            <div class="col-4 offset-md-8 text-right">
                                <button type="button" class="btn btn-success" id="btn-generate-report">Lihat Laporan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </x-forms.post>
            <br>
            <div class="row">
            <div class="col">
                <x-backend.card>
                    <x-slot name="header">
                        <div class="row">
                            <div class="col">
                                <b id="render-title">-</b>
                            </div>
                            <div class="col text-right">
                                <a target="_blank" class="btn btn-info" disabled id="btn-print-report">Cetak Laporan</a>
                            </div>
                        </div>
                    </x-slot>
                    <x-slot name="body">
                        <div class="row">
                            <div class="col-12" id="render-view">
                                
                            </div>
                        </div>
                    </x-slot>
                </x-backend.card>
            </div>
            </div>
        </x-slot>
    </x-backend.card>
@endsection
