@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

<div class="row">
    <div class="col">
        <x-backend.card>
            <x-slot name="body">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3>
                                    <i class="cil cil-people"></i>
                                </h3>
                                <h5 class="card-title">Total Pasien Menunggu Diperiksa</h5>
                                <p class="card-text">
                                    <h2> 20 Orang</h2>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3>
                                    <i class="cil cil-people"></i>
                                </h3>
                                <h5 class="card-title">Total Pasien Hari Ini</h5>
                                <p class="card-text">
                                    <h2> 20 Orang</h2>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3>
                                    <i class="cil cil-clock"></i>
                                </h3>
                                <h5 class="card-title">Rata-rata Keseluruhan Waktu Pelayanan</h5>
                                <p class="card-text">
                                    <h2> 15 Menit</h2>
                                </p>
                            </div>
                        </div>
                    </div>
        
                </div>
            </x-slot>
        </x-backend.card>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <x-backend.card>
            <x-slot name="header">
                Daftar Rata Rata Waktu Pelayanan Berdasarkan Keluhan
            </x-slot>
            <x-slot name="body">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered">
                                <thead>
                                    <th>Keluhan</th>
                                    <th>Rata-rata Waktu Pelayanan (menit)</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sakit Perut</td>
                                        <td>10 Menit</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </x-slot>
            </x-backend.card>
        </div>
    </div>
@endsection
