@if ($download)
    <style>
    table {
        border-collapse: collapse;
    }
    table, td, th {
        border: 1px solid black;
    }
    </style>
@endif
<table class="table table-bordered table-responsive" border=1>
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
    <?php 
        if ( $result ) {
            $i = 1;
            ?>
            @foreach( $result as $key => $diagnoseItem )
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $diagnoseItem['diagnose_code'] }}</td>
                    <td>{{ $diagnoseItem['diagnose_name'] }}</td>
                    <td>-</td>
                    @foreach( $diagnoseItem['groupage_data'] as $k => $groupAgeItem )
                        <td>{{ $groupAgeItem }}</td>
                    @endforeach
                    <td>{{ $diagnoseItem['total_kasus_baru'] }}</td>
                    <td>0</td>
                    <td>0</td>
                    <td>{{ $diagnoseItem['total_kunjungan'] }}</td>
                </tr>
            @endforeach
            <?php
        } else {
            ?>
                <tr>
                    <td colspan=26 class="text-center">Belum ada data tersedia</td>
                </tr>
            <?php
        }
        ?>
    </tbody>
</table>