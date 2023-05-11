<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Vite;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);

            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();

        Vite::useScriptTagAttributes([
            'defer' => true,
        ]);

        Filament::serving(static function () {
            Filament::registerViteTheme('resources/css/filament.css');

            //            Filament::registerNavigationGroups([
            //                NavigationGroup::make()
            //                    ->label('Settings')
            //                    ->collapsed(),
            //
            //                NavigationGroup::make()
            //                    ->label('Management')
            //                    ->collapsed(),
            //            ]);
        });
    }
}
