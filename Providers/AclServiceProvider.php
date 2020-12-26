<?php

namespace SavageGlobalMarketing\Acl\Providers;

use SavageGlobalMarketing\Foundation\Providers\AuthServiceProvider as ServiceProvider;
use SavageGlobalMarketing\Acl\Console\PermissionCommand;

class AclServiceProvider extends ServiceProvider
{
    protected $moduleName = 'Acl';

    protected string $moduleNameLower = 'acl';

    protected string $modulePath = __DIR__ . '/../';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));

        parent::boot();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->commands([
            PermissionCommand::class,
        ]);

        parent::register();
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
