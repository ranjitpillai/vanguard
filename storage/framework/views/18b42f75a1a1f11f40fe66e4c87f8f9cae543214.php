<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('page-title'); ?> - <?php echo e(settings('app_name')); ?></title>

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo e(url('assets/img/icons/apple-touch-icon-144x144.png')); ?>" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo e(url('assets/img/icons/apple-touch-icon-152x152.png')); ?>" />
    <link rel="icon" type="image/png" href="<?php echo e(url('assets/img/icons/favicon-32x32.png')); ?>" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?php echo e(url('assets/img/icons/favicon-16x16.png')); ?>" sizes="16x16" />
    <meta name="application-name" content="<?php echo e(settings('app_name')); ?>"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="<?php echo e(url('assets/img/icons/mstile-144x144.png')); ?>" />

    <link media="all" type="text/css" rel="stylesheet" href="<?php echo e(url(mix('assets/css/vendor.css'))); ?>">
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo e(url(mix('assets/css/app.css'))); ?>">
   

    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <?php echo $__env->make('partials.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="container-fluid">
        <div class="row">
            <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="content-page">
                <main role="main" class="px-4">
                    <?php echo $__env->yieldContent('content'); ?>
                </main>
            </div>
        </div>
    </div>

    <script src="<?php echo e(url(mix('assets/js/vendor.js'))); ?>"></script>
    <script src="<?php echo e(url('assets/js/as/app.js')); ?>"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
