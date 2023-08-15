$(document).ready( () => {
    new DataTable('#payment-table', {
        ajax: '/admin/payment/get-payment-list',
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
                        <button type="button" class="btn btn-success payment-button" data-id="${data.bill_id}" data-status="${data.payment_status}">Pembayaran</button>
                    </div>
                    `
                }
            },
            {
                data: 'payment_status_text',
                title: 'Status Pembayaran'
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
            $('.payment-button').bind('click', ({delegateTarget}) => {
                window.location.href = '/admin/payment/form/' + $(delegateTarget).attr('data-id')
            })
        }
    })

})