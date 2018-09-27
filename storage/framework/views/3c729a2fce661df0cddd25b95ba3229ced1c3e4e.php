<nav class="col-md-2 sidebar">
    <div class="user-box text-center pt-5 pb-3">
        <div class="user-img">
            <img src="<?php echo e(auth()->user()->present()->avatar); ?>"
                 width="90"
                 height="90"
                 alt="user-img"
                 class="rounded-circle img-thumbnail img-responsive">
        </div>
        <h5 class="my-3">
            <a href="<?php echo e(route('profile')); ?>"><?php echo e(auth()->user()->present()->nameOrEmail); ?></a>
        </h5>

        <ul class="list-inline mb-2">
            <li class="list-inline-item">
                <a href="<?php echo e(route('profile')); ?>" title="<?php echo app('translator')->getFromJson('app.my_profile'); ?>">
                    <i class="fas fa-cog"></i>
                </a>
            </li>

            <li class="list-inline-item">
                <a href="<?php echo e(route('auth.logout')); ?>" class="text-custom" title="<?php echo app('translator')->getFromJson('app.logout'); ?>">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('/') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
                    <i class="fas fa-home"></i>
                    <span><?php echo app('translator')->getFromJson('app.dashboard'); ?></span>
                </a>
            </li>

            <?php if (\Auth::user()->hasPermission('users.manage')) : ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('user*') ? 'active' : ''); ?>" href="<?php echo e(route('user.list')); ?>">
                    <i class="fas fa-users"></i>
                    <span><?php echo app('translator')->getFromJson('app.users'); ?></span>
                </a>
            </li>
			 <li class="nav-item">
				<a href="<?php echo e(route('active-users')); ?>" class="nav-link <?php echo e(Request::is('active-users') ? 'active' : ''); ?>">
					<i class="fas fa-users"></i>
					Active Users
				</a>
			</li>
            <?php endif; ?>
			
			<?php if (\Auth::user()->hasPermission('manage.companies')) : ?>
                <li class="nav-item">
					<a class="nav-link <?php echo e(Request::is('company*') ? 'active' : ''); ?>" href="<?php echo e(route('company.index')); ?>">
                    
                        <i class="fa fa-building fa-fw"></i><span> <?php echo app('translator')->getFromJson('app.companies'); ?> </span>
                    </a>
                </li>
            <?php endif; ?>
			<?php if (\Auth::user()->hasPermission('devices')) : ?>
				<li class="nav-item">
					<a class="nav-link <?php echo e(Request::is('device*') ? 'active' : ''); ?>" href="<?php echo e(route('device.index')); ?>">
                        <i class="fa fa-mobile fa-fw"></i> <?php echo app('translator')->getFromJson('app.devices'); ?>
                    </a>
                </li>
            <?php endif; ?>
			<?php if (\Auth::user()->hasPermission('Transactions')) : ?>
				<li class="nav-item">
					<a class="nav-link <?php echo e(Request::is('transaction*') ? 'active' : ''); ?>" href="<?php echo e(route('transaction.index')); ?>">      
                        <i class="fa fa-mobile fa-fw"></i> <?php echo app('translator')->getFromJson('app.transactions'); ?>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('users.activity')) : ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('activity*') ? 'active' : ''); ?>" href="<?php echo e(route('activity.index')); ?>">
                    <i class="fas fa-server"></i>
                    <span><?php echo app('translator')->getFromJson('app.activity_log'); ?></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission(['roles.manage', 'permissions.manage'])) : ?>
            <li class="nav-item">
                <a href="#roles-dropdown"
                   class="nav-link"
                   data-toggle="collapse"
                   aria-expanded="<?php echo e(Request::is('role*') || Request::is('permission*') ? 'true' : 'false'); ?>">
                    <i class="fas fa-users-cog"></i>
                    <span><?php echo app('translator')->getFromJson('app.roles_and_permissions'); ?></span>
                </a>
                <ul class="<?php echo e(Request::is('role*') || Request::is('permission*') ? '' : 'collapse'); ?> list-unstyled sub-menu" id="roles-dropdown">
                    <?php if (\Auth::user()->hasPermission('roles.manage')) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('role*') ? 'active' : ''); ?>"
                           href="<?php echo e(route('role.index')); ?>"><?php echo app('translator')->getFromJson('app.roles'); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (\Auth::user()->hasPermission('permissions.manage')) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('permission*') ? 'active' : ''); ?>"
                           href="<?php echo e(route('permission.index')); ?>"><?php echo app('translator')->getFromJson('app.permissions'); ?></a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission(['settings.general', 'settings.auth', 'settings.notifications'], false)) : ?>
            <li class="nav-item">
                <a href="#settings-dropdown"
                   class="nav-link"
                   data-toggle="collapse"
                   aria-expanded="<?php echo e(Request::is('settings*') ? 'true' : 'false'); ?>">
                    <i class="fas fa-cogs"></i>
                    <span><?php echo app('translator')->getFromJson('app.settings'); ?></span>
                </a>
                <ul class="<?php echo e(Request::is('settings*') ? '' : 'collapse'); ?> list-unstyled sub-menu"
                    id="settings-dropdown">

                    <?php if (\Auth::user()->hasPermission('settings.general')) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('settings') ? 'active' : ''); ?>"
                           href="<?php echo e(route('settings.general')); ?>">
                            <?php echo app('translator')->getFromJson('app.general'); ?>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if (\Auth::user()->hasPermission('settings.auth')) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('settings/auth*') ? 'active' : ''); ?>"
                           href="<?php echo e(route('settings.auth')); ?>"><?php echo app('translator')->getFromJson('app.auth_and_registration'); ?></a>
                    </li>
                    <?php endif; ?>

                    <?php if (\Auth::user()->hasPermission('settings.notifications')) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('settings/notifications*') ? 'active' : ''); ?>"
                           href="<?php echo e(route('settings.notifications')); ?>"><?php echo app('translator')->getFromJson('app.notifications'); ?></a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

