<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">Edit Job</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" id="editJob" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <?php echo method_field('put'); ?>
            <?php echo csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group form-group-bottom">
                    <label>Effective From<span class="required" aria-required="true">*</span></label>

                    <div class="input-group">
                        <input type="text" class="form-control edit_effective_from autocomplete_off" id="datepicker"
                            value="" name="effective_from" data-date-format="yyyy-mm-dd" required>
                        <div class="input-group-addon">
                            <i class="fa fa-calendar-o"></i>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label>Department<span class="required">*</span></label>
                    <select class="form-control edit_department" name="department">
                        <?php if(!$departments->isEmpty()): ?>
                        <option value="">Please Select..</option>
                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <option value="">No Department(s) in record</option>
                        <?php endif; ?>
                    </select>

                </div>


                <div class="form-group">
                    <label>Job Title<span class="required">*</span></label>
                    <select class="form-control edit_title" name="title">
                        <?php if(!$jobTitles->isEmpty()): ?>
                        <option value="">Please Select..</option>
                        <?php $__currentLoopData = $jobTitles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobTitle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($jobTitle->id); ?>"><?php echo e($jobTitle->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <option value="">No job title(s) in record</option>
                        <?php endif; ?>

                    </select>

                </div>

                <div class="form-group">
                    <label>Job Category<span class="required">*</span></label>
                    <select class="form-control edit_category" name="category">
                        <?php if(!$jobCategories->isEmpty()): ?>
                        <option value="">Please Select..</option>
                        <?php $__currentLoopData = $jobCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($jobCategory->id); ?>"><?php echo e($jobCategory->category); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <option value="">No job category(s) in record</option>
                        <?php endif; ?>

                    </select>
                </div>

                <div class="form-group">
                    <label>Employment Status<span class="required">*</span></label>
                    <select class="form-control edit_status" name="employment_status">
                        <?php if(!$employeeStatuses->isEmpty()): ?>
                        <option value="">Please Select..</option>
                        <?php $__currentLoopData = $employeeStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employeeStatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($employeeStatus->id); ?>"><?php echo e($employeeStatus->status); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <option value="">No employee status(s) in record</option>
                        <?php endif; ?>

                    </select>

                </div>

                <div class="form-group">
                    <label>Work Shift<span class="required">*</span></label>
                    <select class="form-control edit_work_shift" name="work_shift">
                        <?php if(!$workShifts->isEmpty()): ?>
                        <option value="">Please Select..</option>
                        <?php $__currentLoopData = $workShifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workShift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($workShift->id); ?>"><?php echo e($workShift->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <option value="">No work shift(s) in record</option>
                        <?php endif; ?>

                    </select>

                </div>
            </div>



            <div class="modal-footer">
                <span class="required">*</span> Required field
                <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-olive btn-flat" id="btn">Save</button>


            </div>
        </form>
    </div>
</div>