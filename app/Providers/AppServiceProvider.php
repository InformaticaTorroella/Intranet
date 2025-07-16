<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Http\Middleware\CheckSessionUsername;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Configura las vistas por defecto del paginador
        Paginator::defaultView('vendor.pagination.default');
        Paginator::defaultSimpleView('vendor.pagination.simple-default');

        // Registrar alias para middleware personalizado
        $this->app['router']->aliasMiddleware('check.session', CheckSessionUsername::class);
    }
}
