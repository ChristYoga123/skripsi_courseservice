<?php

namespace App\Providers;

use App\Repositories\KursusRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Repositories\KursusMuridRepository;
use App\Repositories\Interfaces\KursusRepositoryInterface;
use App\Repositories\Interfaces\KursusMuridRepositoryInterface;
use Illuminate\Support\Facades\Http;

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
        Http::macro('user', function()
        {
            return Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . request()->bearerToken(),
            ])->baseUrl(env('USER_SERVICE_URL'));
        });
        Model::unguard();
        Model::preventLazyLoading(!app()->isProduction());
    }
}
