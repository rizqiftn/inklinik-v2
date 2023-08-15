$(document).ready( () => {
    $('#province_id, #city_id, #district_id').select2({
        theme: 'bootstrap'
    })

    $('#province_id').on('change', () => {
        $.ajax({
            url: `/api/get-city/${$('#province_id').val()}`,
            success: (response) => {
                const {data} = response
                $('#city_id').empty()
                if ( data.length ) {
                $.each(data, (k,v) => {
                        let cityOptions = new Option(
                            v.text, 
                            v.id
                        )
                        $('#city_id').append(cityOptions)
                    })
                }
            }
        })
    })

    $('#city_id').on('change', () => {
        $.ajax({
            url: `/api/get-district/${$('#city_id').val()}`,
            success: (response) => {
                const {data} = response
                $('#district_id').empty()
                if ( data.length ) {
                    $.each(data, (k,v) => {
                        let districtOptions = new Option(
                            v.text, 
                            v.id
                        )
                        $('#district_id').append(districtOptions)
                    })
                }
            }
        })
    })
})