$(document).ready( () => {
    $('#btn-next-queue').on('click', () => {
        $.ajax({
            url: '/admin/admission/get-latest-queue',
            success: (response) => {
                const {data} = response

                if ( data.queueCount == 0) {
                    $('#btn-next-queue').attr('disabled', true)
                }

                $('#btn-patient-admission').attr('disabled', false).attr('data-queueId', data.latest.queue_id)
                $('#btn-skip-queue').attr('disabled', false).attr('data-queueId', data.latest.queue_id)

                $('#display-antrian').text(data.latest.queue_number)
                $('#display-sisa-antrian').text(data.queueCount)
            }
        })
    })

    $('#btn-patient-admission').on('click', () => {
        window.location.href = `/admin/admission/new-admission?queue_id=${$('#btn-patient-admission').attr('data-queueId')}`
    })

    $('#btn-skip-queue').on('click', () => {
        $.ajax({
            url: `/admin/admission/skip-queue?queue_id=${ $('#btn-skip-queue').attr('data-queueId') }`,
            success: (response) => {
                skipQueueTable.draw()
                $('#display-antrian').text('-')
                if ( $('#display-sisa-antrian').text() != '0' ) {
                    $.ajax({
                        url: '/admin/admission/get-latest-queue',
                        success: (response) => {
                            const {data} = response
            
                            if ( data.queueCount == 0) {
                                $('#btn-next-queue').attr('disabled', true)
                            }

                            $('#display-sisa-antrian').text(data.queueCount)
                        }
                    })
                }
            }
        })
    })

    skipQueueTable = new DataTable('#skip-queue-table', {
        ajax: '/admin/admission/get-skipped-queue-data',
        processing: true,
        serverSide: true,
        paging: false,
        searching: false,
        ordering: false,
        columns: [
            {
                data: 'queue_number',
                title: 'No. Antrian'
            },
            {
                data: 'queue_number',
                title: 'Status',
            
            },
            {
                data: null,
                title: 'Action',
                render: (data, type, row) => {
                    return `
                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                        <a href="/admin/admission/new-admission?queue_id=${row.queue_id}" style="margin-bottom: 10px; width: 200px" class="btn btn-info">Pencatatan Kunjungan <i class="cil cil-user"></i></a>
                    </div>
                    `
                }
            }
        ]
    })
})