<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="/assets/admin/js/pages/notifications.js"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script>
    // Ladda Buttons
    Ladda.bind( 'div:not(.progress-demo) .ladda-button', { timeout: 2000 } );

    // Bind progress buttons and simulate loading progress
    Ladda.bind( '.progress-demo button', {
        callback: function( instance ) {
            var progress = 0;
            var interval = setInterval( function() {
                progress = Math.min( progress + Math.random() * 0.1, 1 );
                instance.setProgress( progress );

                if( progress === 1 ) {
                    instance.stop();
                    clearInterval( interval );
                }
            }, 200 );
        }
    } );
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    initialize();

    function initialize() {
        $('.inp_vendor_name').attr('autocomplete', 'off');
        $('.inp_company_name').attr('autocomplete', 'off');
        $('.inp_phone').attr('autocomplete', 'off');
        $('.inp_fax').attr('autocomplete', 'off');
        $('.inp_email').attr('autocomplete', 'off');
        $('.inp_website').attr('autocomplete', 'off');
        $('.inp_b_address').attr('autocomplete', 'off');
        $('.inp_vendor_note').attr('autocomplete', 'off');
    }
    $('.edit').click(function () {
        var id = $(this).siblings('.vendor_id').attr('id');
        $('#form-vendor').attr('action', '/admin/vendor/' + id);
        $.get("/admin/vendor/" + id + "/edit", function (data) {

            $('#inp_name').val(data['vendor'][0]['name']);
            $('#inp_company').val(data['vendor'][0]['company']);
            $('#inp_phone').val(data['vendor'][0]['phone']);
            $('#inp_fax').val(data['vendor'][0]['fax']);
            $('#inp_email').val(data['vendor'][0]['email']);
            $('#inp_website').val(data['vendor'][0]['website']);
            $('#inp_b_address').val(data['vendor'][0]['billing_address']);
            $('#inp_note').val(data['vendor'][0]['note']);
        });
    });

    $('.delete').click(function () {
        var id = $(this).siblings('.vendor_id').attr('id');
        $('#form-d-vendor').attr('action', '/admin/vendor/' + id + '/delete');
    });
    </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">VENDOR <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo e(route('vendor.index')); ?>">Vendors</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Vendor List</h6>
                    </div>
                    <div class="actions">
                        <?php if (\Entrust::can('vendor-create')) : ?>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-create"> <i
                                class="icon-fa icon-fa-plus"></i> Add new vendor</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-import"> <i class="icon-fa icon-fa-cloud-upload"></i>
                            Import</button>
                        <?php endif; // Entrust::can ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (\Entrust::can('vendor-list')) : ?>
                    <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Vendor/Company</th>
                                <th>Phone</th>
                                <th>Open Balance</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Vendor/Company</th>
                                <th>Phone</th>
                                <th>Open Balance</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>

                        <?php if(!$vendors->isEmpty()): ?>
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
                            <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($vendor->name); ?></td>
                                <td><?php echo e($vendor->phone); ?></td>
                                <?php if($vendor->open_balance != null): ?>
                                <td>SGD <?php echo e($vendor->open_balance); ?></td>
                                <?php else: ?>
                                <td>SGD 0.00</td>
                                <?php endif; ?>

                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-default dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <input type="hidden" class="vendor_id" id="<?php echo e($vendor->id); ?>">
                                            <a class="dropdown-item" href="/admin/purchases/<?php echo e($vendor->id); ?>/createWithVendor">Create
                                                Bill</a>
                                            <?php if (\Entrust::can('vendor-edit')) : ?>
                                            <a class="dropdown-item edit" href="#" data-toggle="modal" data-target="#modal-edit">Edit</a>
                                            <?php endif; // Entrust::can ?>
                                            <?php if (\Entrust::can('vendor-delete')) : ?>
                                            <a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#modal-delete">Delete</a>
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
                                        <p>Hi, you don't have any vendor yet</p>
                                        <footer>Please add/import your vendor(s) by using button at the top right
                                            corner</footer>
                                    </blockquote>
                                </div>
                            </div>

                        </tbody>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <?php endif; // Entrust::can ?>
                </div>

            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <?php echo $__env->make('admin.vendors.create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="modal fade" id="modal-import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <?php echo $__env->make('admin.vendors.import', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <?php echo $__env->make('admin.vendors.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <?php echo $__env->make('admin.vendors.delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout-basic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>