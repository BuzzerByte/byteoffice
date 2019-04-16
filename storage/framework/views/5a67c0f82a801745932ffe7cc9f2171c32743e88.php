<?php $__env->startSection('scripts'); ?>
    <script src="/assets/admin/js/sessions/login.js"></script>
    <script>
        initialize();
        function initialize(){
            $('.autocomplete').attr('autocomplete','off');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.sessions.partials.login-form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout-login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>