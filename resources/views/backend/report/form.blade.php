@extends('backend.layouts.app')

@section('title', __('Payment List'))

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endpush

@push('after-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Generate Report
        </x-slot>

        <x-slot name="body">
             <div class="row">
                <div class="col-6">
                    <div class="form-group required row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Jenis Laporan')</label>

                        <div class="col-md-8">
                            <select class="form-control" name="city_id" id="city_id">
                                <option value="0" disabled selected>-- Pilih --</option>
                                <option value="1">Laporan R.L 4b - Morbiditas Rawat Jalan</option>
                                <option value="2">Laporan R.L 5.4 - Kunjungan Rawat Jalan</option>
                            </select>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group required row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Periode')</label>

                        <div class="col-md-8 input-group">
                            <select class="form-control" name="city_id" id="city_id">
                                <option value="0" disabled selected>-- Pilih --</option>
                                <option value="2023">2023</option>
                            </select>
                        </div>
                    </div><!--form-group-->
                    <div class="row">
                        <div class="col-4 offset-md-8 text-right">
                            <button type="button" class="btn btn-success">Lihat Laporan</button>
                        </div>
                    </div>
                </div>
             </div>
             <br>
             <div class="row">
                <div class="col">
                    <x-backend.card>
                        <x-slot name="header">
                            Laporan Kunjungan Rawat Jalan
                        </x-slot>
                        <x-slot name="body">
                            <div class="row">
                                <div class="col-12">
                                    xx
                                </div>
                            </div>
                        </x-slot>
                    </x-backend.card>
                </div>
             </div>
        </x-slot>
    </x-backend.card>
@endsection
