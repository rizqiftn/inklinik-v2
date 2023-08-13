@extends('backend.layouts.app')

@section('title', __('Master Jadwal Praktik'))

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endpush

@push('after-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/app/schedule/list.js') }}"></script>
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Master Jadwal Praktik
        </x-slot>

        <x-slot name="body">
             <div class="row">
                <div class="col-md-12">
                    <table id="schedule-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Dokter Praktik</th>
                                <th>Hari</th>
                                <th>Jam Praktik</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" class="text-center"> Data Belum Tersedia</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
             </div>
        </x-slot>
    </x-backend.card>
@endsection
