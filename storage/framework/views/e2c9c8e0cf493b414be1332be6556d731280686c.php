<?php $__env->startSection('title', 'Whoops, something went wrong...'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="mt-5">Something went wrong! :(</h1>
    <p class="mt-3 lead">
        Something went wrong and we could not proceed... <br> Please try again or contact website owner.
    </p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>