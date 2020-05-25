<?php
namespace Newelement\Faqs;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

use Newelement\Faqs\Facades\Faqs as FaqsFacade;

class FaqsServiceProvider extends ServiceProvider
{

    public function register()
    {

        $loader = AliasLoader::getInstance();
        $loader->alias('Faqs', FaqsFacade::class);
        $this->app->singleton('faqs', function () {
            return new Faqs();
        });

        $this->loadHelpers();
        $this->registerConfigs();

        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();
            $this->registerConsoleCommands();
        }
    }

    public function boot(Router $router, Dispatcher $event)
    {

        $viewsDirectory = __DIR__.'/../resources/views/public';
        $adminViewsDirectory = __DIR__.'/../resources/views/cms';
        $publishAssetsDirectory = __DIR__.'/../publishable/assets';

        // Admin views
        $this->loadViewsFrom($adminViewsDirectory, 'faqs');
        // Public views
        $this->loadViewsFrom($viewsDirectory, 'faqs');

        $this->publishes([$viewsDirectory => base_path('resources/views/vendor/faqs')], 'views');
        $this->publishes([ $publishAssetsDirectory => public_path('vendor/newelement/faqs') ], 'public');
        $this->loadMigrationsFrom(realpath(__DIR__.'/../migrations'));

        // Register routes
        // PUBLIC
        $router->group([
            'namespace' => 'Newelement\Faqs\Http\Controllers',
            'as' => 'faqs.',
            'middleware' => ['web']
        ], function ($router) {
            require __DIR__.'/../routes/web.php';
        });

        // ADMIN
        $router->group([
            'namespace' => 'Newelement\Faqs\Http\Controllers\Admin',
            'prefix' => 'admin',
            'as' => 'faqs.',
            'middleware' => ['web', 'admin.user']
        ], function ($router) {
            require __DIR__.'/../routes/admin.php';
        });

        // Register Neutrino Bonds
        $this->registerNeutrinoItems();

    }

    /**
     * Register the publishable files.
     */
    private function registerPublishableResources()
    {
        $publishablePath = dirname(__DIR__).'/publishable';

        $publishable = [
            'config' => [
                "{$publishablePath}/config/faqs.php" => config_path('faqs.php'),
            ]
        ];
        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }

    public function registerConfigs()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__).'/publishable/config/faqs.php', 'faqs'
        );
    }

    protected function loadHelpers()
    {
        foreach (glob(__DIR__.'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

    /**
     * Register the commands accessible from the Console.
     */
    private function registerConsoleCommands()
    {
        $this->commands(Commands\InstallCommand::class);
        $this->commands(Commands\UpdateCommand::class);
    }

    private function registerNeutrinoItems()
    {

        $packageInfo = [
            'package_name' => 'FAQs',
            'version' => '0.7.160',
            'description' => 'Fequently Asked Questions',
            'website' => 'https://neutrinocms.com',
            'repo' => 'https://github.com/newelement/faqs',
            'image' => '',
        ];

        registerPackage($packageInfo);


        $menuItems = [
            [
            'slot' => 4,
            'url' => '/admin/faqs',
            'parent_title' => 'FAQs',
            'named_route' => 'faqs.faqs',
            'fa-icon' => 'fa-question-circle',
            'children' => [
                [ 'url' => '/admin/faqs', 'title' => 'All FAQs' ],
                [ 'url' => '/admin/faqs/create', 'title' => 'Create FAQ' ],
                [ 'url' => '/admin/faq-group', 'title' => 'All FAQ Groups' ],
                [ 'url' => '/admin/faq-group/create', 'title' => 'Create FAQ Group' ],
                [ 'url' => '/admin/faq-search-stats', 'title' => 'FAQ Search Stats' ],
                [ 'url' => '/admin/faq-settings', 'title' => 'FAQ Settings' ],

            ]
            ]
        ];

        registerAdminMenus($menuItems);


        $scripts = [
            '/vendor/newelement/faqs/js/app.js',
        ];

        $styles = [
            '/vendor/newelement/faqs/css/app.css',
        ];


        registerScripts($scripts);
        registerStyles($styles);

        $adminScripts = [
            '/vendor/newelement/faqs/js/admin.js',
        ];

        $adminStyles = [
            '/vendor/newelement/faqs/css/admin.css',
        ];

        registerAdminScripts($adminScripts);
        registerAdminStyles($adminStyles);


        $arr = [
            'model' => '\\Newelement\\Locations\\Models\\Faq',
            'key' => 'faqs'
        ];


        registerSiteMap($arr);

    }

}
