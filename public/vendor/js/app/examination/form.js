var instructionData = [];
    medicineData = [];

var instructionItem = []
    medicineItem = []
$(document).ready( () => {
    $('#primary_diagnose_code, #secondary_diagnose_code').select2({
        theme: 'bootstrap',
        allowClear: true,
        placeholder: "Pilih",
        ajax: {
            url: '/admin/examination/get-primary-diagnose',
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

    $('#instruction-select').select2({
        theme: 'bootstrap',
        allowClear: true,
        placeholder: "Pilih",
        ajax: {
            url: '/admin/examination/get-instruction',
            data: (params) => {
                var query = {
                    search: params.term,
                }

                return query
            },
            processResults: (response) => {
                instructionItem = response.data
                return {
                    results: response.data
                }
            }
        }
    })

    $('#btn-examination-done').on('click', () => {
        let _examinationForm = $('#examination-form').serializeArray()

        if ( instructionData.length < 1) {
            console.log("Belum dilakukan input tindakan yang dilakukan!")
            return false;
        }
        _examinationForm.push({
            name: 'instruction',
            value: JSON.stringify(instructionData)
        })

        _examinationForm.push({
            name: 'pharmacy',
            value: JSON.stringify(medicineData)
        })
        $.ajax({
            url: '/admin/examination/store',
            method: 'POST',
            data: _examinationForm,
            success: (response) => {
                window.location.href = `/admin/worklist`
            }

        })
    })

    $('#medicine-select').select2({
        theme: 'bootstrap',
        allowClear: true,
        placeholder: "Pilih",
        ajax: {
            url: '/admin/examination/get-medicine',
            data: (params) => {
                var query = {
                    search: params.term,
                }

                return query
            },
            processResults: (response) => {
                medicineItem = response.data
                return {
                    results: response.data
                }
            }
        }
    })

    $('#btn-add-instruction').on('click', () => {
        let inputErrors = [];
        let instructionId = $('#instruction-select').val()
            instructionQty =  parseInt($('#instruction-qty').val())

        // required validation
        if ( instructionId == null ) {
            inputErrors.push({
                elm: $('#instruction-select'),
                message: "Tindakan Tidak Boleh Kosong!"
            })
        }

        if ( instructionQty == null || instructionQty == 0 ) {
            inputErrors.push({
                elm: $('#instruction-select'),
                message: "Qty Tidak Boleh Kosong atau Kurang Dari 1!"
            })
        }
        // end required validation

        if ( inputErrors.length ) {
            $.each( inputErrors, (k,v) => {
                console.log(v)
            })
            return false
        }

        // already input validation
        if ( instructionData.length > 0 && typeof instructionData.find( (_item) => _item.instruction_id == parseInt(instructionId)) != 'undefined' ) {
            return false;
        }
        // end already input validation


        instructionData.push({
            instruction_id: instructionId,
            bill_instruction_name: $('#instruction-select :selected').text(),
            instruction_qty: instructionQty
        })


        $('#instruction-select').val("").trigger('change')
        $('#instruction-qty').val(1)
        loadInstructionTable()
    })

    const loadInstructionTable = () => {
        let _table = $('#instruction-table')

        if ( instructionData.length ) {
            let _html = ``
                _number = 0;
            $.each(instructionData, (k, v) => {
                _number++
                _html += `
                <tr> 
                    <td>${v.bill_instruction_name}</td>
                    <td>${v.instruction_qty}</td>
                    <td>
                        <button type="button" class="btn btn-danger delete-instruction-btn" data-id="${k}">
                            <i class="cil cil-trash"></i>
                        </button>
                    </td>
                </tr>`
            })

            _table.find('tbody').empty().append(_html)

            $('.delete-instruction-btn').on('click', ({delegateTarget}) => {
                let instructionKey = $(delegateTarget).attr('data-id')
                instructionData.splice(instructionKey, 1)

                loadInstructionTable()
                return true
            })
            return true
        }

        _table.find('tbody').empty().append(`
        <tr>
            <td colspan="4" class="no-row-data text-center">Belum Ada Tindakan yang Ditambahkan</td>
        </tr>`)
    }

    $('#btn-add-medicine').on('click', () => {
        let medicineId = $('#medicine-select').val()
            medicineQty =  $('#medicine-qty').val()
            medicineSigna =  $('#signa').val()
            medicineInputErrors = []

        // required validation
        if ( medicineId == null ) {
            medicineInputErrors.push({
                elm: $('#medicine-select'),
                message: "Obat / Alkes Tidak Boleh Kosong!"
            })
        }

        if ( medicineQty == null || medicineQty == 0 ) {
            medicineInputErrors.push({
                elm: $('#medicine-qty'),
                message: "Qty Tidak Boleh Kosong atau Kurang Dari 1!"
            })
        }

        if ( medicineSigna == '' ) {
            medicineInputErrors.push({
                elm: $('#signa'),
                message: "Signa Tidak Boleh Kosong!"
            })
        }

        if ( medicineInputErrors.length ) {
            $.each( medicineInputErrors, (k,v) => {
                console.log(v)
            })
            return false
        }

        // end required validation

        // already input validation
        if ( medicineData.length > 0 && typeof medicineData.find( (_item) => _item.medicine_id == parseInt(medicineId)) != 'undefined' ) {
            return false;
        }
        // end already input validation

        medicineData.push({
            medicine_id: medicineId,
            bill_medicine_name: $('#medicine-select :selected').text(),
            medicine_qty: medicineQty,
            medicine_signa: medicineSigna
        })
        

        $('#medicine-select').val("").trigger('change')
        $('#medicine-qty').val(1)
        $('#signa').val("")
        loadMedicineTable()
    })

    const loadMedicineTable = () => {
        let _table = $('#medicine-table')

        if ( medicineData.length ) {
            let _html = ``
                _number = 0;
            $.each(medicineData, (k, v) => {
                _number++
                _html += `
                <tr> 
                    <td>${v.bill_medicine_name}</td>
                    <td>${v.medicine_qty}</td>
                    <td>${v.medicine_signa}</td>
                    <td>
                        <button type="button" class="btn btn-danger delete-medicine-btn" data-id="${k}">
                            <i class="cil cil-trash"></i>
                        </button>
                    </td>
                </tr>`
            })

            _table.find('tbody').empty().append(_html)

            $('.delete-medicine-btn').on('click', ({delegateTarget}) => {
                let medicineKey = $(delegateTarget).attr('data-id')
                medicineData.splice(medicineKey, 1)

                loadMedicineTable()
                return true
            })
            return true
        }

        _table.find('tbody').empty().append(`
        <tr>
            <td colspan="4" class="no-row-data text-center">Belum Ada Tindakan yang Ditambahkan</td>
        </tr>`)
    }
})