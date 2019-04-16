@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('.autocomplete_off').attr('autocomplete','off');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function () {
            $('#orderTable').DataTable();
        })
        $(document.body).on('click', '.delete_order', function () {
            var invoice_id = $('.invoice_id').attr('value');
            $('#form-d-order').attr('action', '/admin/orders/' + invoice_id + '/delete');
        });
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">ORDERS <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('orders.process') }}">Processing Orders</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Processing Order(s)</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-create"> <i
                                class="icon-fa icon-fa-plus"></i> Export</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-import"> <i class="icon-fa icon-fa-cloud-upload"></i>
                            Print</button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="responsive-datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date(Y-M-D)</th>
                                <th>Order No</th>
                                <th>Client</th>
                                <th>Due Date</th>
                                <th>Due Payment</th>
                                <th>Total</th>
                                <th>Actions</th>

                            </tr>


                        </thead>

                        @if (!$invoice->isEmpty())
                        <tbody>

                            @if(Session::has('success'))
                            <button class="btn btn-success" data-toastr="success" data-message="{{ Session::get('success') }}"
                                data-title="Success!">
                            </button>
                            @endif
                            @if(Session::has('failure'))
                            <button class="btn btn-danger" data-toastr="error" data-message="{{ Session::get('failure') }}"
                                data-title="Error!">
                            </button>
                            @endif
                            @if(Session::has('warning'))
                            <button class="btn btn-warning" data-toastr="warning" data-message="{{ Session::get('warning') }}"
                                data-title="Warning!">
                            </button>
                            @endif
                            @foreach($invoice as $order)
                            <tr class="order_id" value="{{ $order->id }}">
                                <td>
                                    {{ Carbon\Carbon::parse( $order->created_at)->format('d M Y') }}
                                </td>
                                <td>
                                    {{ $order->id }} </td>
                                <td>
                                    {{ \buzzeroffice\Client::where('id',$order->client_id)->first()->name }} </td>
                                <td>
                                    {{ $order->due_date }} </td>

                                <td>
                                    <span style="color: red"><strong>{{ $order->balance }}</strong></span> </td>
                                <td>
                                    @if($order->g_total == null)
                                    <span style="color: green"><strong>0.00</strong></span> </td>
                                @else
                                <span style="color: green"><strong>{{ $order->g_total }}</strong></span>
                                @endif
                                </td>

                                <td>
                                    <form action="{{ route('orders.updateStatusToShipping',$order->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn btn-default"><i class="fa fa-arrow-right"></i>Move
                                            to Shipping</button>
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                        @else
                        <tbody>
                            <div class="card text-white bg-info text-sm-center">
                                <div class="card-body">
                                    <blockquote class="card-bodyquote">
                                        <p>Hi, you don't have any processing order yet</p>
                                        <footer>Please add/import your vendor(s) by using "New Purchase" in the left
                                            sidebar</footer>
                                    </blockquote>
                                </div>
                            </div>
                        </tbody>
                        @endif
                        <tfoot>
                            <tr>

                                <th>Date(Y-M-D)</th>
                                <th>Order No</th>
                                <th>Client</th>
                                <th>Due Date</th>
                                <th>Due Payment</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>




                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection