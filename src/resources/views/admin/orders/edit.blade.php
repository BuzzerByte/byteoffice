@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="/assets/admin/js/pages/notifications.js"></script>
<script src="/assets/admin/js/pages/validation.js"></script>
<script>
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
        $('.autocomplete_off').attr('autocomplete','off');
    }
    init();

   
    $('#selected_client').change(function () {
        var client_id = $(this).val();
        $.get("/admin/client/" + client_id, function (data) {
            $('#email').val(data['client'][0]['email']);
            $('#b_address').val(data['client'][0]['billing_address']);
            $('#s_address').val(data['client'][0]['shipping_address']);
        });
    });

    $(document.body).on("change", ".inventory", function () {
        var inventory_id = $(this).val();
        var list = $(this);
        $.get("/admin/inventory/" + inventory_id, function (data) {
            list.closest('td').siblings('td').find('.quantity').val(1);
            list.closest('td').siblings('td').find('.rate').val(data['inventory'][0][
                'p_price'
            ]);
            list.closest('td').siblings('td').find('.amount').val(data['inventory'][0][
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
            list.closest('td').siblings('td').find('.rate').val(data['inventory'][0][
                'p_price'
            ]);
            list.closest('td').siblings('td').find('.amount').val(data['inventory'][0][
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

    function integerValidation() {
        $('.qty_msg').text('');
        $('#updateInvoice').removeAttr('disabled');
        $('#sales_list .quantity').not(':last').each(function () {
            if (Math.floor($(this).val()) == $(this).val() && $.isNumeric($(this).val())) {

                $(this).after('<div class="qty_msg" style="color:red"></div>');
            } else {
                $('#updateInvoice').attr('disabled', 'disabled');
                $(this).after(
                    '<div class="qty_msg" style="color:red">The value must be integer</div>');
            }
        });
    }

    function clone() {
        var trClone = $('.sales_item').clone();
        trClone.attr("class", "");
        trClone.removeAttr("hidden");
        trClone.find('.new_inventory').attr('class',
            'inventory new_inventory form-control ls-select2');
        if ($('#sales_list tr').length <= 0) {
            trClone.find('select').attr('required', 'required');
            trClone.find('.quantity').attr('required', 'required');
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
        $('#updateInvoice').removeAttr('disabled');
        var regex = /(?:\d*\.\d{1,2}|\d+)$/;
        if (regex.test($(this).val())) {
            
            $('#dis_msg').text('');
        } else {
            $('#updateInvoice').attr('disabled','disabled');
            $('#dis_msg').text('Invalid inputs');
        }
        grand_total();
    });

    $(document.body).on('keyup', '#tax', function () {
        $('#updateInvoice').removeAttr('disabled');
        var regex = /(?:\d*\.\d{1,2}|\d+)$/;
        if (regex.test($(this).val())) {
            
            $('#tax_msg').text('');
        } else {
            $('#updateInvoice').attr('disabled','disabled');
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
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Orders <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('orders.create') }}">Edit Order</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Edit Order</h6>
                    </div>
                </div>
                <form action="{{ route('orders.update',$invoice[0]['id'] ) }}" id="from-invoice" enctype="multipart/form-data"
                    method="post" accept-charset="utf-8">
                    @method('PATCH')
                    @csrf
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Client <span class="required" aria-required="true">*</span></label>
                                                <input type="text" class="form-control" value="{{ $clients[0]['name'] }}"
                                                    readonly="">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- /.Start Date -->
                                            <div class="form-group form-group-bottom">
                                                <label>Email</label>
                                                <input type="email" id="email" name="email" class="form-control autocomplete_off"
                                                    value="{{ $clients[0]['email'] }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Billing Address</label>
                                                <textarea class="form-control autocomplete_off" id="b_address" name="b_address">{{ $clients[0]['billing_address'] }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Shipping Address</label>
                                                <textarea class="form-control autocomplete_off" id="s_address" name="s_address">{{ $clients[0]['shipping_address'] }}</textarea>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            

                                            <div class="form-group">
                                                    <label>Terms</label>


                                                    <div class="input-group input-daterange">
                                                        <input type="text" class="form-control ls-datepicker autocomplete_off"
                                                            data-date-format="yyyy-mm-dd" value="{{ $invoice[0]['invoice_date'] }}">
                                                        <div class="input-group-prepend input-group-append">
                                                            <span class="input-group-text">to</span>
                                                        </div>
                                                        <input type="text" class="form-control ls-datepicker autocomplete_off"
                                                            data-date-format="yyyy-mm-dd" value="{{ $invoice[0]['due_date'] }}">
                                                    </div>
                                                </div>
                                        </div>


                                        <div class="col-md-3">
                                        <label>Invoice Date<span class="required" aria-required="true">*</span></label>
                                                
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="icon-fa icon-fa-calendar"></i>
                                                    </span>
                                                </div>
                                                <input name="invoice_date" type="text" class="form-control ls-datepicker invoice_date autocomplete_off"
                                                    value="{{ $invoice[0]['invoice_date'] }}" data-date-format="yyyy-mm-dd" required>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                        <label>Due Date<span class="required" aria-required="true">*</span></label>
                                               
                                            <div class="input-group">
                                                 <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="icon-fa icon-fa-calendar"></i>
                                                    </span>
                                                </div>
                                                <input name="due_date" type="text" class="form-control ls-datepicker due_date autocomplete_off"
                                                    value="{{ $invoice[0]['due_date'] }}" data-date-format="yyyy-mm-dd" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>

                                                <tr style="background-color: #ECEEF1">
                                                    <th>#</th>
                                                    <th>Product/Service</th>
                                                    <th>Description</th>
                                                    <th>Qty</th>
                                                    <th>Rate</th>
                                                    <th>Amount</th>
                                                    <th> </th>
                                                </tr>
                                            </thead>
                                            <!-- hidden input -->
                                            <tr class="sales_item" hidden>
                                                <td>
                                                    <div class="numbering form-group form-group-bottom">

                                                    </div>
                                                </td>
                                                <td>
                                                    
                                                        <select class="inventory new_inventory form-control" style="width: 100%;"
                                                            name="inventory_id[]">
                                                            @if (!$inventories->isEmpty())
                                                            <option value="">Please Select</option>
                                                            @foreach($inventories as $inventory)
                                                            <option value="{{ $inventory->id}}">
                                                                {{ $inventory->name }}</option>
                                                            @endforeach


                                                            @endif
                                                        </select>
                                                    
                                                </td>
                                                <td>
                                                    
                                                        <input class="description form-control autocomplete_off" type="text" name="inventory_desc[]">
                                                    
                                                </td>
                                                <td>
                                                    
                                                        <input class="quantity form-control autocomplete_off" type="text" style="width:120px"
                                                            name="inventory_qty[]">
                                                    
                                                </td>
                                                <td>
                                                    
                                                        <input class="rate form-control" type="text" style="width:120px"
                                                            name="inventory_rate[]" readonly="">
                                                    
                                                </td>
                                                <td>
                                                    
                                                        <input class="amount form-control" type="text" readonly="" name="inventory_amount[]"
                                                            style="width:120px">
                                                    
                                                </td>
                                                <td>
                                                    

                                                    <button type="button" class="btn btn-outline-danger delete">Remove</button>
                                                </td>
                                            </tr>
                                            <!-- hidden input -->
                                            <tbody id="sales_list">
                                                @foreach($sale_product as $index=>$sale)
                                                <tr class="">
                                                    <td>
                                                        <input type="hidden" name="sale_id[]" value="{{ $sale->id }}">
                                                        <div class="numbering form-group form-group-bottom">{{ $index+1
                                                            }}</div>
                                                    </td>
                                                    <td>
                                                        
                                                            <select class="inventory form-control" style="width: 100%;"
                                                                name="inventory_id[]" required>
                                                                @if (!$inventories->isEmpty())
                                                                <option value="">Please Select</option>
                                                                @foreach($inventories as $inventory)
                                                                @if($sale->inventory_id == $inventory->id)
                                                                <option value="{{ $inventory->id}}" selected>
                                                                    {{ $inventory->name }}</option>
                                                                @else
                                                                <option value="{{ $inventory->id}}">
                                                                    {{ $inventory->name }}</option>
                                                                @endif
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                    
                                                    </td>
                                                    <td>
                                                        
                                                            <input class="description form-control" type="text" name="inventory_desc[]"
                                                                value="{{ $sale->description }}">
                                                        
                                                    </td>
                                                    <td>
                                                        
                                                            <input class="quantity form-control" type="text" style="width:120px"
                                                                name="inventory_qty[]" value="{{ $sale->quantity }}">
                                                        
                                                    </td>


                                                    <td>
                                                        
                                                            <input class="rate form-control" type="text" style="width:120px" readonly=""
                                                                name="inventory_rate[]" value="{{ $sale->rate }}">
                                                        
                                                    </td>
                                                    <td>
                                                    
                                                            <input class="amount form-control" type="text" readonly=""
                                                                name="inventory_amount[]" style="width:120px" value="{{ $sale->amount }}">
                                                        
                                                    </td>
                                                    <td>
                                                            <button type="button" class="btn btn-outline-danger delete">Remove</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                <!-- append list here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 15px"></th>
                                                <th class="col-sm-5"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="5" style="text-align: right">
                                                    Total </td>
                                                <input type="hidden" name="total" value="{{ $invoice[0]['total'] }}">
                                                <td id="total" style="text-align: right; padding-right: 30px">{{
                                                    $invoice[0]['total'] }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" style="text-align: right">
                                                    Discount </td>
                                                <td style="text-align: right; padding-right: 30px">
                                                    <input id="discount" type="" class="form-control" style="text-align: right"
                                                        value="{{ $invoice[0]['discount'] }}" name="discount">
                                                    <div id="dis_msg"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" style="text-align: right">
                                                    Tax Amount </td>
                                                <td style="text-align: right; padding-right: 30px">
                                                    <input id="tax" type="" class="form-control" style="text-align: right"
                                                        value="{{ $invoice[0]['tax'] }}" name="tax">
                                                        <div id="tax_msg"></div>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td colspan="5" style="text-align: right; font-weight: bold">
                                                    Grand Total </td>

                                                <input type="hidden" name="g_total" value="{{ $invoice[0]['g_total'] }}">
                                                <td id="g_total" style="text-align: right; padding-right: 30px; font-weight: bold; font-size: 16px">{{
                                                    $invoice[0]['g_total'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Order Note</label>
                                        <textarea class="form-control" name="order_note">{{ $invoice[0]['order_note'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Order Activities</label>
                                        <textarea class="form-control" name="order_activities">{{ $invoice[0]['order_activities'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>      
                    </div>     
                    <div class="card-footer">
                        <input type="hidden" name="type" value="invoice">
                        <input type="hidden" name="order_id" value="">
                        <button type="submit" class="btn bg-navy btn-flat" id="updateInvoice">Update </button>  
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

