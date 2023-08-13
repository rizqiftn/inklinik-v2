@extends('backend.layouts.app')

@section('title', __('Examination'))

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endpush

@push('after-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/app/examination/list.js') }}"></script>
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Worklist Patient
        </x-slot>

        <x-slot name="body">
             <div class="row">
                <div class="col-md-12">
                    <table id="examination-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Action</th>
                                <th>Status</th>
                                <th>Queue Number</th>
                                <th>Adm. Number</th>
                                <th>Patient Information</th>
                                <th>Doctor in Charge</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7" class="text-center"> Data Belum Tersedia</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
             </div>
        </x-slot>
    </x-backend.card>
@endsection
