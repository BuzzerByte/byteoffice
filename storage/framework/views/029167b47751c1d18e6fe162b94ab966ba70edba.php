<?php if(Session::has('flash_notification')): ?>
    <?php if(Session::has('flash_notification.message')): ?>
    <div class="laraspace-notify hidden-xs-up" data-driver="<?php echo e(config('laraspace.notification')); ?>" data-notify="<?php echo e(Session::get("flash_notification.level")); ?>" data-message="<?php echo e(Session::get("flash_notification.message")); ?>">
    </div>
    <?php else: ?>
        <?php $__currentLoopData = Session::get("flash_notification"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flash_notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="laraspace-notify hidden-xs-up" data-driver="<?php echo e(config('laraspace.notification')); ?>" data-notify="<?php echo e($flash_notification->level); ?>" data-message="<?php echo e($flash_notification->message); ?>">
    </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="laraspace-notify hidden-xs-up" data-driver="<?php echo e(config('laraspace.notification')); ?>" data-notify="error" data-message="<?php echo e($errors->first()); ?>">
    </div>
<?php endif; ?>