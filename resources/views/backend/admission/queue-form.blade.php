@extends('backend.layouts.app')

@section('title', __('Admission Form'))

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('vendor/css/datatables.min.css') }}">
@endpush

@push('after-scripts')
    <script src="{{ asset('vendor/js/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/js/app/admission/queue_form.js') }}"> </script>
    <script>
        var skipQueueTbl;
    </script>
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Patient Admission Form
        </x-slot>

        <x-slot name="headerActions">
            <!-- <a href="{{ route('admin.admission.newPatient') }}" class="hidden btn btn-primary btn-patient-admission">Perekaman Data Pasien Baru <i class="cil cil-plus"></i></a>
            <a href="{{ route('admin.admission.admissionForm') }}" type="button" class="hidden btn btn-info btn-patient-admission">Pencatatan Kunjungan Manual <i class="cil cil-user"></i></a> -->
        </x-slot>

        <x-slot name="body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col text-center">
                                            <h6>Antrian Berjalan</h6>
                                            <h1>
                                                <b id="display-antrian">-</b> 
                                            </h1>
                                            <hr>
                                            @if ($activeSchedule)
                                                <p>Sisa Antrian <br> ({{ $activeSchedule->start}} - {{ $activeSchedule->end}})</p>
                                                <h3 id="display-sisa-antrian">{{ $queueCount }}</h3>
                                            @else
                                                <p>Sedang tidak ada jadwal yang aktif pada saat ini</p>
                                            @endif

                                        </div>
                                        <div class="col">
                                            <button id="btn-next-queue" {{ $queueCount == 0 ? 'disabled' : ''}} style="margin-bottom: 10px; width: 200px" type="button" class="btn btn-success">Antrian Selanjutnya <i class="cil cil-chevron-right"></i></button> <br>
                                            <button id="btn-patient-admission" disabled style="margin-bottom: 10px; width: 200px" type="button" class="btn btn-info">Pencatatan Kunjungan <i class="cil cil-user"></i></button> <br>
                                            <button id="btn-skip-queue" disabled style="margin-bottom: 10px; width: 200px" type="button" class="btn btn-danger">Lewati Antrian <i class="cil cil-chevron-double-right"></i></button><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <h5>
                                <b>Daftar Antrian Dilewati</b>
                            </h5>
                            <table class="table table-bordered" id="skip-queue-table">
                                <thead>
                                    <th>Queue Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h3>A001</h3>
                                        </td>
                                        <td>Dilewati</td>
                                        <td>
                                            <button style="margin-bottom: 10px; width: 200px" type="button" class="btn btn-info btn-patient-admission">Pencatatan Kunjungan <i class="cil cil-user"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <br> <!-- End Patient Information -->
        </x-slot>
    </x-backend.card>
@endsection
