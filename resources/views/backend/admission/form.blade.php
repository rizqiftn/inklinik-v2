@extends('backend.layouts.app')

@section('title', __('Admission Form'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Patient Admission Form
        </x-slot>

        <x-slot name="body">
            <x-backend.patient :patientInformation=$patientInformation/>
            <x-forms.post :action="route('admin.admission.saveAdmission')">
                <input type="hidden" name="patient_id" value="{{ old('patient_id') == null ? $patientInformation->patient_id : old('patient_id')}}">
                <input type="hidden" name="nic_id" value="{{ old('nic_id') == null ? $nurseData->nurse_id : old('nic_id') }}">
                <input type="hidden" name="queue_id" value="{{ old('queue_id') == null ? (isset($queueData->queue_id) ? $queueData->queue_id : null) : old('queue_id') }}">
                <x-backend.card>
                    <x-slot name="header">
                        Informasi Kunjungan
                    </x-slot>
                    <x-slot name="body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group required row">
                                    <label for="name" class="col-md-2 col-form-label text-md-right">@lang('Dokter')</label>
    
                                    <div class="col-md-8">
                                        <select class="form-control" name="dic_id" id="dic_id" tabindex="1" autofocus>
                                            <option value="0" disabled selected>-- Pilih --</option>
                                            @foreach ($doctorOptions as $key => $doctorItem)
                                                <option 
                                                        value="{{ $doctorItem['id'] }}" 
                                                        @if ($doctorItem['id'] == $queueData->dic_id)
                                                            selected
                                                        @endif
                                                    >{{ $doctorItem['text'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!--form-group-->
                                <div class="form-group required row">
                                    <label for="name" class="col-md-2 col-form-label text-md-right">@lang('Keluhan')</label>
    
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" tabindex="2" name="symptoms" id="symptoms" value="{{ old('symptoms') == null ? $queueData->symptoms : old('symptoms') }}" autocomplete="symptoms" autofocus>
                                    </div>
                                </div><!--form-group-->
                                <div class="form-group row">
                                    <label for="name" class="col-md-2 col-form-label text-md-right">@lang('Catatan')</label>
    
                                    <div class="col-md-8">
                                        <textarea class="form-control" tabindex="3" name="symptom_notes" id="symptom_notes" cols="70" rows="5">{{ old('symptom_notes') == null ? $queueData->symptom_notes : old('symptom_notes') }}</textarea>
                                    </div>
                                </div><!--form-group-->
                            </div>
                        </div>
                    </x-slot>
                </x-backend.card>  <!-- End informasi kunjungan card -->
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
                                        <input type="text" name="height" tabindex="4" id="height" class="form-control" value="{{ old('height') }}" placeholder="{{ __('Tinggi Badan') }}" maxlength="100" required autofocus autocomplete="height" aria-describedby="height-label" />
                                        <span class="input-group-text" id="height-label">cm</span>
                                    </div>
                                </div><!--form-group-->
                                <div class="form-group required row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Denyut Nadi')</label>
    
                                    <div class="input-group col-md-6">
                                        <input type="text" name="blood_pulse" tabindex="7" id="blood_pulse" class="form-control" value="{{ old('blood_pulse') }}" placeholder="{{ __('Denyut Nadi') }}" maxlength="100" required autofocus autocomplete="blood_pulse" aria-describedby="blood_pulse-label" />
                                        <span class="input-group-text" id="blood_pulse-label">/ menit</span>
                                    </div>
                                </div><!--form-group-->
                            </div>
                            <div class="col-md-4">
                                <div class="form-group required row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Berat Badan')</label>
    
                                    <div class="input-group col-md-6">
                                        <input type="text" name="weight" tabindex="5" id="weight" class="form-control" value="{{ old('weight') }}" placeholder="{{ __('Berat Badan') }}" maxlength="100" required autofocus autocomplete="height"  aria-describedby="weight-label" />
                                        <span class="input-group-text" id="weight-label">kg</span>
                                    </div>
                                </div><!--form-group-->
                                <div class="form-group required row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Pernafasan')</label>
    
                                    <div class="input-group col-md-6">
                                        <input type="text" name="respiratory_rate" tabindex="8" id="respiratory_rate" class="form-control" value="{{ old('respiratory_rate') }}" placeholder="{{ __('Pernafasan') }}" maxlength="100" required autofocus autocomplete="respiratory_rate" aria-describedby="rr-label"/>
                                        <span class="input-group-text" id="rr-label">/ menit</span>
                                    </div>
                                </div><!--form-group-->
                            </div>
                            <div class="col-md-4">
                                <div class="form-group required row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Suhu Tubuh')</label>
    
                                    <div class="input-group col-md-6">
                                        <input type="text" name="body_temp" tabindex="6" id="body_temp" class="form-control" value="{{ old('body_temp') }}" placeholder="{{ __('Suhu Tubuh') }}" maxlength="100" required autofocus autocomplete="body_temp" aria-describedby="bodytemp-label" />
                                        <span class="input-group-text" id="rr-label">C</span>
                                    </div>
                                </div><!--form-group-->
                                <div class="form-group required row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Tekanan Darah')</label>
    
                                    <div class="col-md-6">
                                        <input type="text" name="blood_pressure" tabindex="9" id="blood_pressure" class="form-control" value="{{ old('blood_pressure') }}" placeholder="{{ __('Tekanan Darah, ex: 120/100') }}" maxlength="100" required autofocus autocomplete="blood_pressure" />
                                    </div>
                                </div><!--form-group-->
                            </div>
                        </div>
                    </x-slot>
                </x-backend.card> <!-- End vital sign form --> 
                <div class="row">
                    <div class="col text-end">
                        <button type="submit" class="btn btn-info">Simpan Kunjungan</button>
                    </div>
                </div>
            </x-form>
        </x-slot>
    </x-backend.card>

@endsection
