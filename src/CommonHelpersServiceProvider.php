<?php

namespace Invibe\CommonHelpers;

use Illuminate\Support\ServiceProvider;

/**
 * Class CommonHelpersServiceProvider
 * @author Adam Ondrejkovic
 * @package Invibe\CommonHelpers
 */
class CommonHelpersServiceProvider extends ServiceProvider
{
    /**
     * @author Adam Ondrejkovic
     */
    public function register()
    {
        $this->app->bind('tinyMceConfig', function ($app) {
            return new TinyMceConfig();
        });

        $this->app->bind('basicJson', function ($app) {
            return new BasicJson();
        });

        $this->app->bind('commonFieldsAndColumns', function ($app) {
            return new CommonFieldsAndColumns();
        });

        $this->mergeConfigFrom(__DIR__.'/config/config.php', 'common-helpers');

        $this->loadViewsFrom(__DIR__.'/views', 'common-helpers');
    }

    /**
     * @author Adam Ondrejkovic
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/config/config.php' => config_path('common-helpers.php'),
            ], 'config');

        }
    }
}
