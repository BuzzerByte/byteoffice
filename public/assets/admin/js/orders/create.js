$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //Initialize Select2 Elements
    function init() {
        clone();
        
        $('.invoice-content').attr('class', 'invoice-content row hidden');
        $('.invoice_date').attr('autocomplete','off');
        $('.inp_email').attr('autocomplete','off');
        $('.inp_b_address').attr('autocomplete','off');
        $('.inp_s_address').attr('autocompelte','off');
        $('.due_date').attr('autocomplete','off');
        $('.autocomplete_off').attr('autocomplete','off');
    }
    init();
    $('#selected_client').change(function () {
        var client_id = $(this).val();
        $.get("/admin/client/" + client_id, function (data) {
            $('#email').val(data['email']);
            $('#b_address').val(data['billing_address']);
            $('#s_address').val(data['shipping_address']);
        });
    });
    
    $(document.body).on("change", ".inventory", function () {
        var inventory_id = $(this).val();
        var list = $(this);
        $.get("/admin/inventory/" + inventory_id, function (data) {
            list.closest('td').siblings('td').find('.quantity').val(1);
            list.closest('td').siblings('td').find('.rate').val(data[
                'p_price'
            ]);
            list.closest('td').siblings('td').find('.amount').val(data[
                'p_price'
            ]);
        });
        $('#sales_list tr').each(function (i) {
            $(this).find('.numbering').text(i + 1);
        });
        setTimeout(function () {
            sumTotal();
        }, 1000);
    });

    $(document.body).on("change", ".new_inventory", function () {
        var inventory_id = $(this).val();
        var list = $(this);
        list.attr('class', 'inventory added form-control ls-select2');
        $.get("/admin/inventory/" + inventory_id, function (data) {
            list.closest('td').siblings('td').find('.quantity').val(1);
            list.closest('td').siblings('td').find('.rate').val(data[
                'p_price'
            ]);
            list.closest('td').siblings('td').find('.amount').val(data[
                'p_price'
            ]);
        });
        setTimeout(function () {
            sumTotal();
        }, 1000);
        clone();
    });

    $(document.body).on('keyup', '.quantity', function () {
        var quantity = $(this).val();
        var p_price = $(this).closest('td').siblings('td').find('.rate').val();
        var amount = quantity * p_price;
        integerValidation();
        $(this).closest('td').siblings('td').find('.amount').val(amount.toFixed(2));
        setTimeout(function () {
            sumTotal();
        }, 1000);
    });

    function integerValidation(){
        $('.qty_msg').text('');
        $('#saveInvoice').removeAttr('disabled');
        $('#sales_list .quantity').not(':last').each(function(){
            if(Math.floor($(this).val()) == $(this).val() && $.isNumeric($(this).val())) {
                
                $(this).after('<div class="qty_msg" style="color:red"></div>');
            }else{
                $('#saveInvoice').attr('disabled','disabled');
                $(this).after('<div class="qty_msg" style="color:red">The value must be integer</div>');
            }
        });   
    }

    function clone() {
        var trClone = $('.sales_item').clone();

        trClone.attr("class", "");
        trClone.removeAttr("hidden");
        trClone.find('.new_inventory').attr('class',
            'inventory new_inventory form-control ls-select2');

        if($('#sales_list tr').length <= 0){
            trClone.find('select').attr('required','required');
            trClone.find('.quantity').attr('required','required');
        }
        
        
        $('#sales_list').append(
            trClone);
    }

    function sumTotal() {
        var total = 0;
        $('.amount').each(function () {
            total += Number($(this).val());
        });
        $('#total').text(total.toFixed(2));
        $('#total').siblings('input').val(total.toFixed(2));
        
            grand_total();
        
    }

    function grand_total() {
        var total = 0;
        $('.amount').each(function () {
            total += Number($(this).val());
        });
        total = total - Number($('#discount').val());
        total = total + Number($('#tax').val());
        $('#g_total').text(total.toFixed(2));
        $('#g_total').siblings('input').val(total.toFixed(2));
    }
    
    $(document.body).on('keyup', '#discount', function () {
        $('#saveInvoice').removeAttr('disabled');
        var regex = /(?:\d*\.\d{1,2}|\d+)$/;
        if (regex.test($(this).val())) {
            
            $('#dis_msg').text('');
        } else {
            $('#saveInvoice').attr('disabled','disabled');
            $('#dis_msg').text('Invalid inputs');
        }
        grand_total();
        
    });

    $(document.body).on('keyup', '#tax', function () {
        $('#saveInvoice').removeAttr('disabled');
        var regex = /(?:\d*\.\d{1,2}|\d+)$/;
        if (regex.test($(this).val())) {
            
            $('#tax_msg').text('');
        } else {
            $('#saveInvoice').attr('disabled','disabled');
            $('#tax_msg').text('Invalid inputs');
        }
        grand_total();
    });

    $(document.body).on('click', '.delete', function () {
        $(this).parents('tr').remove();
        setTimeout(function () {
            sumTotal();
        }, 1000);
    });

    function sumInvTotal() {
        var total = 0;
        $('.inv_total').each(function () {
            total += Number($(this).text());
        });
        $('.inv_subtotal').text(total);
        total = total - Number($('.inv_discount').text());
        total = total + Number($('.inv_tax').text());
        total = total + Number($('.inv_transport').text());
        $('.inv_g_total').text(total);
        total = total - Number($('.inv_paid').text());
        $('.inv_balance').text(total);
    }
});