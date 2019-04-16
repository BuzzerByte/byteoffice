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
    function initialize(){
        $('.autocomplete_off').attr('autocomplete','off');
    }
    
    // $(document.body).on('click','#inp_client_name',function(e){
    //     e.preventDefault();
    //     $(this).attr('autocomplete','off');
    // });
    $('.getEditApplication').click(function () {
        var id = $(this).siblings('input').val();
        $('#form-application').attr('action', '/admin/applications/' + id);
        $.get("/admin/applications/" + id + "/edit", function (data) {
            $('#edit_employee > option').each(function(){
                console.log($(this).val());
                if(data['employee_id'] == $(this).val()){
                    $(this).attr('selected', 'selected');
                }else{
                    $(this).removeAttr('selected');
                }
            });
            
            $('#edit_employee').val(data['employee_id']);
            $('#edit_start').val(data['start']);
            $('#edit_end').val(data['end']);
            $('#edit_leave > option').each(function(){
                console.log($(this).val());
                if(data['type_id'] == $(this).val()){
                    $(this).attr('selected', 'selected');
                }else{
                    $(this).removeAttr('selected');
                }
            });
            $('#edit_apply').val(data['date']);
            $('#edit_status > option').each(function(){
                console.log($(this).val());
                if(data['status'] == $(this).val()){
                    $(this).attr('selected', 'selected');
                }else{
                    $(this).removeAttr('selected');
                }
            });
        });
    });

    $('.getDeleteApplication').click(function () {
        var id = $(this).siblings('input').val();
        $('#form-d-application').attr('action', '/admin/applications/' + id + '/delete');
    });
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">APPLICATION <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo e(route('client.index')); ?>">Applications</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Application List</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-create"> <i
                                class="icon-fa icon-fa-plus"></i> Apply for Leave</button>
                        
                    </div>
                </div>
                <div class="card-body">
                    <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Leave Category</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Reason</th>
                                <th>Application Date</th>
                                <th>Status</th> 
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Leave Category</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Reason</th>
                                <th>Application Date</th>
                                <th>Status</th> 
                            </tr>
                        </tfoot>

                        <?php if(!$applications->isEmpty()): ?>
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
                            <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($application->leaveType($application->id)); ?></td>
                                
                                <td><?php echo e($application->timeFormat($application->start)); ?></td>
                                <td><?php echo e($application->timeFormat($application->end)); ?></td>
                                <td><?php echo e($application->reason); ?></td>
                                <td><?php echo e($application->timeFormat($application->date)); ?></td>
                                <td><?php echo e($application->status); ?></td>
                                
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <?php else: ?>
                        <tbody>
                            <div class="card text-white bg-info text-sm-center">
                                <div class="card-body">
                                    <blockquote class="card-bodyquote">
                                        <p>Hi, you don't have any applications yet.</p>
                                        <footer>Please add your employee application(s) by using button at the top right
                                            corner</footer>
                                    </blockquote>
                                </div>
                            </div>
                        </tbody>
                        <?php endif; ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <?php echo $__env->make('users.applications.create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout-basic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>