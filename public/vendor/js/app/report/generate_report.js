$(document).ready( () => {
    $('#btn-generate-report').on('click', (e) => {
        e.preventDefault()

        $.ajax({
            url: `/admin/report/report-view`,
            method: 'POST',
            data: $('#generate-report-form').serializeArray(),
            success: (response) => {
                const {title, viewFile} = response

                $('#render-title').empty().html(title)
                $('#render-view').empty().html(viewFile)

                let _reportType = $('#report_type').val() == 1 ? 'morbiditas' : 'kunjungan'
                    _reportPeriode = $('#report_periode').val()
                $('#btn-print-report').attr('disabled', false).attr('href', `/admin/report/print/${_reportType}/${_reportPeriode}`)
            }
        })
    })

    $('#btn-print-report').on('click', () => {
        console.log('bisa di klik')
    })
})