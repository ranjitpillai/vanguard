<?php

namespace Vanguard\Providers;

use Carbon\Carbon;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Repositories\Activity\EloquentActivity;
use Vanguard\Repositories\Country\CountryRepository;
use Vanguard\Repositories\Country\EloquentCountry;
use Vanguard\Repositories\Permission\EloquentPermission;
use Vanguard\Repositories\Permission\PermissionRepository;
use Vanguard\Repositories\Role\EloquentRole;
use Vanguard\Repositories\Role\RoleRepository;
use Vanguard\Repositories\Session\DbSession;
use Vanguard\Repositories\Session\SessionRepository;
use Vanguard\Repositories\User\EloquentUser;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Repositories\Device\DeviceRepository;
use Vanguard\Repositories\Device\EloquentDevice;
use Vanguard\Repositories\Company\CompanyRepository;
use Vanguard\Repositories\Company\EloquentCompany;
use Vanguard\Repositories\Transaction\EloquentTransaction;
use Vanguard\Repositories\Transaction\TransactionRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
        config(['app.name' => settings('app_name')]);
        \Illuminate\Database\Schema\Builder::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
		$this->app->singleton(DeviceRepository::class, EloquentDevice::class);
        $this->app->singleton(ActivityRepository::class, EloquentActivity::class);
        $this->app->singleton(RoleRepository::class, EloquentRole::class);
        $this->app->singleton(PermissionRepository::class, EloquentPermission::class);
        $this->app->singleton(SessionRepository::class, DbSession::class);
        $this->app->singleton(CountryRepository::class, EloquentCountry::class);
        $this->app->singleton(CompanyRepository::class, EloquentCompany::class);
        $this->app->singleton(TransactionRepository::class, EloquentTransaction::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
