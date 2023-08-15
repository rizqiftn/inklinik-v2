$(document).ready( () => {
    new DataTable('#examination-table', {
        ajax: '/admin/examination/get-examination-list',
        processing: true,
        serverSide: true,
        columns: [
            {
                data: null,
                title: 'No.',
                render: () => {
                    return '-'
                }
            },
            {
                data: null,
                title: 'Action',
                render: (data, type, row) => {
                    return `
                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                        <button type="button" class="btn btn-success examination-button" data-id="${data.admission_id}" data-status="${data.admission_status}">Periksa</button>
                    </div>
                    `
                }
            },
            {
                data: 'admission_status_text',
                title: 'Status'
            },
            {
                data: 'queue_number',
                title: 'Queue Number'
            },
            {
                data: 'admission_number',
                title: 'Admission Number'
            },
            {
                data: null,
                title: 'Patient Information',
                render: (data, type, row) => {
                    return `${data.patient_name} (${data.sex}) <br/> ${data.patient_age}`
                }
            },
            {
                data: 'doctor_name',
                title: 'Doctor In Charge'
            },
        ],
        drawCallback: () => {
            $('.examination-button').bind('click', ({delegateTarget}) => {
                window.location.href = '/admin/examination/form/' + $(delegateTarget).attr('data-id')
            })
        }
    })

})