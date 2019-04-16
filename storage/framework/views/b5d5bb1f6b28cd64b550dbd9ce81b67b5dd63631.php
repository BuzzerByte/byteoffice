<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('/assets/admin/js/jquery.PrintArea.js')); ?>"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<script>
    $(function () {
        init();

        function init() {
            $('.autocomplete_off').attr('autocomplete', 'off');
        }
    })
    $('.delete').click(function () {
        var id = $(this).siblings('.employee_id').attr('id');
        $('#form-d-employee').attr('action', '/admin/user/' + id + '/delete');
    });
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Category <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo e(route('users.index')); ?>">Employee List</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Employee List</h6>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <?php if (\Entrust::can('employee-list')) : ?>
                    <table id="responsive-datatable" class="table table-bordered table-striped">


                        <thead>
                            <tr>
                                <th>Employee
                                    Id</th>
                                <th>Employee
                                    Name</th>
                                <th>Department</th>
                                <th>Job
                                    Title</th>
                                <th>Employment
                                    Status</th>
                                <th>Shift</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <?php if(!$employees->isEmpty()): ?>
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
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr role="row" class="">
                                <td><?php echo e($employee->id_number); ?></td>
                                <td><?php echo e($employee->f_name); ?> <?php echo e($employee->l_name); ?></td>
                                <?php if(\buzzeroffice\JobHistory::where('employee_id',$employee->id)->exists()): ?>
                                <td><?php echo e(\buzzeroffice\Department::where('id',\buzzeroffice\JobHistory::where('employee_id',$employee->id)->first()->department_id)->first()->name); ?></td>
                                <td><?php echo e(\buzzeroffice\JobTitle::where('id',\buzzeroffice\JobHistory::where('employee_id',$employee->id)->first()->title_id)->first()->title); ?></td>
                                <td><?php echo e(\buzzeroffice\EmployeeStatus::where('id',\buzzeroffice\JobHistory::where('employee_id',$employee->id)->first()->status_id)->first()->status); ?></td>
                                <td><?php echo e(\buzzeroffice\WorkShift::where('id',\buzzeroffice\JobHistory::where('employee_id',$employee->id)->first()->shift_id)->first()->name); ?></td>
                                <?php else: ?>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>

                                <?php endif; ?>
                                <td>

                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <input type="hidden" class="employee_id" id="<?php echo e($employee->id); ?>">
                                        
                                        <button type="button" class="btn btn-icon btn-outline-info" onclick="location.href='<?php echo e(route('users.show',$employee->id)); ?>'"><i
                                                class="icon-fa icon-fa-search"></i></button>
                                        <?php if (\Entrust::can('employee-delete')) : ?>
                                        <button type="button" class="btn btn-icon btn-outline-danger delete" href="#" data-toggle="modal" data-target="#modal-delete"><i class="icon-fa icon-fa-trash"></i></button>
                                        <?php endif; // Entrust::can ?>
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
                                        <p>Hi, you don't have any employee yet</p>
                                    </blockquote>
                                </div>
                            </div>
                        </tbody>
                        <?php endif; ?>

                    </table>
                    <?php endif; // Entrust::can ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <?php echo $__env->make('admin.employees.delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout-basic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>