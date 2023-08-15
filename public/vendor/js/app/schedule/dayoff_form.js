$(document).ready( () => {
    $("#dayoff_date").datepicker({
        locale: 'id',
        format: 'yyyy-mm-dd',
        autoclose: true,
        orientation: 'bottom',
        startDate: moment($('#date-start').val()).format('YYYY-MM-DD'),
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
})