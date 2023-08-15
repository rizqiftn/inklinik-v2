const weekdays = [
    {
        reference_id: 1,
        reference_value: 'Minggu'
    },
    {
        reference_id: 2,
        reference_value: 'Senin'
    },
    {
        reference_id: 3,
        reference_value: 'Selasa'
    },
    {
        reference_id: 4,
        reference_value: 'Rabu'
    },
    {
        reference_id: 5,
        reference_value: 'Kamis'
    },
    {
        reference_id: 6,
        reference_value: 'Jumat'
    },
    {
        reference_id: 7,
        reference_value: 'Sabtu'
    },
];

const countAge = (dob = '') => {
    var diff = moment(dob).diff(moment(), 'milliseconds');
    return moment.duration(diff);
}

jQuery( () => {
    $('#schedule_id').select2({
        theme: "bootstrap",
        allowClear: true
    })

    $('#symptoms').select2({
        theme: "bootstrap",
        allowClear: true,
        placeholder: "Masukkan Keluhan Utama anda, contoh: Sakit kepala",
        ajax: {
            url: '/get-symptoms',
            data: (params) => {
                var query = {
                    search: params.term,
                }

                return query
            },
            processResults: (response) => {
                return {
                    results: response.data
                }
            }
        }
    })

    $("#admission_date").datepicker({
        locale: 'id',
        format: 'yyyy-mm-dd',
        autoclose: true,
        startDate: moment($('#date-start').val()).format('YYYY-MM-DD'),
        daysOfWeekDisabled: dayOff,
        beforeShowDay: function (currentDate) {
            if (dateDisabled.length > 0) {
                for (var i = 0; i < dateDisabled.length; i++) {
                    if (moment(currentDate).unix()==moment(dateDisabled[i],'YYYY-MM-DD').unix()){
                        return false;
                    }
                }
            }
            return true;
            }
        })

    $('#admission_date').on('change', () => {
        let days = weekdays.find(d => d.reference_value === moment($('#admission_date').val()).format('dddd') );
        $.ajax({
            url: `/get-schedule-time/${days.reference_id}/${$('#admission_date').val()}`,
            success: (response) => {
                const {data} = response
                $('#schedule_id').empty()
                if ( data.length ) {
                    $.each(data, (k,v) => {
                        let scheduleOptions = new Option(
                            `${v.schedule_time_start} - ${v.schedule_time_end}`, 
                            v.schedule_id, 
                            v.schedule_id == $('#selected-schedule').val(),
                            v.schedule_id == $('#selected-schedule').val()
                        )
                        $('#schedule_id').append(scheduleOptions)
                    })
                }
                
            }
        })
    })
})