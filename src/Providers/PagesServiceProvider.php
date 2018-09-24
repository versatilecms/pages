<?php

namespace Versatile\Pages\Providers;

use Versatile\Pages\Commands;
use Versatile\Pages\Blocks\Blocks;
use Versatile\Pages\Facades\Blocks as BlocksFacade;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class PagesServiceProvider extends ServiceProvider
{
    /**
     * Our root directory for this package to make traversal easier
     */
    protected $packagePath = __DIR__ . '/../../';

    /**
     * Bootstrap the application services
     *
     * @return void
     */
    public function boot()
    {
        $this->strapViews();
        $this->strapMigrations();
        $this->strapCommands();
        $this->strapTranslations();
        $this->strapRoutes();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Blocks', BlocksFacade::class);

        $this->app->singleton('blocks', function () {
            return new Blocks();
        });

        // Merge our Scout config over
        $this->mergeConfigFrom($this->packagePath . 'config/scout.php', 'scout.tntsearch.searchableModels');

        // $this->mergeConfigFrom($this->packagePath . 'config/page-blocks.php', 'page-blocks');

        $this->loadHelpers();

        $this->registerPageBlocks();
    }

    /**
     * Bootstrap our Routes
     */
    protected function strapRoutes()
    {
        // Pull default web routes
        $this->loadRoutesFrom(base_path('/routes/web.php'));

        // Then add our package routes
        $this->loadRoutesFrom($this->packagePath . 'routes/web.php');
    }

    /**
     * Bootstrap our Views
     */
    protected function strapViews()
    {
        // Load views
        $this->loadViewsFrom($this->packagePath . 'resources/views', 'versatile-pages');
        $this->loadViewsFrom($this->packagePath . 'resources/views/vendor/versatile', 'versatile');
    }

    /**
     * Bootstrap our Migrations
     */
    protected function strapMigrations()
    {
        // Load migrations
        $this->loadMigrationsFrom($this->packagePath . 'database/migrations');

        // Locate our factories for testing
        $this->app->make('Illuminate\Database\Eloquent\Factory')->load(
            $this->packagePath . 'database/factories'
        );
    }

    protected function strapTranslations()
    {
        $this->loadTranslationsFrom($this->packagePath . 'resources/lang', 'versatile-pages');
    }

    /**
     * Bootstrap our Commands/Schedules
     */
    protected function strapCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\InstallCommand::class
            ]);
        }
    }

    /**
     * Load helpers.
     */
    protected function loadHelpers()
    {
        foreach (glob(__DIR__.'/../Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

    protected function registerPageBlocks()
    {
        $blocks = [
            'Versatile\\Pages\\Blocks\\Handlers\\CalloutHandler',
            'Versatile\\Pages\\Blocks\\Handlers\\CardsOneColumnHandler',
            'Versatile\\Pages\\Blocks\\Handlers\\CardsThreeColumnsHandler',
            'Versatile\\Pages\\Blocks\\Handlers\\CardsTwoColumnsHandler',
            'Versatile\\Pages\\Blocks\\Handlers\\ContentFourColumnsHandler',
            'Versatile\\Pages\\Blocks\\Handlers\\ContentOneColumnHandler',
            'Versatile\\Pages\\Blocks\\Handlers\\ContentThreeColumnsHandler',
            'Versatile\\Pages\\Blocks\\Handlers\\ContentTwoColumnsHandler',
            'Versatile\\Pages\\Blocks\\Handlers\\ImageRowHandler',
        ];

        foreach ($blocks as $block) {
            BlocksFacade::add($block);
        }
    }
}
