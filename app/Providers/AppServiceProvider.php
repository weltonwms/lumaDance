<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contrato;
use App\Mensalidade;
use App\Venda;
use App\Observers\ContratoObserver;
use App\Observers\MensalidadeObserver;
use App\Observers\VendaObserver;

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
        Venda::observe(VendaObserver::class);
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
