$(document).ready( () => {
    new DataTable('#schedule-table', {
        ajax: '/admin/schedule/get-schedule-list',
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
                data: 'doctor_name',
                title: 'Dokter Praktik'
            },
            {
                data: 'day',
                title: 'Hari'
            },
            {
                data: null,
                title: 'Jam Praktik',
                render: (data, type, row) => {
                    return `${row.schedule_time_start} - ${row.schedule_time_end}`
                }
            }
        ],
    })

})