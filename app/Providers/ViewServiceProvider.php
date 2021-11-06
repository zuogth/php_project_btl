<?php

namespace App\Providers;

use App\Http\View\Composers\BrandComposer;
use App\Http\View\Composers\MenuComposer;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }


    public function boot()
    {
      View::composer('user.menu',MenuComposer::class);
        View::composer('user.menu',BrandComposer::class);

    }
}
