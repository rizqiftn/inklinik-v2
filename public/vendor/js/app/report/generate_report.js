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

                $('#btn-print-report').attr('disabled', false)
            }
        })
    })

    $('#btn-print-report').on('click', () => {
        console.log('bisa di klik')
    })
})