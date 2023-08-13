@extends('backend.layouts.app')

@section('title', __('Payment List'))

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endpush

@push('after-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/app/payment/list.js') }}"></script>
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Worklist Payment
        </x-slot>

        <x-slot name="body">
             <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" id="payment-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Action</th>
                                <th>Adm. Number</th>
                                <th>Patient Information</th>
                                <th>Status</th>
                                <th>Doctor in Charge</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="text-center"> Data Belum Tersedia</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
             </div>
        </x-slot>
    </x-backend.card>
@endsection
