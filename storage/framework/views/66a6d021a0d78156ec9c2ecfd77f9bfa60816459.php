<!DOCTYPE html>
<html>
<head>
    <title>Buzzer Office</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
    <script src="<?php echo e(asset('/assets/admin/js/core/pace.js')); ?>"></script>
    <link href="<?php echo e(mix('/assets/admin/css/laraspace.css')); ?>" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php echo $__env->make('admin.layouts.partials.favicons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body class="layout-default skin-default">
    <?php echo $__env->make('admin.layouts.partials.laraspace-notifs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div id="app" class="site-wrapper">
        <?php echo $__env->make('admin.layouts.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="mobile-menu-overlay"></div>
        <?php echo $__env->make('admin.layouts.partials.sidebar',['type' => 'default'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->make('admin.layouts.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php if(config('laraspace.skintools')): ?>
            <?php echo $__env->make('admin.layouts.partials.skintools', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    </div>

    <script src="<?php echo e(mix('/assets/admin/js/core/plugins.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/admin/js/demo/skintools.js')); ?>"></script>
    <script src="<?php echo e(mix('/assets/admin/js/core/app.js')); ?>"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
