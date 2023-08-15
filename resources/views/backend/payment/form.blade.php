@extends('backend.layouts.app')

@section('title', __('Payment Form'))

@push('after-scripts')
    <script src="{{ asset('vendor/js/app/payment/form.js') }}"></script>
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Formulir Pembayaran
        </x-slot>

        <x-slot name="body">
            <x-forms.post :action="route('admin.payment.savePayment')" id="payment-form">
                <input type="hidden" name="bill_id" value="{{ $billId }}">
                <input type="hidden" name="admission_id">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Harga Satuan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalAmount = 0;
                                @endphp
                                @if (count($getBillData) < 1)
                                    <tr>
                                        <td colspan=6 class="text-center">Belum Ada Tindakan / Obat yang diinputkan!</td>
                                    </tr>
                                @else

                                    @php
                                        $no = 0;
                                    @endphp
                                    @foreach ( $getBillData as $key => $billGroup)
                                        <tr>
                                            <td colspan="6">
                                            <b> {{ $key }} </b>
                                            </td>
                                        </tr>
                                        @foreach ($billGroup as $billKey => $billItem)
                                            @php
                                                $totalAmount += $billItem->item_total_price
                                            @endphp
                                            <tr>
                                                <td>{{ ++$no }}</td>
                                                <td>{{ $billItem->jenis }}</td>
                                                <td>{{ $billItem->item_name }}</td>
                                                <td>{{ $billItem->item_qty_unit }}</td>
                                                <td>Rp. {{ number_format($billItem->item_base_price, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($billItem->item_total_price, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-4">
                        <table class="table table-bordered">
                            <tr>
                                <th width=50>Total</th>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-text" id="height-label">Rp.</span>
                                        <input class="form-control" type="text" name="total_amount" value="{{ number_format($totalAmount, 0, ',', '.') }}" id="total-amount" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Jumlah Bayar</th>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-text" id="height-label">Rp.</span>
                                        <input class="form-control" type="text" name="total_payment" id="total-payment" value=0 autofocus>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Kembalian</th>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-text" id="height-label">Rp.</span>
                                        <input class="form-control" type="text" name="changes" id="changes" value=0 readonly>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-4 text-right">
                        <button type="button" id="submit-payment" style="width: 150px" class="btn btn-success">Bayar</button>
                    </div>
                </div>
            </x-forms.post>
        </x-slot>
    </x-backend.card>
@endsection
