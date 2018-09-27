<?php if($socialProviders): ?>
    <?php $colSize = 12 / count($socialProviders); ?>

    <div class="row pb-3 pt-2">
        <?php if(in_array('facebook', $socialProviders)): ?>
            <div class="col-<?php echo e($colSize); ?> d-flex align-items-center justify-content-center">
                <a href="<?php echo e(url('auth/facebook/login')); ?>" class="btn-facebook">
                    <i class="fab fa-facebook fa-2x"></i>
                </a>
            </div>
        <?php endif; ?>

        <?php if(in_array('twitter', $socialProviders)): ?>
            <div class="col-<?php echo e($colSize); ?> d-flex align-items-center justify-content-center">
                <a href="<?php echo e(url('auth/twitter/login')); ?>" class="btn-twitter">
                    <i class="fab fa-twitter fa-2x"></i>
                </a>
            </div>
        <?php endif; ?>

        <?php if(in_array('google', $socialProviders)): ?>
            <div class="col-<?php echo e($colSize); ?> d-flex align-items-center justify-content-center">
                <a href="<?php echo e(url('auth/google/login')); ?>" class="btn-google">
                    <i class="fab fa-google-plus-square fa-2x"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>

<?php endif; ?>