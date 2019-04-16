<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('/assets/admin/js/jquery.PrintArea.js')); ?>"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"
    integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function () {
        $('.autocomplete_off').attr('autocomplete', 'off');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document.body).on('click', '.add_payment', function () {
            var invoice_id = $('.inv_id').attr('value');
            $('.invoiceId').val(invoice_id);
        });
        $(document.body).on('click', '.delete_order', function () {
            var invoice_id = $('.invoiceId').attr('value');
            $('#form-d-order').attr('action', '/admin/orders/' + invoice_id + '/delete');
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">ORDERS <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo e(route('orders.index')); ?>">Order List</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-6 col-xl-3">
            <a class="dashbox" href="#">
                <div class="icon-box"><i class="icon-im icon-im-calendar"></i></div>
                <span class="title">
                    150
                </span>
                <span class="desc">
                    OVERDUE
                </span>
            </a>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-3">
            <a class="dashbox" href="#">
                <div class="icon-box"><i class="icon-im icon-im-info"></i></div>
                <span class="title">
                    35
                </span>
                <span class="desc">
                    ESTIMATE
                </span>
            </a>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-3">
            <a class="dashbox" href="#">
                <div class="icon-box"><i class="icon-im icon-im-printer"></i></div>
                <span class="title">
                    35
                </span>
                <span class="desc">
                    OPEN INVOICE
                </span>
            </a>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-3">
            <a class="dashbox" href="#">
                <div class="icon-box"><i class="icon-im icon-im-coin-dollar"></i></div>
                <span class="title">
                    35
                </span>
                <span class="desc">
                    LIFETIME SELL
                </span>
            </a>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Order List</h6>
                    </div>
                    <div class="actions">
                        
                        <button class="btn btn-primary btn-sm" onclick="location.href='<?php echo e(route('orders.export')); ?>'">
                            <i class="icon-fa icon-fa-plus"></i> Export</button>
                        
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-import"> <i
                                class="icon-fa icon-fa-cloud-upload"></i>
                            Print</button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <?php if (\Entrust::can('invoice-list')) : ?>
                    <table id="responsive-datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date(Y-M-D)</th>
                                <th>Order No</th>
                                <th>Client</th>
                                <th>Due Date</th>
                                <th>Order Status</th>
                                <th>Grand Total</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <?php if(!$invoice->isEmpty()): ?>
                        <tbody>
                            <?php if(Session::has('success')): ?>
                            <button class="btn btn-success" data-toastr="success"
                                data-message="<?php echo e(Session::get('success')); ?>" data-title="Success!">
                            </button>
                            <?php endif; ?>
                            <?php if(Session::has('failure')): ?>
                            <button class="btn btn-danger" data-toastr="error"
                                data-message="<?php echo e(Session::get('failure')); ?>" data-title="Error!">
                            </button>
                            <?php endif; ?>
                            <?php if(Session::has('warning')): ?>
                            <button class="btn btn-warning" data-toastr="warning"
                                data-message="<?php echo e(Session::get('warning')); ?>" data-title="Warning!">
                            </button>
                            <?php endif; ?>
                            <?php $__currentLoopData = $invoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="invoiceId inv_id" value="<?php echo e($order->id); ?>">
                                <td><?php echo e($order->timeFormat($order->created_at)); ?>


                                </td>
                                <td>
                                    <?php echo e($order->id); ?> </td>
                                <td><?php echo e($order->orderClient($order->id)); ?>

                                </td>
                                <td>
                                    <?php echo e($order->due_date); ?> </td>
                                <td>
                                    <?php if($order->status == "processing_order"): ?>
                                    <span class="label label-info">Processing Order</span>
                                    <?php elseif($order->status == "awaiting_delivery"): ?>
                                    <span class="label label-warning">Awaiting Delivery</span>
                                    <?php elseif($order->status == "delivery_done"): ?>
                                    <span class="label label-info">Delivery Done</span>
                                    <?php elseif($order->status == "cancel_order"): ?>
                                    <span class="label label-danger">Cancel Order</span>
                                    <?php else: ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span style="color: green"><strong><?php echo e($order->g_total); ?></strong></span> </td>
                                <td>
                                    <?php if($order->paid == null): ?>
                                    <span style="color: #3A89B7"><strong>0.00</strong></span> </td>
                                <?php else: ?>
                                <span style="color: #3A89B7"><strong><?php echo e($order->paid); ?></strong></span> </td>
                                <?php endif; ?>

                                <td>
                                    <?php if($order->balance == null): ?>
                                    <strong>0.00</strong>
                                    <?php else: ?>
                                    <strong><?php echo e($order->balance); ?></strong>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button"
                                            class="btn btn-outline-default dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="/admin/orders/<?php echo e($order->id); ?>">View</a>
                                            <?php if (\Entrust::can('invoice-edit')) : ?>
                                            <a class="dropdown-item" href="/admin/orders/<?php echo e($order->id); ?>/edit">Edit</a>
                                            <?php endif; // Entrust::can ?>
                                            <?php if (\Entrust::can('payment-create')) : ?>
                                            <a class="dropdown-item add_payment" href="#"
                                                data-target="#modal-create-payment" data-toggle="modal">Add Payment</a>
                                            <?php endif; // Entrust::can ?>
                                            
                                            <?php if (\Entrust::can('invoice-delete')) : ?>
                                            <a class="dropdown-item delete_order" href="#" data-target="#delete_order"
                                                data-toggle="modal">Delete</a>
                                            <?php endif; // Entrust::can ?>
                                        </div>
                                    </div>


                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <?php else: ?>
                        <tbody>
                            <div class="card text-white bg-info text-sm-center">
                                <div class="card-body">
                                    <blockquote class="card-bodyquote">
                                        <p>Hi, you don't have any order(s) yet</p>
                                        <footer>Please add/import your vendor(s) by using "New Purchase" in the left
                                            sidebar</footer>
                                    </blockquote>
                                </div>
                            </div>
                        </tbody>
                        <?php endif; ?>
                        <tfoot>
                            <tr>
                                <th>Date(Y-M-D)</th>
                                <th>Order No</th>
                                <th>Client</th>
                                <th>Due Date</th>
                                <th>Order Status</th>
                                <th>Grand Total</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                    <?php endif; // Entrust::can ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <?php echo $__env->make('admin.payments.create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="modal fade" id="modal-index-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <?php echo $__env->make('admin.payments.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="modal fade" id="payments_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle">
    <?php echo $__env->make('admin.payments.show', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="modal fade" id="payments_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <?php echo $__env->make('admin.payments.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="modal fade" id="payments_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <?php echo $__env->make('admin.payments.delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="modal fade" id="delete_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <?php echo $__env->make('admin.orders.delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout-basic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>