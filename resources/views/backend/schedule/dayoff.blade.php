@extends('backend.layouts.app')

@section('title', __('Master Dayoff'))

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endpush

@push('after-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/app/schedule/list_dayoff.js') }}"></script>
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Master Dayoff
        </x-slot>

        <x-slot name="body">
            <div class="row">
                <div class="col">
                    <a href="{{ route('admin.schedule.dayoffForm') }}" class="btn btn-success">Tambah Data Baru</a>
                </div>
            </div>
            <br>
             <div class="row">
                <div class="col-md-12">
                    <table id="dayoff-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Alasan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="text-center"> Data Belum Tersedia</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
             </div>
        </x-slot>
    </x-backend.card>
@endsection
