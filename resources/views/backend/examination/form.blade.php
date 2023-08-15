@extends('backend.layouts.app')

@section('title', __('Examination Form'))

@push('after-styles')
    <link href="{{ asset('vendor/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/css/select2-bs.min.css') }}" rel="stylesheet">
    <style>
        .select2-default { 
            color: #999 !important;
            width: auto !important;
        }

        .was-validated .custom-select:invalid + .select2 .select2-selection{
            border-color: #dc3545!important;
        }
        .was-validated .custom-select:valid + .select2 .select2-selection{
            border-color: #28a745!important;
        }
        *:focus{
            outline:0px;
        }
    </style>
@endpush

@push('after-scripts')
    <script src="{{ asset('vendor/js/select2.full.min.js') }}"> </script>
    <script src="{{ asset('vendor/js/app/examination/form.js') }}"> </script>
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Examination Form
        </x-slot>

        <x-slot name="body">
            <x-backend.patient :patientInformation=$patientInformation/>
            <x-forms.post :action="route('admin.admission.saveAdmission')" id="examination-form">
                <input type="hidden" name="admission_id" value="{{ $admissionId }}">
                <input type="hidden" name="dic_id" value="{{ $admissionData->dic_id }}">
                <div id="vital-panel">
                    <x-backend.card>
                        <x-slot name="header">
                            Vital Sign
                        </x-slot>
                        <x-slot name="body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group required row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Tinggi Badan')</label>
        
                                        <div class="input-group col-md-6">
                                            <input type="text" name="height" tabindex="4" id="height" class="form-control" value="{{ old('height') == null ? $admissionData->height : old('height') }}" placeholder="{{ __('Tinggi Badan') }}" maxlength="100" required autofocus autocomplete="height" aria-describedby="height-label" />
                                            <span class="input-group-text" id="height-label">cm</span>
                                        </div>
                                    </div><!--form-group-->
                                    <div class="form-group required row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Denyut Nadi')</label>
        
                                        <div class="input-group col-md-6">
                                            <input type="text" name="blood_pulse" tabindex="7" id="blood_pulse" class="form-control" value="{{ old('blood_pulse') == null ? $admissionData->blood_pulse : old('blood_pulse')  }}" placeholder="{{ __('Denyut Nadi') }}" maxlength="100" required autofocus autocomplete="blood_pulse" aria-describedby="blood_pulse-label" />
                                            <span class="input-group-text" id="blood_pulse-label">/ menit</span>
                                        </div>
                                    </div><!--form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group required row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Berat Badan')</label>
        
                                        <div class="input-group col-md-6">
                                            <input type="text" name="weight" tabindex="5" id="weight" class="form-control" value="{{ old('weight') == null ? $admissionData->weight : old('weight')  }}" placeholder="{{ __('Berat Badan') }}" maxlength="100" required autofocus autocomplete="weight"  aria-describedby="weight-label" />
                                            <span class="input-group-text" id="weight-label">kg</span>
                                        </div>
                                    </div><!--form-group-->
                                    <div class="form-group required row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Pernafasan')</label>
        
                                        <div class="input-group col-md-6">
                                            <input type="text" name="respiratory_rate" tabindex="8" id="respiratory_rate" class="form-control" value="{{ old('respiratory_rate') == null ? $admissionData->respiratory_rate : old('respiratory_rate')  }}" placeholder="{{ __('Pernafasan') }}" maxlength="100" required autofocus autocomplete="respiratory_rate" aria-describedby="rr-label"/>
                                            <span class="input-group-text" id="rr-label">/ menit</span>
                                        </div>
                                    </div><!--form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group required row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Suhu Tubuh')</label>
        
                                        <div class="input-group col-md-6">
                                            <input type="text" name="body_temp" tabindex="6" id="body_temp" class="form-control" value="{{ old('body_temp') == null ? $admissionData->body_temp : old('body_temp') }}" placeholder="{{ __('Suhu Tubuh') }}" maxlength="100" required autofocus autocomplete="body_temp" aria-describedby="bodytemp-label" />
                                            <span class="input-group-text" id="rr-label">C</span>
                                        </div>
                                    </div><!--form-group-->
                                    <div class="form-group required row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Tekanan Darah')</label>
        
                                        <div class="col-md-6">
                                            <input type="text" name="blood_pressure" tabindex="9" id="blood_pressure" class="form-control" value="{{ old('blood_pressure') == null ? $admissionData->blood_pressure : old('blood_pressure') }}" placeholder="{{ __('Tekanan Darah, ex: 120/100') }}" maxlength="100" required autofocus autocomplete="blood_pressure" />
                                        </div>
                                    </div><!--form-group-->
                                </div>
                            </div>
                        </x-slot>
                    </x-backend.card> <!-- End vital sign form --> 
                </div>
                <x-backend.card>
                    <x-slot name="header">
                        Pemeriksaan
                    </x-slot>
                    <x-slot name="body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group required row">
                                    <label for="name" class="col-md-3 col-form-label text-md-right">@lang('Keluhan')</label>
    
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" tabindex="2" name="symptoms" id="symptoms" value="{{ old('symptoms') == null ? $admissionData->symptoms : old('symptoms') }}" autocomplete="symptoms" autofocus>
                                    </div>
                                </div><!--form-group-->
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 col-form-label text-md-right">@lang('Catatan Keluhan')</label>
    
                                    <div class="col-md-8">
                                        <textarea class="form-control" tabindex="3" name="symptom_notes" id="symptom_notes" cols="70" rows="5">{{ old('symptom_notes') == null ? $admissionData->symptom_notes : old('symptom_notes') }}</textarea>
                                    </div>
                                </div><!--form-group-->
                                <div class="form-group required row">
                                    <label for="name" class="col-md-3 col-form-label text-md-right">@lang('Diagnosa Utama')</label>

                                    <div class="col-md-8">
                                        <select class="form-control" name="primary_diagnose_code" id="primary_diagnose_code">
                                            <option value="0" selected disabled>-- Pilih --</option>
                                        </select>
                                    </div>
                                </div><!--form-group-->
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 col-form-label text-md-right">@lang('Diagnosa Penyerta')</label>

                                    <div class="col-md-8">
                                    <select class="form-control" name="secondary_diagnose_code" id="secondary_diagnose_code">
                                            <option value="0" selected disabled>-- Pilih --</option>
                                        </select>
                                    </div>
                                </div><!--form-group-->
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 col-form-label text-md-right">@lang('Rekomendasi Medis')</label>
    
                                    <div class="col-md-8">
                                        <textarea class="form-control" tabindex="3" name="medical_recommendation" id="medical_recommendation" cols="70" rows="5">{{ old('medical_recommendation') }}</textarea>
                                    </div>
                                </div><!--form-group-->
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-md-8">
                                        <select class="form-control" name="instruction_select" id="instruction-select">
                                            <option value="0" selected disabled>-- Pilih Tindakan --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" min=1 value="1" class="form-control" placeholder="Qty" name="instruction_qty" id="instruction-qty">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success" id="btn-add-instruction">Tambah</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <br>
                                        <table class="table table-bordered" id="instruction-table">
                                            <thead>
                                                <th>
                                                    Tindakan
                                                </th>
                                                <th>Qty</th>
                                                <th>Aksi</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="3" class="no-row-data text-center">Belum Ada Tindakan yang Ditambahkan</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col-md-7">
                                        <select class="form-control" name="medicine_select" id="medicine-select">
                                            <option value="0" selected disabled>-- Pilih Obat / Alkes --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" placeholder="Signa" name="medicine_signa" id="signa">
                                    </div>
                                </div>
                                    <br>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="number" min=1 value="1" class="form-control" placeholder="Qty" name="medicine_qty" id="medicine-qty">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success" id="btn-add-medicine">Tambah</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <br>
                                        <table class="table table-bordered" id="medicine-table">
                                            <thead>
                                                <th>Obat</th>
                                                <th>Qty</th>
                                                <th>Signa</th>
                                                <th>Aksi</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="4" class="text-center">Belum Ada Obat yang Ditambahkan</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-slot>
                    
                </x-backend.card>
                <div class="row">
                    <div class="col text-end">
                        <button type="button" id="btn-examination-done" class="btn btn-info">Pemeriksaan Selesai</button>
                    </div>
                </div>
            </x-form>
        </x-slot>
    </x-backend.card>
@endsection
