<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="/assets/admin/js/pages/notifications.js"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    initialize();
    function initialize(){
        $('.autocomplete_off').attr('autocomplete','off');
    }
    var personalForm = $("#personalForm");
    $('#editPersonal').click(function (event) {
        //event.preventDefault();
        personalForm.find(':disabled').each(function () {
            $(this).removeAttr('disabled');
            $('#cancelPersonal').show();
            $('#savePersonal').show();
            $('#editPersonal').hide();
        });
    });

    $('#cancelPersonal').click(function (event) {
        //event.preventDefault();
        personalForm.find(':enabled').each(function () {
            $(this).attr("disabled", "disabled");
            $('#cancelPersonal').hide();
            $('#savePersonal').hide();
            $('#editPersonal').show();
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Profile <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo e(route('client.index')); ?>"><?php echo e(Auth::user()->name); ?> Profile</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>User Profile</h6>
                    </div>

                </div>
                <div class="card-body">
                    <div>
                        <?php if($user->photo != NULL): ?>
                        <img src="/employeesPhoto/<?php echo e($user->photo); ?>" alt="<?php echo e($user->photo); ?>"
                            style="max-width:200px;max-height:200px">
                        <?php else: ?>
                        <img src="<?php echo e(asset('/assets/admin/img/avatars/user.png')); ?>" alt="Avatar" style="max-width:200px;max-height:200px"></a>
                        <?php endif; ?>
                    </div>
                   
                    <table id="responsive-datatable" class="table table-bordered" cellspacing="0" width="100%">
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

                            <tr>
                                <td>Employee Id:</td>
                                <td><?php echo e($user->id_number); ?></td>
                            </tr>
                            <tr>
                                <td>First Name:</td>
                                <td><?php echo e($user->f_name); ?></td>
                            </tr>
                            <tr>
                                <td>Last Name:</td>
                                <td><?php echo e($user->l_name); ?></td>
                            </tr>
                            <tr>
                                <td>Department:</td>
                                
                                <td><?php echo e($user->department($user->id)); ?></td>
                               
                            </tr>
                            <tr>
                                <td>Job Title:</td>
                                <td><?php echo e($user->jobTitle($user->id)); ?></td>
                            </tr>
                            <tr>
                                <td>Job Category:</td>
                                <td><?php echo e($user->JobCategory($user->id)); ?></td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td>
                                    <?php if($user->terminate_status == 0): ?>
                                    activate
                                    <?php else: ?>
                                    inactivate
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Work Shift:</td>
                                <td><?php echo e($user->workShift($user->id)); ?></td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Update Password</h6>
                    </div>

                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('users.update',$user->id )); ?>" id="personalForm" enctype="multipart/form-data"
                        method="post" accept-charset="utf-8">
                        <?php echo method_field('PUT'); ?>
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password<span class="required" aria-required="true">*</span></label>
                                    <input type="password" name="password" value="" class="form-control" disabled="disabled"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Retype Password<span class="required" aria-required="true">*</span></label>
                                    <input type="password" name="r_password" value="" class="form-control" disabled="disabled"
                                        required>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="tab_view" value="personal" disabled="disabled">

                        <div class="box-footer">
                            <a class="btn bg-info btn-flat btn-md" id="editPersonal"><i class="fa fa-pencil-square-o"></i>
                                Edit</a>
                            <button id="savePersonal" type="submit" class="btn bg-success btn-flat" style="display: none;"
                                disabled="disabled">Save</button>&nbsp;&nbsp;&nbsp;
                            <a class="btn bg-danger btn-flat" id="cancelPersonal" style="display: none;">Cancel</a>

                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout-basic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>