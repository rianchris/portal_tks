<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('local')) {
            $this->configureDefaults();
        } else {
            $baseUrl = 'https://white-dinosaur-290588.hostingersite.com/portal';

            \Illuminate\Support\Facades\URL::forceRootUrl($baseUrl);
            \Illuminate\Support\Facades\URL::forceScheme('https');

            \Livewire\Livewire::setUpdateRoute(function ($handle) {
                return \Illuminate\Support\Facades\Route::post('/portal/livewire/update', $handle);
            });

            \Livewire\Livewire::setScriptRoute(function ($handle) {
                return \Illuminate\Support\Facades\Route::get('/portal/livewire/livewire.js', $handle);
            });

            // TAMBAHKAN INI: Agar rute preview file juga melewati jalur /portal
            // \Livewire\Livewire::setPreviewRoute(function ($handle) {
            //     return \Illuminate\Support\Facades\Route::get('/portal/livewire/preview-file/{filename}', $handle);
            // });
        }
    }

    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(
            fn(): ?Password => app()->isProduction()
                ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
                : null
        );
    }
}
