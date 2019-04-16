<?php if(Session::has('flash_notification.message')): ?>
    <div class="laraspace-notify hidden-xs-up" data-driver="<?php echo e(config('laraspace.notification')); ?>" data-notify="<?php echo e(Session::get('flash_notification.level')); ?>" data-message="<?php echo e(Session::get('flash_notification.message')); ?>">
    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="laraspace-notify hidden-xs-up" data-driver="<?php echo e(config('laraspace.notification')); ?>" data-notify="error" data-message="<?php echo e($errors->first()); ?>">
    </div>
<?php endif; ?>