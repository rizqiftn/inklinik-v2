@extends('backend.layouts.app')

@section('title', __('Admission Form'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Add Patient Form
        </x-slot>

        <x-slot name="body">
            <x-forms.post :action="route('frontend.auth.register')">
                <div class="form-group required row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Jenis Identitas')</label>

                    <div class="col-md-6">
                        <select class="form-control" name="identity_type" id="identity_type">
                            <option value="0" disabled>-- Pilih --</option>
                            <option value="11" selected>KTP</option>
                        </select>
                    </div>
                </div><!--form-group-->

                <div class="form-group required row">
                    <label for="name" class="col-md-4 col-form-label text-md-right required">@lang('Nomor Identitas / KTP')</label>

                    <div class="col-md-6">
                        <input type="text" name="identity_number" id="identity_number" class="form-control" value="{{ old('identity_number') }}" placeholder="{{ __('Nomor Identitas') }}" maxlength="16" required autofocus autocomplete="identity_number" />
                    </div>
                </div><!--form-group-->

                <div class="form-group required row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Nama Pasien')</label>

                    <div class="col-md-6">
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="{{ __('Nama Pasien') }}" maxlength="100" required autofocus autocomplete="name" />
                    </div>
                </div><!--form-group-->

                <div class="form-group required row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Tanggal Lahir')</label>

                    <div class="col-md-6">
                        <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob') }}" placeholder="{{ __('Tanggal Lahir') }}" maxlength="100" required autofocus autocomplete="dob" />
                    </div>
                </div><!--form-group-->

                <div class="form-group required row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Jenis Kelamin')</label>

                    <div class="col-md-6">
                        <select class="form-control" name="sex" id="sex">
                            <option value="0" disabled selected>-- Pilih --</option>
                            <option value="8" {{ old('sex') == 8 ? 'selected' : '' }}>Laki-laki</option>
                            <option value="9" {{ old('sex') == 9 ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div><!--form-group-->

                <div class="form-group required row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Provinsi')</label>

                    <div class="col-md-6">
                        <select class="form-control" name="province_id" id="province_id">
                            <option value="0" disabled selected>-- Pilih --</option>
                            @foreach ($provinceData as $key => $provinceItem)
                                <option 
                                        value="{{ $provinceItem['id'] }}" 
                                        @if ( $provinceItem['id'] == old('province_id'))
                                            selected
                                        @endif
                                    >{{ $provinceItem['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div><!--form-group-->

                <div class="form-group required row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Kota / Kabupaten')</label>

                    <div class="col-md-6">
                        <select class="form-control" name="city_id" id="city_id">
                            <option value="0" disabled selected>-- Pilih --</option>
                        </select>
                    </div>
                </div><!--form-group-->

                <div class="form-group required row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Kecamatan')</label>

                    <div class="col-md-6">
                        <select class="form-control" name="district_id" id="district_id">
                            <option value="0" disabled selected>-- Pilih --</option>
                        </select>
                    </div>
                </div><!--form-group-->

                <div class="form-group required row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Alamat Domisili (Sesuai KTP)')</label>

                    <div class="col-md-6">
                        <textarea name="address" id="address" class="form-control" placeholder="{{ __('Alamat') }}" required autocomplete="alamat" cols="30" rows="5">
                            {{ old('address') }}
                        </textarea>
                    </div>
                </div><!--form-group-->

                <hr>
                <div class="form-group required row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Nomor Telepon / WA')</label>

                    <div class="col-md-6">
                        <input type="text" name="phone_number" id="phone-number" class="form-control" value="{{ old('phone_number') }}" placeholder="{{ __('Nomor Telepon / WA') }}" maxlength="21" required autofocus autocomplete="phone_number" />
                    </div>
                </div><!--form-group-->

                <div class="form-group required row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('E-mail Address')</label>

                    <div class="col-md-6">
                        <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autocomplete="email" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button class="btn btn-primary" type="submit">@lang('Register')</button>
                    </div>
                </div><!--form-group-->
            </x-forms.post>
        </x-slot>
    </x-backend.card>
@endsection
