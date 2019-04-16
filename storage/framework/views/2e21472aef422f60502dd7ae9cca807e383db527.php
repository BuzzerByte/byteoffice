
<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Add New Job</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form action="<?php echo e(route('jobHistories.store')); ?>" id="newJob" enctype="multipart/form-data" method="post"
            accept-charset="utf-8">
            <?php echo csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group form-group-bottom">
                    <label>Effective From<span class="required" aria-required="true">*</span></label>

                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="icon-fa icon-fa-calendar"></i>
                            </span>
                        </div>
                        <input type="text" name="effective_from" class="form-control ls-datepicker autocomplete_off" data-date-format="yyyy-mm-dd" value="" required>
                    </div>
                </div>


                <div class="form-group">
                    <label>Department<span class="required">*</span></label>
                    <select class="form-control autocomplete_off ls-select2" style="width:100%" name="department" required>
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
                    <select class="form-control autocomplete_off ls-select2" style="width:100%" name="title" required>
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
                    <select class="form-control autocomplete_off ls-select2" style="width:100%" name="category" required>
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
                    <select class="form-control autocomplete_off ls-select2" style="width:100%" name="employment_status" required>
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
                    <select class="form-control autocomplete_off ls-select2" style="width:100%" name="work_shift" required>
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
                <input type="hidden" name="employee_id" value="<?php echo e($employee->id); ?>">

                <span class="required">*</span> Required field



                <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-olive btn-flat" id="btn">Save</button>


            </div>
        </form>
    </div>
</div>