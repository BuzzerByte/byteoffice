<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('/assets/admin/js/jquery.PrintArea.js')); ?>"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Purchases <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo e(route('orders.index')); ?>">Purchase List</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Received Product</h6>
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
                                <th>Date Time</th>
                                <th>Purchase No</th>
                                <th>Supplier</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Received By</th>
                            </tr>
                        </thead>

                        <?php if(!$purchaseproducts->isEmpty()): ?>
                        <tbody>

                            <?php if(Session::has('success')): ?>
                            <button class="btn btn-success" data-toastr="success" data-message="<?php echo e(Session::get('success')); ?>"
                                data-title="Success!">
                            </button>
                            <?php endif; ?>
                            <?php if(Session::has('failure')): ?>
                            <button class="btn btn-danger" data-toastr="error" data-message="<?php echo e(Session::get('failure')); ?>"
                                data-title="Error!">
                            </button>
                            <?php endif; ?>
                            <?php if(Session::has('warning')): ?>
                            <button class="btn btn-warning" data-toastr="warning" data-message="<?php echo e(Session::get('warning')); ?>"
                                data-title="Warning!">
                            </button>
                            <?php endif; ?>

                            <?php $__currentLoopData = $purchaseproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td>
                                    <?php echo e($product->created_at); ?> </td>
                                <td>
                                    <?php echo e($product->purchase_id); ?> </td>
                                <td>
                                    <?php echo e(\buzzeroffice\Vendor::where('id',\buzzeroffice\Purchase::where('id',$product->purchase_id)->first()->vendor_id)->first()->name); ?> </td>
                                <td>
                                    <?php echo e(\buzzeroffice\Inventory::where('id',$product->inventory_id)->first()->name); ?></td>
                                <td>
                                    <?php echo e($product->quantity); ?> </td>
                                <td>
                                    <?php echo e($product->receiver); ?>

                                </td>
                            </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <?php else: ?>
                        <tbody>
                            <div class="card text-white bg-info text-sm-center">
                                <div class="card-body">
                                    <blockquote class="card-bodyquote">
                                        <p>Hi, you don't have any received product(s) yet</p>

                                    </blockquote>
                                </div>
                            </div>
                        </tbody>
                        <?php endif; ?>
                        <tfoot>
                            <tr>
                                <th>Date Time</th>
                                <th>Purchase No</th>
                                <th>Supplier</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Received By</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout-basic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>