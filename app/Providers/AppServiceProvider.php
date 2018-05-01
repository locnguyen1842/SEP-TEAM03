<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\productType;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //share view
        view()->composer('header',function($view){
            $loai_sp = productType::all();
            $view->with('loai_sp',$loai_sp);
        });
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
