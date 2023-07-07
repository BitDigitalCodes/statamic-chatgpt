<?php

namespace Bitdigital\StatamicChatgpt;

use Bitdigital\StatamicChatgpt\Controllers\StatamicChatgptBardController;
use Illuminate\Support\Facades\Route;
use Statamic\Providers\AddonServiceProvider;
use Edalzell\Forma\Forma;

class ServiceProvider extends AddonServiceProvider
{
    protected $scripts = [
        __DIR__.'/../dist/js/app.js'
    ];

    public function bootAddon()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/statamic-chatgpt.php', 'statamic-chatgpt'
        );

        // Publishable config, we use Forma to populate this properly within the CP
        $this->publishes([
            __DIR__.'/../config/statamic-chatgpt.php' => config_path('statamic-chatgpt.php')
        ], 'statamic-chatgpt-config');

        // Route that accepts the prompt from the Bard fieldtype, then returns the response to the editor
        $this->registerActionRoutes(function () {
            Route::post('/', [StatamicChatgptBardController::class, 'handle']);
        });

        // Register our Forma CP config view
        Forma::add('bitdigital/statamic-chatgpt');
    }
}
