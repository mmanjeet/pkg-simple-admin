<?php

namespace Cyberzet\SingleAdmin;

use Illuminate\Database\Seeder;
use Illuminate\Support\ServiceProvider;
use Cyberzet\SingleAdmin\Database\Seeders\UserSeeder;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Summary of register
     * @return void
     */
    public function register()
    {
    }
    /**
     * Summary of boot
     * @return void
     */
    public function boot()
    {
        $this->loadMiddleware(); // load middleware
        $this->loadRoutes(); //load routes 
        $this->loadConfig(); // load Config
        $this->loadMigrations(); // load migrations
        $this->loadAssets(); // load assets
        $this->loadViews(); // load views 
        $this->loadSeeders();
    }
    /**
     * Summary of loadViews
     * @return void
     */
    private function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'single-admin');
    }
    /**
     * Summary of loadRoutes
     * @return void
     */
    private function loadRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }
    /**
     * Summary of loadAssets
     * @return void
     */
    private function loadAssets()
    {
        $this->publishes([
            __DIR__ . '/public-assets/admin' => public_path('cyberzet/single-admin'),
        ], 'public');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/cyberzet/single-admin'),
        ]);
    }


    /**
     * Load middleware for the package.
     *
     * @return void
     */
    protected function loadMiddleware()
    {
        $router = $this->app['router'];

        // Register your middleware here
        $router->aliasMiddleware('role', \Cyberzet\SingleAdmin\Http\Middleware\Role::class);
    }
    /**
     * Summary of loadMigrations
     * @return void
     */
    private function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }
    /**
     * Summary of loadSeeders
     * @return void
     */

    private function loadConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/singleadmin.php',
            'singleadmin'
        );
        $this->publishes([
            __DIR__ . '/config/singleadmin.php' => config_path('singleadmin.php'),
        ]);
    }
    protected function loadSeeders()
    {
        // Register your seeders here
        // (new Seeder())->call(UserSeeder::class);
    }
}
