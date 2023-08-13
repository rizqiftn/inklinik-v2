<div class="card">
    <div class="card-body">
        <h6 class="card-title">
            <b>Informasi Pasien</b>
        </h6>
        <hr>
        <div class="row">
            <div class="col-sm">
                <h6>
                    <b>Nama Pasien</b>
                </h6>
                <p>
                    {{ $patientInformation->patient_name }} ({{ $patientInformation->patient_sex }})<br>
                    17 Tahun 5 Bulan 20 Hari
                </p>
            </div>
            <div class="col-sm">
                <h6>
                    <b> No. Handphone / WA </b>
                </h6>
                <p>{{ $patientInformation->phone_number }}</p>
            </div>
            <div class="col-sm">
                <h6>
                    <b>Alamat Pasien</b>
                </h6>
                <p>{{ $patientInformation->address }}</p>
            </div>
        </div>
    </div>
</div> <br> <!-- End Patient Information -->