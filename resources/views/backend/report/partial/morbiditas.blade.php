<table class="table table-bordered table-responsive">
    <thead>
        <tr>
            <th rowspan="3">No. Urut</th>
            <th rowspan="3">No. DTD</th>
            <th rowspan="3">No. Daftar Terperinci</th>
            <th rowspan="3">Golongan Sebab Penyakit</th>
            <th colspan="{{ count($groupAge) * 2 }}" class="text-center">Jumlah Pasien Kasus Menurut Golongan Umur & Sex</th>
            <th colspan="2" class="text-center">Kasus Baru Menurut Jenis Kelamin</th>
            <th rowspan="3">Jumlah Kasus Baru (23+24)</th>
            <th rowspan="3">Jumlah Kunjungan</th>
        </tr>
        <tr>
            @foreach($groupAge as $key => $groupItem)
                <th colspan=2>{{ $groupItem['group_title'] }}</th>
            @endforeach
            <th rowspan="2">LK</th>
            <th rowspan="2">PR</th>
        </tr>
        <tr>
            @foreach($groupAge as $key => $groupItem)
                <th>L</th>
                <th>P</th>
            @endforeach
        </tr>
        <tr>
            @for ($i=1; $i<=26; $i++)
                <th style="background-color: gray">{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan=26 class="text-center">Belum ada data tersedia</td>
        </tr>
    </tbody>
</table>