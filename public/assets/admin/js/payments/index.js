
initialize();
function initialize(){
    $('.autocomplete_off').attr('autocomplete','off');
}
$('.show_payment').click(function(){
    $('#client_address').empty();
    $('#vendor_address').empty();
    $('#office_address').empty();
    let payment_id = $('#payment_id').val();
    let vendor_id = $('#vendor_id').val();
    let client_id = $('#client_id').val();
    var temp = $(this);
    if ($(this).siblings('.purchase_id').val() == null) {
        $.get('/admin/client/' + client_id, function (data) {
            $('#client_address').append('Customer: <br><h4>' + data['client'][0]['company'] +
                '</h4>' +
                data[
                    'client'][0]['billing_address'] + '<br> Phone: ' + data['client'][0][
                    'phone'
                ] +
                '<br>Email: ' + data['client'][0]['email']);
        });
    } else {
        $.get('/admin/vendor/' + vendor_id, function (data) {
            $('#vendor_address').append('To: <br><h4>' + data['vendor'][0]['company'] + '</h4>' +
                data[
                    'vendor'][0]['billing_address'] + '<br> Phone: ' + data['vendor'][0][
                    'phone'
                ] +
                '<br>Email: ' + data['vendor'][0]['email']);
        });

    }
    $.get('/admin/payments/' + payment_id, function (data) {
        $('#payment_date').text(data['payment'][0]['date']);
        if (temp.siblings('.purchase_id').val() == null) {
            $('#sales_ref').text(data['invoice'][0]['id']);
        } else {
            $('#purchase_ref').text(data['purchase'][0]['id']);
        }
        $('#payment_ref').text(data['payment'][0]['reference_no']);
        $('#office_address').append(
            'From: <br><h4>Buzzer Office</h4>67, Ayer Rajah Crescent, #07-21/26<br>Phone: { phonenumber }<br>Email:rujyi@hotmail.com'
        );
        $('#payment_received').text(data['payment'][0]['received_amt']);
        $('#payment_type').text(data['payment'][0]['payment_method']);
    });
});

$('.edit_payment').click(function(){
    $('.purchaseId').val($('.purchase_id').val());
    let payment_id = $('#payment_id').val();
    $('#editPayment').attr('action', '/admin/payments/' + payment_id);
    $.get('/admin/payments/' + payment_id, function (data) {
        $('#editPayment').find('#datepicker-3').val(data['payment'][0]['date']);
        $('#editPayment').find('#reference_no').val(data['payment'][0]['reference_no']);
        $('#editPayment').find('#amount').val(data['payment'][0]['received_amt']);
        $('#editPayment').find('#attachment').val(data['payment'][0]['attachment']);
        $('#editPayment').find('#method').val(data['payment'][0]['payment_method']);
    });
});

$('.delete_payment').click(function(){
    let payment_id = $('#payment_id').val();
    $('#form-d-payment').attr('action', '/admin/payment/' + payment_id + '/delete');
});
