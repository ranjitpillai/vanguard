<nav class="navbar fixed-top align-items-start navbar-expand-lg pl-0 pr-0 py-0" >

    <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand mr-0" href="<?php echo e(url('/')); ?>">
            <img src="<?php echo e(url('assets/img/vanguard-logo.png')); ?>" height="35" alt="<?php echo e(settings('app_name')); ?>">
        </a>
    </div>

    <div>
        <button class="navbar-toggler" type="button" id="sidebar-toggle">
            <i class="fas fa-align-right text-muted"></i>
        </button>

        <button class="navbar-toggler mr-3"
                type="button"
                data-toggle="collapse"
                data-target="#top-navigation"
                aria-controls="top-navigation"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <i class="fas fa-bars text-muted"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="top-navigation">
        <div class="row ml-2">
            <div class="col-lg-12 d-flex align-items-center py-3">
                <h4 class="page-header mb-0">
                    <?php echo $__env->yieldContent('page-heading'); ?>
                </h4>

                <ol class="breadcrumb mb-0 font-weight-light">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(url('/')); ?>" class="text-muted">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>

                    <?php echo $__env->yieldContent('breadcrumbs'); ?>
                </ol>
            </div>
        </div>

        <ul class="navbar-nav ml-auto pr-3">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"
                   href="#"
                   id="navbarDropdown"
                   role="button"
                   data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false">
                    <img src="<?php echo e(auth()->user()->present()->avatar); ?>"
                         width="50"
                         height="50"
                         class="rounded-circle img-thumbnail img-responsive">
                </a>
                <div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo e(route('profile')); ?>">
                        <i class="fas fa-user text-muted mr-2"></i>
                        <?php echo app('translator')->getFromJson('app.my_profile'); ?>
                    </a>
                    <?php if(config('session.driver') == 'database'): ?>
                        <a href="<?php echo e(route('profile.sessions')); ?>" class="dropdown-item">
                            <i class="fas fa-list text-muted mr-2"></i>
                            <?php echo app('translator')->getFromJson('app.active_sessions'); ?>
                        </a>
                    <?php endif; ?>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="<?php echo e(route('auth.logout')); ?>">
                        <i class="fas fa-sign-out-alt text-muted mr-2"></i>
                        <?php echo app('translator')->getFromJson('app.logout'); ?>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>