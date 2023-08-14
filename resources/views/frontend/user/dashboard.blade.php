@extends('frontend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Antrian Aktif')
                    </x-slot>

                    <x-slot name="body">
                        <x-frontend.card>
                            <x-slot name="body">
                                @if($getActiveQueue)
                                    <div class="row text-center">
                                        <div class="col">
                                            <h3>{{ $getActiveQueue->queue_number ?? '-' }}</h3>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col">
                                            Total Antrian Sebelum Anda <br> <b>{{ $getCountQueue }}</b>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row text-center">
                                        <div class="col">
                                            Kami merekomendasikan anda untuk datang pada <br> <b>{{ date('d/m/Y H:i:00', strtotime($getActiveQueue->time_attendance)) ?? '-' }}</b>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col text-center">
                                            Anda tidak memiliki antrian aktif untuk saat ini.
                                        </div>
                                    </div>
                                @endif
                            </x-slot>
                        </x-frontend.card>
                    </x-slot>
                </x-frontend.card>
            </div>
            <div class="col-md-8">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Riwayat Pemeriksaan')
                    </x-slot>

                    <x-slot name="body">
                        <x-frontend.card>
                            <x-slot name="header">
                                <div class="row">
                                    <div class="col">
                                        <b>KLN2300123123</b> - 22/10/2023 - dr. Eka Nugraha
                                    </div>
                                    <div class="col text-right">
                                        <button class="btn btn-primary btn-sm text-right">Unduh Invoice</button>
                                    </div>
                                </div>
                            </x-slot>
                            <x-slot name="body">
                                <div class="row">
                                    <div class="col">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><b>Height:</b> <br> 170 cm</li>
                                            <li class="list-group-item"><b>Blood Pulse:</b> <br> 70 /minute </li>
                                        </ul>
                                    </div>
                                    <div class="col">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><b>Weight:</b> <br> 70 kg </li>
                                            <li class="list-group-item"><b>Respiratory Rate:</b> <br> 80 /minute</li>
                                        </ul>
                                    </div>
                                    <div class="col">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><b>Body Temp:</b> <br> 36C</li>
                                            <li class="list-group-item"><b>Blood Pressure:</b> <br> 120/100 mmHg </li>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <br>
                                            <b>Keluhan</b> 
                                            <div class="card">
                                                <div class="card-body">
                                                    Sakit Kepala
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <br>
                                            <b>Catatan Keluhan</b> 
                                            <div class="card">
                                                <div class="card-body">
                                                    Sudah 3 hari sakit
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <br>
                                            <b>Rekomendasi Medis</b> 
                                            <div class="card">
                                                <div class="card-body">
                                                    Sudah 3 hari sakit
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </x-slot>
                        </x-frontend.card>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
