$(document).ready( () => {
    new DataTable('#dayoff-table', {
        ajax: '/admin/schedule/get-dayoff-list',
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
                data: 'dayoff_date',
                title: 'Tanggal',
                render: (data, type, row) => {
                    return moment(data).format('DD-MM-YYYY')
                }
            },
            {
                data: 'reason',
                title: 'Alasan'
            },
            {
                data: null,
                title: 'Action',
                render: (data, type, row) => {
                    return `
                        <a class="btn btn-info" href="/admin/schedule/edit-dayoff/${row.dayoff_id}">Edit</a> 
                        <a class="btn btn-danger" href="/admin/schedule/delete-dayoff/${row.dayoff_id}">Delete</a> 
                    `
                }
            },
        ],
    })

})