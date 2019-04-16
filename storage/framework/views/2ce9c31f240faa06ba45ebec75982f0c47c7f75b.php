<!DOCTYPE html>
<html>
<head>
    <title>Laraspace - Laravel Admin</title>
    <link href="<?php echo e(mix('/assets/admin/css/laraspace.css')); ?>" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php echo $__env->make('admin.layouts.partials.favicons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body class="login-page login-1">
<div id="app" class="login-wrapper">
    <div class="login-box">
        <?php echo $__env->make('admin.layouts.partials.laraspace-notifs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="logo-main">
            <a href="/"><img src="/assets/admin/img/logo-large.png" alt="Laraspace Logo"></a>
        </div>
        <?php echo $__env->yieldContent('content'); ?>
        <div class="page-copyright">
            <p>Powered by <a href="#" target="_blank">BuzzerByte</a></p>
            <p>BuzzerByte © <?php echo e(date('Y')); ?></p>
        </div>
    </div>
</div>
<script src="<?php echo e(mix('/assets/admin/js/core/plugins.js')); ?>"></script>
<script src="<?php echo e(mix('/assets/admin/js/core/app.js')); ?>"></script>
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
