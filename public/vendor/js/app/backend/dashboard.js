$(document).ready( () => {
    $.ajax({
        url: '/admin/dashboard/get-dashboard-data',
        success: (response) => {
            const {data} = response

            $('#pasien-diperiksa-text').html(`${data.pasien_menunggu_diperiksa} <br/> Orang`)
            $('#avg-waktu-pelayanan').html(`${data.rata_rata_waktu_pelayanan} <br/> Menit`)
            $('#pasien-hari_ini-text').html(`${data.total_pasien_hari_ini} </br> Orang`)

            let _row = '';
            $.each(data.avg_symptoms, (k,v) => {
                _row += `<tr>
                    <td>${v.symptoms}</td>
                    <td>${ Math.ceil(parseFloat(v.waktu_pelayanan) / 60) } Menit</td>
                </tr>`
            })

            $('#table-avg-symptoms').find('tbody').empty().html(_row)
        }
    })
})