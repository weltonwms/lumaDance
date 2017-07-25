<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contrato;
use App\Mensalidade;
use App\Observers\ContratoObserver;
use App\Observers\MensalidadeObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        require base_path('resources/macros/macros.php');
        Contrato::observe(ContratoObserver::class);
        Mensalidade::observe(MensalidadeObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
