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
                        <div id="accordion">
                            @if(count($getExaminationHistory))
                                @foreach( $getExaminationHistory as $key => $historyItem )
                                <div class="card">
                                    <div class="card-header">
                                        <a class="card-link" data-toggle="collapse" href="#collapse{{$historyItem->admission_number}}">
                                            <b>{{ $historyItem->admission_number }}</b> - {{ $historyItem->admission_date }} - {{ $historyItem->doctor_name}}
                                        </a>
                                    </div>
                                    <div id="collapse{{$historyItem->admission_number}}" class="collapse {{ $key == 0 ? 'show' : ''}}" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item"><b>Height:</b> <br> {{ $historyItem->height }} cm</li>
                                                        <li class="list-group-item"><b>Blood Pulse:</b> <br> {{ $historyItem->blood_pulse }} /minute </li>
                                                    </ul>
                                                </div>
                                                <div class="col">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item"><b>Weight:</b> <br> {{ $historyItem->weight }} kg </li>
                                                        <li class="list-group-item"><b>Respiratory Rate:</b> <br> {{ $historyItem->respiratory_rate }} /minute</li>
                                                    </ul>
                                                </div>
                                                <div class="col">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item"><b>Body Temp:</b> <br> {{ $historyItem->body_temp }}C</li>
                                                        <li class="list-group-item"><b>Blood Pressure:</b> <br> {{ $historyItem->blood_pressure }} mmHg </li>
                                                    </ul>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <br>
                                                        <b>Keluhan</b> 
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <p>{{ $historyItem->symptoms }}</p>
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
                                                                <p>{{ $historyItem->symptom_notes }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <br>
                                                        <b>Diagnosa Utama</b> 
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <p>{{ $historyItem->diagnosa_utama }}</p>
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
                                                                <p>{{ $historyItem->medical_recommendation }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <br>
                                                        <button class="btn btn-primary btn-sm text-right">Unduh Invoice</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                @endforeach
                            @endif
                        </div>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
