$(document).ready( () => {
    $('#total-payment').on('keyup', () => {
        var totalAmount = parseFloat($('#total-amount').val().replace('.', ''))
            totalPayment = parseFloat($('#total-payment').val().replace('.', ''))

        $('#total-payment').val(helper.format(totalPayment))
        $('#changes').val(helper.format(Math.abs(parseInt(totalAmount - totalPayment))))
    })

    $('#submit-payment').on('click', () => {
        let _paymentForm = $('#payment-form').serializeArray()

        $.ajax({
            url: $('#payment-form').attr('action'),
            method: 'POST',
            data: _paymentForm,
            success: (response) => {
                window.location.href = `/admin/payment`
            }

        })
    })
})