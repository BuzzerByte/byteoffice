<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="/assets/admin/js/pages/notifications.js"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script>
    initialize();
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

    function initialize() {
        $('.autocomplete_off').attr('autocomplete', 'off');
    }
    var temp_arr = new Array();
    $('.edit').click(function () {
        var id = $(this).siblings('input').val();
        $('#editRoleForm').attr('action', '/admin/roles/' + id);
        $.get("/admin/roles/" + id + "/edit", function (data) {
            $('.edit_name').val(data['role']['name']);
            $('.edit_display_name').val(data['role']['display_name']);
            $('.edit_description').val(data['role']['description']);
            $.each(data['permission'],function(idx, value){
                temp_arr.push(value['id'].toString());
            });
            
            $(".edit_rPermission").each(function(idx, li){
                if($.inArray(li['value'],temp_arr) != '-1'){
                    $(this).prop('checked',true);
                }else{
                    $(this).prop('checked',false);
                }
            });
        });
        temp_arr = [];
    });

    $('.delete').click(function () {
        var id = $(this).siblings('input').val();
        $('#form-d-role').attr('action', '/admin/roles/' + id);
    });

    $(document.body).on('change','#parent_present',function(){
        if(this.checked){
            $('.child_present').prop('checked',true);
        }else{
            $('.child_present').prop('checked',false);
        }
    });
    </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">ROLE <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo e(route('vendor.index')); ?>">Roles</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <?php if (\Entrust::hasRole('admin')) : ?>
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Role List</h6>
                    </div>
                    <div class="actions">
                        
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-create"> <i
                                class="icon-fa icon-fa-plus"></i> Add new role</button>
                        
                    </div>
                </div>
                <div class="card-body">
                    
                    <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Assigned Permission(s)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Assigned Permission(s)</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>

                        <?php if(!$roles->isEmpty()): ?>
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
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($role->name); ?></td>
                                <td><?php echo e($role->display_name); ?></td>
                                <td><?php echo e($role->description); ?></td>
                                <td>
                                    <?php if($role->permissions()->get() == []): ?>
                                        No permission assigned
                                    <?php else: ?>
                                    <?php $__currentLoopData = $role->permissions()->select('display_name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <button class="btn btn-xs btn-secondary btn-rounded" disabled><?php echo e($perm->display_name); ?></button>    
                                    
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <input type="hidden" value="<?php echo e($role->id); ?>">
                                        
                                        <button type="button" class="btn btn-icon btn-outline-info edit"
                                            data-target="#modal-edit" data-placement="top" data-toggle="modal"><i
                                                class="icon-fa icon-fa-pencil"></i></button>
                                        
                                        
                                                <button type="button" class="btn btn-icon btn-outline-danger delete" data-target="#modal-delete" data-placement="top" data-toggle="modal"><i class="icon-fa icon-fa-trash"></i></button>
                                        
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
                                        <p>Hi, you don't have any role yet</p>
                                        <footer>Please add/import your vendor(s) by using button at the top right
                                            corner</footer>
                                    </blockquote>
                                </div>
                            </div>

                        </tbody>
                        <?php endif; ?>
                        </tbody>
                    </table>
                   
                </div>
                <?php endif; // Entrust::hasRole ?>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <?php echo $__env->make('admin.roles.create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <?php echo $__env->make('admin.roles.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <?php echo $__env->make('admin.roles.delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout-basic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>