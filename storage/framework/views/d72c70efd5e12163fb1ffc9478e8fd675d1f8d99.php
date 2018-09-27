<?php $__env->startSection('title', 'Page Not Found'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="mt-5">Oops, 404!</h1>
    <p class="mt-3">
        The page you requested could not be found! <br>
        Use your browser's <strong>Back</strong> button to navigate to the page
        you have previously come from.
    </p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>