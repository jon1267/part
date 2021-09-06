<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Modules\Front\Core\Http\View\Composers\CurrencyComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        View::composer([
            'front.product-card', 'front.product-info', 'front.footer', 'front.footer_ru', 'front.index',
            'payment.profit-table', 'partners.orders-table',  'subpartners.subpartners-orders-table',
        ],CurrencyComposer::class);
    }
}
