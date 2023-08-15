<table class="table table-bordered" border="1">
    <thead>
        <tr>
            <th rowspan="2">No. Urut</th>
            <th rowspan="2">Kode ICD 10</th>
            <th rowspan="2">Deskripsi</th>
            <th colspan="2" class="text-center">Kasus Baru Menurut Jenis Kelamin</th>
            <th rowspan="2">Jumlah Kasus Baru (4+5)</th>
            <th rowspan="2">Jumlah Kunjungan</th>
        </tr>
        <tr>
            <th>Laki-laki</th>
            <th>Perempuan</th>
        </tr>
        <tr>
            <th style="background-color: gray">1</th>
            <th style="background-color: gray">2</th>
            <th style="background-color: gray">3</th>
            <th style="background-color: gray">4</th>
            <th style="background-color: gray">5</th>
            <th style="background-color: gray">6</th>
            <th style="background-color: gray">7</th>
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
                    <td>{{ $diagnoseItem['total_kasus_l'] }}</td>
                    <td>{{ $diagnoseItem['total_kasus_p'] }}</td>
                    <td>{{ $diagnoseItem['total_kasus_baru'] }}</td>
                    <td>{{ $diagnoseItem['total_kunjungan'] }}</td>
                </tr>
            @endforeach
            <?php
        } else {
            ?>
                <tr>
                    <td></td>
                    <td colspan=7 class="text-center">Belum ada data tersedia</td>
                </tr>
            <?php
        }
        ?>
    </tbody>
</table>