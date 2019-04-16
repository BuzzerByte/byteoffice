@section('scripts')
<script>
    initialize();
    function initialize(){
        $('.autocomplete_off').attr('autocomplete','off');
    }
    $(document.body).on('click', '.show_payment', function () {
        $('#client_address').empty();
        $('#vendor_address').empty();
        $('#office_address').empty();
        var payment_id = $(this).siblings('.payment_id').val();
        var vendor_id = $(this).siblings('.vendor_id').val();
        var client_id = $(this).siblings('.client_id').val();
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

    $(document.body).on('click', '.edit_payment', function () {
        $('.purchaseId').val($('.purchase_id').val());
        var payment_id = $(this).siblings('.payment_id').val();
        $('#editPayment').attr('action', '/admin/payments/' + payment_id);

        $.get('/admin/payments/' + payment_id, function (data) {
            $('#editPayment').find('#datepicker-3').val(data['payment'][0]['date']);
            $('#editPayment').find('#reference_no').val(data['payment'][0]['reference_no']);
            $('#editPayment').find('#amount').val(data['payment'][0]['received_amt']);
            $('#editPayment').find('#attachment').val(data['payment'][0]['attachment']);
            $('#editPayment').find('#method').val(data['payment'][0]['payment_method']);
        });
    });

    $(document.body).on('click', '.delete_payment', function () {
        var payment_id = $(this).siblings('.payment_id').val();


        $('#form-d-payment').attr('action', '/admin/payment/' + payment_id + '/delete');


    });

</script>
@stop
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">View Payment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="addPayment" action="{{ route('payments.add') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Payment Ref.</th>
                                    <th>Payment Method</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach($payments as $pay)
                                @if(isset($invoice))
                                <tr>
                                    <td>{{ $pay->date }}</td>
                                    <td>{{ $pay->reference_no }}</td>
                                    <td>{{ $pay->payment_method }}</td>
                                    <td>
                                        {{ $pay->received_amt }}@if($pay->attachment == null || $pay->attachment == "")
                                        <p style="color:chocolate">No attachment</p>
                                        @else
                                        <a href="/admin/payments/{{ $pay->attachment }}"><i class="fa fa-link"
                                                aria-hidden="true"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row">
                                            <input type="text" class="invoice_id" value="{{ $pay->order_id }}" hidden>
                                            @if(isset(\buzzeroffice\Order::where('id',$pay->order_id)->first()->client_id))
                                            <input type="text" class="client_id" value="{{ \buzzeroffice\Order::where('id',$pay->order_id)->first()->client_id }}"
                                                hidden>
                                            @else
                                            @endif
                                            <input type="text" class="payment_id" value="{{ $pay->id }}" hidden>
                                            <div class="col-sm-4">
                                                <div class="icon-box show_payment" data-target="#payments_show"
                                                    data-toggle="modal" data-dismiss="modal"><i class="icon-ln icon-ln-eye"></i></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="icon-box edit_payment" data-target="#payments_edit"
                                                    data-toggle="modal" data-dismiss="modal"><i class="icon-ln icon-ln-pencil"></i></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="icon-box danger delete_payment" data-target="#payments_delete"
                                                    data-toggle="modal" data-dismiss="modal"><i class="icon-ln icon-ln-trash"></i></div>
                                            </div>



                                        </div>

                                    </td>
                                </tr>
                                @elseif(isset($purchase))
                                <tr>
                                    <td>{{ $pay->date }}</td>
                                    <td>{{ $pay->reference_no }}</td>
                                    <td>{{ $pay->payment_method }}</td>
                                    <td>
                                        {{ $pay->received_amt }}

                                        @if($pay->attachment == null || $pay->attachment == "")
                                        <p style="color:chocolate">No attachment</p>
                                        @else
                                        <a href="/admin/payments/{{ $pay->attachment }}"><i class="fa fa-link"
                                                aria-hidden="true"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row">
                                            <input type="text" class="purchase_id" value="{{ $pay->purchase_id }}"
                                                hidden>
                                            @if(isset(\buzzeroffice\Purchase::where('id',$pay->purchase_id)->first()->vendor_id))
                                            <input type="text" class="vendor_id" value="{{ \buzzeroffice\Purchase::where('id',$pay->purchase_id)->first()->vendor_id }}"
                                                hidden>

                                            @else

                                            @endif

                                            <input type="text" class="payment_id" value="{{ $pay->id }}" hidden>
                                            <div class="col-sm-4">
                                                <div class="icon-box show_payment" data-target="#payments_show"
                                                    data-toggle="modal" data-dismiss="modal"><i class="icon-ln icon-ln-eye"></i></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="icon-box edit_payment" data-target="#payments_edit"
                                                    data-toggle="modal" data-dismiss="modal"><i class="icon-ln icon-ln-pencil"></i></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="icon-box danger delete_payment" data-target="#payments_delete"
                                                    data-toggle="modal" data-dismiss="modal"><i class="icon-ln icon-ln-trash"></i></div>
                                            </div>



                                        </div>



                                    </td>
                                </tr>
                                @endif

                                @endforeach



                            </tbody>
                        </table>

                    </div>
                </div>
                {{-- edit till here --}}

            </div>
            <div class="modal-footer">
                <input type="hidden" class="purchaseId" name="purchaseId" value="">
                <input type="hidden" class="invoiceId" name="invoiceId" value="">
                <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>


                <button class="btn btn-primary" type="submit" value="Submit" id="save_payment"><i class="fa fa-save"></i>
                    Save</button>
            </div>
        </form>
    </div>
</div>