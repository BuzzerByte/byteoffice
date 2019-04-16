<!DOCTYPE html>
<html>
<head>
    <title>buzzeroffice - buzzeroffice Admin</title>
    <script src="<?php echo e(asset('/assets/admin/js/core/pace.js')); ?>"></script>
    <link href="<?php echo e(mix('/assets/admin/css/laraspace.css')); ?>" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?php echo $__env->make('admin.layouts.partials.favicons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body id="app" class="page-error-404">
    <header class="site-header">
        <a href="#" class="brand-main">
            <img src="<?php echo e(asset('/assets/admin/img/logo-desk.png')); ?>" id="logo-desk" alt="buzzeroffice Logo" class="d-none d-md-inline ">
            <img src="<?php echo e(asset('/assets/admin/img/logo-mobile.png')); ?>" id="logo-mobile" alt="buzzeroffice Logo" class="d-md-none">
        </a>
        <a href="#" class="nav-toggle">
            <div class="hamburger hamburger--htla">
                <span>toggle menu</span>
            </div>
        </a>
    </header>
    <div class="error-box">
        <div class="row">
            <div class="col-sm-12 text-sm-center">
                <h1>404</h1>
                <h5>Whoops! You got Lost!</h5>
                <a class="btn btn-lg bg-yellow" href="/"> <i class="icon-fa icon-fa-arrow-left"></i> Go Back</a>
            </div>
        </div>
    </div>
    <script src="<?php echo e(mix('/assets/admin/js/core/plugins.js')); ?>"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
