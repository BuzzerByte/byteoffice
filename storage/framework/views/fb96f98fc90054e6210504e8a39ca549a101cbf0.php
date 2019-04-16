<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="post" id="editRoleForm" class="form-horizontal">
            <?php echo method_field('put'); ?>
            <?php echo csrf_field(); ?>
            <div class="modal-body form">


                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Role</label>
                        <div class="col-md-9">
                            <input name="name" class="form-control edit_name autocomplete_off" type="text"
                                required>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Display Name</label>
                        <div class="col-md-9">
                            <textarea name="display_name" class="form-control edit_display_name autocomplete_off"></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Description</label>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control edit_description autocomplete_off"></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>

    

                    <div class="form-group">
                        <label class="control-label col-md-12">Assigned Permission(s)</label>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4 form-check form-check-inline">
                                    <input type="checkbox" id="parent_present">
                                    <label for="inlineCheckbox" class="form-check-label">Select All</label>
                                </div>
                            </div>
                            
                            
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4 form-check form-check-inline">
                                    <input type="checkbox" id="inlineCheckbox<?php echo e($index); ?>" name="permission[]"
                                    value="<?php echo e($permission->id); ?>" class="form-check-input edit_rPermission child_present"> 
                                    <label for="inlineCheckbox<?php echo e($index); ?>" class="form-check-label"><?php echo e($permission->display_name); ?></label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>