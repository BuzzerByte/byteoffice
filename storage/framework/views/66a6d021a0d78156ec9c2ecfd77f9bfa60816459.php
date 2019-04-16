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
<body class="layout-default">
    <?php echo $__env->make('admin.layouts.partials.laraspace-notifs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div id="app" class="site-wrapper">
        <?php echo $__env->make('admin.layouts.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="mobile-menu-overlay"></div>
        <?php echo $__env->make('admin.layouts.partials.sidebar',['type' => 'default'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->make('admin.layouts.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
    </div>

    <script src="<?php echo e(mix('/assets/admin/js/core/plugins.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/admin/js/demo/skintools.js')); ?>"></script>
    <script src="<?php echo e(mix('/assets/admin/js/core/app.js')); ?>"></script>
    <script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // getSkin();
        // function getSkin(){
        //     $.get('/admin/users/getSkin',function(data){
        //         $(document.body).attr('class','layout-default skin-'+data);
                
        //         $('.skin-tools-content .skin-radio').each(function(){
        //             // console.log($(this).attr('data-skin'));
        //             if($(this).attr('data-skin') == data){
        //                 $(this).attr('class','skin-radio active');
        //             }else{
        //                 $(this).attr('class','skin-radio');
        //             }
        //         });
        //     });
        // }
         
        // $(document.body).on('click','.skin-radio',function(){
        //     var skin = $(this).attr('data-skin');
        //     $.post( "/admin/users/storeSkin", { bodySkin: skin })
        //     .done(function( data ) {
        //         console.log(data);
        //     });
        // });
    });
    </script>   
    <script src="<?php echo e(mix('/assets/admin/js/core/app.js')); ?>"></script>
    <?php echo $__env->yieldContent('scripts'); ?>

    
</body>
</html>
