@extends('frontend.layouts.app')

@section('title', __('Register'))

@push('after-styles')
    <link href="{{ asset('vendor/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/css/select2-bs.min.css') }}" rel="stylesheet">
@endpush

@push('after-scripts')
    <script src="{{ asset('vendor/js/select2.full.min.js') }}"> </script>
    <script src="{{ asset('vendor/js/app/register/form.js') }}"> </script>
@endpush

@section('content')
<br>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Registrasi Pasien')
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
                                    <textarea name="address" id="address" class="form-control" placeholder="{{ __('Alamat') }}" required autocomplete="alamat" cols="30" rows="5">{{ old('address') }}</textarea>
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

                            <div class="form-group required row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Password')</label>

                                <div class="col-md-6">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="new-password" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group required row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Password Confirmation')</label>

                                <div class="col-md-6">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Password Confirmation') }}" maxlength="100" required autocomplete="new-password" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="terms" value="1" id="terms" class="form-check-input" required>
                                        <label class="form-check-label" for="terms">
                                            @lang('I agree to the') <a href="{{ route('frontend.pages.terms') }}" target="_blank">@lang('Terms & Conditions')</a>
                                        </label>
                                    </div>
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button class="btn btn-primary" type="submit">@lang('Register')</button>
                                </div>
                            </div><!--form-group-->
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->
@endsection
