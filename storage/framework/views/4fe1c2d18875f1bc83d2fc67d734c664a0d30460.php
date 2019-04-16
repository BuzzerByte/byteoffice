<div class="card">
    <div class="card-header bg-info">
        <div class="caption">
            <h6><?php echo e($employee->l_name); ?></h6>
            
        </div>
    </div>
    <div class="card-body">
        <div class="profile-userpic">
            <?php if($employee->photo != NULL): ?>
            <img src="/employeesPhoto/<?php echo e($employee->photo); ?>" alt="<?php echo e($employee->photo); ?>" style="max-width:200px;max-height:200px">
            <?php else: ?>
            <img src="<?php echo e(asset('/assets/admin/img/avatars/user.png')); ?>" alt="Avatar" style="max-width:200px;max-height:200px"></a>
            <?php endif; ?>
            
        </div>
        <?php if($employee->terminate_status == false): ?>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                <b><?php echo e($employee->f_name); ?> <?php echo e($employee->l_name); ?></b></div>
            <div class="profile-usertitle-job">
                <b>Employee Id : <?php echo e($employee->id_number); ?> </b></div>
        </div>
        <br>
        <div class="profile-userbuttons">
            <?php if (\Entrust::can('temination-create')) : ?>
            <a data-target="#addTerminationModal" data-placement="top" data-toggle="modal" href="#" class="btn btn-danger btn-sm">
                Termination </a>
            <?php endif; // Entrust::can ?>
        </div>
        <?php else: ?>

        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                <?php echo e($employee->f_name); ?> <?php echo e($employee->l_name); ?> </div>
            <div class="profile-usertitle-job">
                Employee Id : <strong style="color: RED">Terminated</strong>
            </div>

        </div>
        <br>
        <div class="profile-userbuttons">
            <form action="<?php echo e(route('employeeTerminations.unterminate',\buzzeroffice\EmployeeTermination::where('employee_id',$employee->id)->first()->id)); ?>" method="post"
                accept-charset="utf-8" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <button type="submit" onclick="return confirm('Are you sure to Re Join Employment ?');" class="btn bg-navy btn-sm">Re
                    Join Employment </button>
            </form>
        </div>
        <br>
        <a href="<?php echo e(route('employeeTerminations.show',\buzzeroffice\EmployeeTermination::where('employee_id',$employee->id)->first()->id)); ?>"
            class="btn btn-block btn-flat bg-maroon text-left">Termination Note</a>
        <?php endif; ?>
    </div>
    <div class="card-body">
        
        
        <div class="tabs tabs-simple tabs-vertical">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                        <a href="<?php echo e(route('users.show',$employee->id)); ?>">Personal
                                Details</a>
                </li>
                <li class="nav-item">
                        <a href="<?php echo e(route('users.contactDetails',$employee->id)); ?>">Contact
                                Details</a>
                </li>
                <li class="nav-item">
                        <a href="<?php echo e(route('users.employeeDependents',$employee->id)); ?>">Dependents</a>
                </li>
                <li class="nav-item">
                        <a href="<?php echo e(route('users.employeeCommencements',$employee->id)); ?>">Job</a>
                </li>
                <li class="nav-item">
                        <a href="<?php echo e(route('users.employeeSalaries',$employee->id)); ?>">Salary</a>
                </li>
                <li class="nav-item">
                        <a href="<?php echo e(route('users.reportTo',$employee->id)); ?>">Report-to</a>
                </li>
                <li class="nav-item">
                        <a href="<?php echo e(route('users.directDeposit',$employee->id)); ?>">Direct
                                Deposit</a>
                </li>
                <li class="nav-item">
                        <a href="<?php echo e(route('users.employeeLogin',$employee->id)); ?>">Login</a>
                </li>
            </ul>
        </div>
    </div>
</div>
